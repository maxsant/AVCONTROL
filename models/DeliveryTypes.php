<?php
class DeliveryTypes extends Connect
{
    /* TODO Traer los tipos de suministros del sistema */
    public function getDeliveryTypes()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                delivery_types
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO Traer los tipos de suministros del sistema por su ID */
    public function getDeliveryTypeById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                delivery_types
            WHERE
                is_active = 1 AND id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>