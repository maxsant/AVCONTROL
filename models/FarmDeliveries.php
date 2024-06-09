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
        
        // Consultar el stock total disponible
        $sqlStockDelivery = '
            SELECT
                stock
            FROM
                deliveries
            WHERE
                id = ? AND is_active = 1
        ';
        
        $queryStockDelivery = $conectar->prepare($sqlStockDelivery);
        $queryStockDelivery->bindValue(1, $delivery_id);
        $queryStockDelivery->execute();
        $sumStockDelivery = $queryStockDelivery->fetchColumn();
        
        // Calcular el stock total disponible
        $sqlStockFarmDelivery = '
            SELECT
                COALESCE(SUM(stock), 0) as sumStock
            FROM
                farm_delivery_details
            WHERE
                farm_delivery_id = ? AND is_active = 1
        ';
        
        $queryStockFarmDelivery = $conectar->prepare($sqlStockFarmDelivery);
        $queryStockFarmDelivery->bindValue(1, $farm_delivery_id);
        $queryStockFarmDelivery->execute();
        $sumStockFarmDelivery = $queryStockFarmDelivery->fetchColumn();
        
        // Calcular el stock total disponible
        $available_stock = $sumStockDelivery - $sumStockFarmDelivery;
        
        if ($farm_delivery_detail_stock > 0 && $farm_delivery_detail_stock <= $available_stock) {
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
    /* TODO Eliminar detalle de la compra de suministro por medio de la compra del sistema */
    public function deleteFarmDeliveryDetail($farm_delivery_detail_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                farm_delivery_details
            SET
                is_active = 0
            WHERE
                id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $farm_delivery_detail_id);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO Calcular los valores de la compra detalle del suministro de granja del sistema */
    public function getFarmDeliveryPurchaseCalculate($farm_delivery_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                farm_deliveries as fd
            SET
                fd.subtotal =    (SELECT
                                    SUM(fdd.total) AS fddSubTotal
                                FROM
                                    farm_delivery_details fdd
                                WHERE
                                    fdd.farm_delivery_id = ? AND fdd.is_active = 1
                                ),
                fd.iva      =   (SELECT
                                    SUM(fdd.total) AS fddSubTotal
                                FROM
                                    farm_delivery_details fdd
                                WHERE
                                    fdd.farm_delivery_id = ? AND fdd.is_active = 1
                                ) * 0.19,
                fd.total    =   (SELECT
                                    SUM(fdd.total) AS fddSubTotal
                                FROM
                                    farm_delivery_details fdd
                                WHERE
                                    fdd.farm_delivery_id = ? AND fdd.is_active = 1
                                ) + ((SELECT
                                    SUM(fdd.total) AS fddSubTotal
                                FROM
                                    farm_delivery_details fdd
                                WHERE
                                    fdd.farm_delivery_id = ? AND fdd.is_active = 1
                                ) * 0.19)
            WHERE
                fd.id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $farm_delivery_id);
        $query->bindValue(2, $farm_delivery_id);
        $query->bindValue(3, $farm_delivery_id);
        $query->bindValue(4, $farm_delivery_id);
        $query->bindValue(5, $farm_delivery_id);
        $query->execute();
        
        //Realizar un SELECT para obtener los valores actualizados
        $sqlSelect = '
            SELECT
                subtotal,
                total,
                iva
            FROM
                farm_deliveries
            WHERE
                id = ? AND is_active = 1
        ';
        
        $querySelect = $conectar->prepare($sqlSelect);
        $querySelect->bindValue(1, $farm_delivery_id);
        $querySelect->execute();
        
        return $querySelect->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO Actualizar compra de suministro ppor granja del sistema */
    public function updateFarmDelivery($id, $farm_id, $farm_name, $farm_location, $payment_id, $comment = null, $status_payment, $delivery_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                farm_deliveries as fd
            SET
                fd.farm_id = ?,
                fd.farm_name = ?,
                fd.farm_location = ?,
                fd.payment_id = ?,
                fd.status_farm_delivery = 1,
                fd.comment = ?,
                fd.status_payment = ?
            WHERE
                fd.id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $farm_id);
        $query->bindValue(2, $farm_name);
        $query->bindValue(3, $farm_location);
        $query->bindValue(4, $payment_id);
        $query->bindValue(5, $comment);
        $query->bindValue(6, $status_payment);
        $query->bindValue(7, $id);
        
        $success = $query->execute();
        
        //Actualizar stock de la granja
        if($success){
            
            $sqlSelectStock = '
                SELECT
                    SUM(stock) AS total_stock
                FROM
                    farm_delivery_details
                WHERE
                    farm_delivery_id = ?
            ';
            
            $querySelectStock = $conectar->prepare($sqlSelectStock);
            $querySelectStock->bindValue(1, $id);
            $querySelectStock->execute();
            
            $totalStock = $querySelectStock->fetch(PDO::FETCH_ASSOC)['total_stock'];
            
            $sqlUpdateStockDelivery = '
                UPDATE
                    deliveries
                SET
                    stock = stock - ?
                WHERE
                    id = ?
            ';
            
            $queryUpdateStockDelivery = $conectar->prepare($sqlUpdateStockDelivery);
            $queryUpdateStockDelivery->bindValue(1, $totalStock);
            $queryUpdateStockDelivery->bindValue(2, $delivery_id);
            $queryUpdateStockDelivery->execute();
            
            $sqlUpdateStock = '
                UPDATE
                    farms
                SET
                    stock = stock + ?
                WHERE
                    id = ?
            ';
            
            $queryUpdateStock = $conectar->prepare($sqlUpdateStock);
            $queryUpdateStock->bindValue(1, $totalStock);
            $queryUpdateStock->bindValue(2, $farm_id);
            $queryUpdateStock->execute();
        }
    }
    /* TODO Obtener los detalles de la compra del suministro granja por medio de la compra del sistema */
    public function getViewFarmDelivery($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                fd.id,
                fd.created as farm_delivery_created,
                py.name as payment_name,
                fdd.total as farm_delivery_detail_total,
                fd.iva as farm_delivery_iva,
                fd.subtotal as farm_delivery_subtotal,
                fd.total as farm_delivery_total,
                fd.comment as farm_delivery_comment,
                u.name as userName,
                u.lastname as userLastname,
                fd.farm_name,
                fd.farm_location,
                fd.status_payment
            FROM
                farm_delivery_details fdd
            INNER JOIN farm_deliveries fd ON fdd.farm_delivery_id = fd.id
            INNER JOIN users u ON fd.user_id = u.id
            INNER JOIN farms f ON fd.farm_id = f.id
            INNER JOIN payments py ON fd.payment_id = py.id
            WHERE
                fdd.farm_delivery_id = ? AND fdd.is_active = 1 AND fd.status_farm_delivery = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO Obtener las compras de granja del sistema */
    public function getFarmDeliveries()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT DISTINCT
                fd.id,
                fd.created as farm_delivery_created,
                py.name as payment_name,
                fd.iva as farm_delivery_iva,
                fd.subtotal as farm_delivery_subtotal,
                fd.total as farm_delivery_total,
                u.name as userName,
                u.lastname as userLastname,
                fd.farm_name,
                fd.farm_location,
                fd.status_payment
            FROM
                farm_delivery_details fdd
            INNER JOIN farm_deliveries fd ON fdd.farm_delivery_id = fd.id
            INNER JOIN users u ON fd.user_id = u.id
            INNER JOIN farms f ON fd.farm_id = f.id
            INNER JOIN payments py ON fd.payment_id = py.id
            WHERE
                fdd.is_active = 1 AND fd.status_farm_delivery = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO Actualizar estado de la compra del sistema */
    public function updateStatusPayment($farm_delivery_id, $status_payment)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                farm_deliveries
            SET
                status_payment = ?
            WHERE
                id = ? AND status_farm_delivery = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $status_payment);
        $query->bindValue(2, $farm_delivery_id);
        
        return $query->execute();
    }
}
?>