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
    /* TODO Eliminar detalle de la compra por medio de la compra del sistema */
    public function deletePurchaseDetail($purchase_detail_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                purchase_details
            SET
                is_active = 0
            WHERE
                id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $purchase_detail_id);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO Calcular los valores de la compra detalle del sistema */
    public function getPurchaseCalculate($purchase_id)
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
                p.total    =   p.subtotal + p.iva
            WHERE
                p.id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $purchase_id);
        $query->bindValue(2, $purchase_id);
        $query->bindValue(3, $purchase_id);
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
    }
    /* TODO Actualizar compra del sistema */
    public function updatePurchase($id, $supplier_id, $supplier_ruc, $supplier_address, $supplier_email, $supplier_phone, $payment_id, $comment = null)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                purchases
            SET
                supplier_id = ?,
                supplier_ruc = ?,
                supplier_address = ?,
                supplier_email = ?,
                supplier_phone = ?,
                payment_id = ?,
                status_purchase = 1,
                comment = ?
            WHERE
                id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $supplier_id);
        $query->bindValue(2, $supplier_ruc);
        $query->bindValue(3, $supplier_address);
        $query->bindValue(4, $supplier_email);
        $query->bindValue(5, $supplier_phone);
        $query->bindValue(6, $payment_id);
        $query->bindValue(7, $comment);
        $query->bindValue(8, $id);
        
        return $query->execute();
    }
    /* TODO Obtener los detalles de la compra por medio de la compra del sistema */
    public function getViewPurchase($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                p.id,
                p.created as purchase_created,
                py.name as payment_name,
                pd.total as purchase_detail_total,
                p.iva as purchase_iva,
                p.subtotal as purchase_subtotal,
                p.total as purchase_total,
                p.comment as purchase_comment,
                u.name as userName,
                u.lastname as userLastname,
                s.name as supplier_name,
                p.supplier_ruc,
                p.supplier_address,
                p.supplier_email,
                p.supplier_phone
            FROM
                purchase_details pd
            INNER JOIN purchases p ON pd.purchase_id = p.id
            INNER JOIN users u ON p.user_id = u.id
            INNER JOIN suppliers s ON p.supplier_id = s.id
            INNER JOIN payments py ON p.payment_id = py.id
            WHERE
                pd.purchase_id = ? AND pd.is_active = 1 AND p.status_purchase = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>