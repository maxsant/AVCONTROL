<?php
class Identifications extends Connect
{
    /* TODO Traer las identificaciones del sistema */
    public function getIdentifications()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                identifications
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar identificacion */
    public function insertIdentification($name, $description)
    {
        $conectar = parent::connection();
       
        $sql = '
            INSERT INTO
                identifications (name, description, created)
            VALUES
                (?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$description);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar identificacion por ID */
    public function updateIdentificationById($id, $name, $description)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                identifications
            SET
                name = ?,
                description = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$description);
        $query->bindValue(3,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener identificacion por ID */
    public function getIdentificationById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                identifications
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar identificacion por ID */
    public function deleteIdentificationById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                identifications
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