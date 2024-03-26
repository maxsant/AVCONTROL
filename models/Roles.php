<?php
class Roles extends Connect
{
    /* TODO Traer los roles del sistema */
    public function getRoles()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                roles
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar rol */
    public function insertRole($name, $description)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                roles (name, description, created)
            VALUES
                (?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$description);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar rol por ID */
    public function updateRoleById($id, $name, $description)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                roles
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
    /* TODO obtener rol por ID */
    public function getRoleById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                roles
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar rol por ID */
    public function deleteRoleById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                roles
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