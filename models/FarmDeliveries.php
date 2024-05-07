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
}
?>