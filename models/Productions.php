<?php
class Productions extends Connect
{
    /* TODO Traer las producciones del sistema */
    public function getProductions()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                productions
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar produccion */
    public function insertProduction($name, $stock)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                productions (name, stock, created)
            VALUES
                (?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$stock);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar produccion por ID */
    public function updateChickenById($id, $name, $stock)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                productions
            SET
                name = ?,
                stock = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$stock);
        $query->bindValue(3,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener produccion por ID */
    public function getProductionById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                productions
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar produccion por ID */
    public function deleteProductionById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                productions
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