<?php
class Deliveries extends Connect
{
    /* TODO Traer los suministros del sistema */
    public function getDeliveries()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                deliveries
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar suministro */
    public function insertDelivery($name, $delivery_type_id, $stock, $price)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                deliveries (name, delivery_type_id, stock, price, created)
            VALUES
                (?, ?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$delivery_type_id);
        $query->bindValue(3,$stock);
        $query->bindValue(4,$price);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar suministro por ID */
    public function updateDeliveryById($id, $name, $delivery_type_id, $stock, $price)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                deliveries
            SET
                name = ?,
                delivery_type_id = ?,
                stock = ?,
                price = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$delivery_type_id);
        $query->bindValue(3,$stock);
        $query->bindValue(4,$price);
        $query->bindValue(5,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener suministro por ID */
    public function getDeliveryById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                deliveries
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar suministro por ID */
    public function deleteDeliveryById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                deliveries
            SET
                is_active = 0
            WHERE
                id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>