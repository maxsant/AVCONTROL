<?php
class Farms extends Connect
{
    /* TODO Traer las granjas del sistema */
    public function getFarms()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                farms
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar granjas */
    public function insertFarm($name, $location, $size, $chicken_id, $food_id, $egg_production_record_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                farms (name, location, `size`, chicken_id, food_id, egg_production_record_id, created)
            VALUES
                (?, ?, ?, ?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$location);
        $query->bindValue(3,$size);
        $query->bindValue(4,$chicken_id);
        $query->bindValue(5,$food_id);
        $query->bindValue(6,$egg_production_record_id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar granjas por ID */
    public function updateFarmById($id, $name, $location, $size, $chicken_id, $food_id, $egg_production_record_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                farms
            SET
                name = ?,
                location = ?,
                `size` = ?,
                chicken_id = ?,
                food_id = ?,
                egg_production_record_id = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$location);
        $query->bindValue(3,$size);
        $query->bindValue(4,$chicken_id);
        $query->bindValue(5,$food_id);
        $query->bindValue(6,$egg_production_record_id);
        $query->bindValue(7,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener granja por ID */
    public function getFarmById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                farms
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar granja por ID */
    public function deleteFarmById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                farms
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