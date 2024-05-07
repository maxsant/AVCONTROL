<?php
class FarmDeliveries extends Connect{
    /* TODO Insertar una compra de suministro para granja por el usuario del sistema */
    public function insertFarmDeliveriesByuser($user_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                farm_deliveries (user_id, created)
            VALUES
                (?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $user_id);
        $query->execute();
        
        //Obtener el ultimo registro insertado
        $lastId = $conectar->lastInsertId();
        
        // Realizar consulta SELECT para obtener la compra del ultimo registro
        $sqlSelect = '
            SELECT
                *
            FROM
                farm_deliveries
            WHERE
                id = ? AND is_active = 1
        ';
        
        $querySelect = $conectar->prepare($sqlSelect);
        $querySelect->bindValue(1, $lastId);
        $querySelect->execute();
        
        return $querySelect->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO Insertar un detalle de la compra por el usuario para la granja del sistema */
    public function insertFarmDeliveryDetailByPurchase($farm_delivery_id, $delivery_id, $farm_delivery_detail_price, $farm_delivery_detail_stock)
    {
        $conectar = parent::connection();
        
        // Consultar la suma del stock de todas las entregas
        $sqlStockDelivery   = '
            SELECT
                stock
            FROM
                deliveries
            WHERE
                id = ?
        ';
        
        $queryStockDelivery = $conectar->prepare($sqlStockDelivery);
        $queryStockDelivery->bindValue(1, $delivery_id);
        $queryStockDelivery->execute();
        $sumStockDelivery = $queryStockDelivery->fetchColumn();
        
        // Calcular el stock a insertar basado en el stock disponible y la cantidad ingresada por el usuario
        $insert_stock = min($sumStockDelivery, $farm_delivery_detail_stock);
        
        // Consultar el stock total disponible
        $sqlStockFarmDelivery   = '
            SELECT
                SUM(stock) as sumStock
            FROM
                farm_delivery_details
            WHERE
                farm_delivery_id = ?
        ';
        
        $queryStockFarmDelivery = $conectar->prepare($sqlStockFarmDelivery);
        $queryStockFarmDelivery->bindValue(1, $farm_delivery_id);
        $queryStockFarmDelivery->execute();
        $sumStockFarmDelivery = $queryStockFarmDelivery->fetchColumn();
        
        // Calcular el stock total disponible
        $available_stock = $sumStockDelivery - $sumStockFarmDelivery;
        
        if($insert_stock > 0 AND $insert_stock <= $available_stock){
            $total = $farm_delivery_detail_price * $farm_delivery_detail_stock;
            
            $sql = '
            INSERT INTO
                farm_delivery_details (farm_delivery_id, delivery_id, price, stock, total, created)
            VALUES
                (?, ?, ?, ?, ?, now())
        ';
            
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $farm_delivery_id);
            $query->bindValue(2, $delivery_id);
            $query->bindValue(3, $farm_delivery_detail_price);
            $query->bindValue(4, $farm_delivery_detail_stock);
            $query->bindValue(5, $total);
            
            if($query->execute()){
                $answer = [
                    'status' => true
                ];
            }
        }else{
            $answer = [
                'status' => false,
                'msg' => 'Ha superado el stock maximo disponible'
            ];
        }
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
    /* TODO Obtener los detalles de la compra por medio de la compra del suministro de granja del sistema */
    public function getFarmDeliveryDetails($farm_delivery_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                d.id as deliveryId,
                d.name as nameDelivery,
                d.delivery_type_id,
                fdd.stock,
                fdd.price,
                fdd.total,
                fdd.id as farm_delivery_detail_id,
                fdd.farm_delivery_id
            FROM
                farm_delivery_details as fdd
            INNER JOIN deliveries d ON fdd.delivery_id = d.id
            WHERE
                fdd.farm_delivery_id = ? AND fdd.is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $farm_delivery_id);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO Calcular los valores de la compra detalle del suministro de granja del sistema */
    /*public function getFarmDeliveryPurchaseCalculate($farm_delivery_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                purchases as p
            SET
                p.subtotal =    (SELECT
                                    SUM(pd.total) AS pdSubTotal
                                FROM
                                    purchase_details pd
                                WHERE
                                    pd.purchase_id = ? AND pd.is_active = 1
                                ),
                p.iva      =   (SELECT
                                    SUM(pd.total) AS pdSubTotal
                                FROM
                                    purchase_details pd
                                WHERE
                                    pd.purchase_id = ? AND pd.is_active = 1
                                ) * 0.19,
                p.total    =   (SELECT
                                    SUM(pd.total) AS pdSubTotal
                                FROM
                                    purchase_details pd
                                WHERE
                                    pd.purchase_id = ? AND pd.is_active = 1
                                ) + ((SELECT
                                    SUM(pd.total) AS pdSubTotal
                                FROM
                                    purchase_details pd
                                WHERE
                                    pd.purchase_id = ? AND pd.is_active = 1
                                ) * 0.19)
            WHERE
                p.id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $purchase_id);
        $query->bindValue(2, $purchase_id);
        $query->bindValue(3, $purchase_id);
        $query->bindValue(4, $purchase_id);
        $query->bindValue(5, $purchase_id);
        $query->execute();
        
        //Realizar un SELECT para obtener los valores actualizados
        $sqlSelect = '
            SELECT
                subtotal,
                total,
                iva
            FROM
                purchases
            WHERE
                id = ? AND is_active = 1
        ';
        
        $querySelect = $conectar->prepare($sqlSelect);
        $querySelect->bindValue(1, $purchase_id);
        $querySelect->execute();
        
        return $querySelect->fetch(PDO::FETCH_ASSOC);
    }*/
}
?>