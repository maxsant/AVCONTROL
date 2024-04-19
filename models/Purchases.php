<?php
class Purchases extends Connect{
    /* TODO Insertar una compra por el usuario del sistema */
    public function insertPurchaseByuser($user_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                purchases (user_id, created)
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
                purchases
            WHERE
                id = ? AND is_active = 1
        ';
        
        $querySelect = $conectar->prepare($sqlSelect);
        $querySelect->bindValue(1, $lastId);
        $querySelect->execute();
        
        return $querySelect->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO Insertar un detalle de la compra por el usuario del sistema */
    public function insertPurchaseDetailByPurchase($purchase_id, $delivery_id, $purchase_detail_price, $purchase_detail_stock)
    {
        $conectar = parent::connection();
        
        $total = $purchase_detail_price * $purchase_detail_stock;
        
        $sql = '
            INSERT INTO
                purchase_details (purchase_id, delivery_id, price, stock, total, created)
            VALUES
                (?, ?, ?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $purchase_id);
        $query->bindValue(2, $delivery_id);
        $query->bindValue(3, $purchase_detail_price);
        $query->bindValue(4, $purchase_detail_stock);
        $query->bindValue(5, $total);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO Obtener los detalles de la compra por medio de la compra del sistema */
    public function getPurchaseDetails($purchase_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                d.id as deliveryId,
                d.name as nameDelivery,
                d.type,
                pd.stock,
                pd.price,
                pd.total,
                pd.id as purchase_detail_id,
                pd.purchase_id
            FROM
                purchase_details as pd
            INNER JOIN deliveries d ON pd.delivery_id = d.id
            WHERE
                pd.purchase_id = ? AND pd.is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $purchase_id);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>