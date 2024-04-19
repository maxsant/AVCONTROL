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
    public function insertDelivery($name, $type, $stock, $required_quantity)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                deliveries (name, type, stock, required_quantity, created)
            VALUES
                (?, ?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$type);
        $query->bindValue(3,$stock);
        $query->bindValue(4,$required_quantity);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar suministro por ID */
    public function updateDeliveryByFood($id, $name, $type, $stock, $required_quantity)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                deliveries
            SET
                name = ?,
                type = ?,
                stock = ?,
                required_quantity = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$type);
        $query->bindValue(3,$stock);
        $query->bindValue(4,$required_quantity);
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