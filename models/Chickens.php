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
    public function insertChicken($breed, $birthdate, $condition)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                chickens (breed, birthdate, `condition`, created)
            VALUES
                (?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$breed);
        $query->bindValue(2,$birthdate);
        $query->bindValue(3,$condition);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar gallina por ID */
    public function updateChickenById($id, $breed, $birthdate, $condition)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                chickens
            SET
                breed = ?,
                birthdate = ?,
                `condition` = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$breed);
        $query->bindValue(2,$birthdate);
        $query->bindValue(3,$condition);
        $query->bindValue(4,$id);
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