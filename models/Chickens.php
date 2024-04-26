<?php
class Chickens extends Connect
{
    /* TODO Traer las gallinas del sistema */
    public function getChickens()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                chickens
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar gallina */
    public function insertChicken($breed, $production_date, $production_quantity, $egg_status, $birthdate, $condition)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                chickens (breed, production_date, production_quantity, egg_status, birthdate, `condition`, created)
            VALUES
                (?, ?, ?, ?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$breed);
        $query->bindValue(2,$production_date);
        $query->bindValue(3,$production_quantity);
        $query->bindValue(4,$egg_status);
        $query->bindValue(5,$birthdate);
        $query->bindValue(6,$condition);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar gallina por ID */
    public function updateChickenById($id, $breed, $production_date, $production_quantity, $egg_status, $birthdate, $condition)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                chickens
            SET
                breed = ?,
                production_date = ?,
                production_quantity = ?,
                egg_status = ?,
                birthdate = ?,
                `condition` = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$breed);
        $query->bindValue(2,$production_date);
        $query->bindValue(3,$production_quantity);
        $query->bindValue(4,$egg_status);
        $query->bindValue(5,$birthdate);
        $query->bindValue(6,$condition);
        $query->bindValue(7,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener gallina por ID */
    public function getChickenById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                chickens
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar gallina por ID */
    public function deleteChickenById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                chickens
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