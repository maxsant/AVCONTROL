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
    public function insertProduction($name, $stock, $type)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                productions (name, stock, type, created)
            VALUES
                (?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$stock);
        $query->bindValue(3,$type);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar produccion por ID */
    public function updateProductionById($id, $name, $stock, $type)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                productions
            SET
                name = ?,
                stock = ?,
                type = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$stock);
        $query->bindValue(3,$type);
        $query->bindValue(4,$id);
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
                is_active = 1 AND id = ?
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
    /* TODO Traer las producciones del sistema dependiendo el tipo */
    public function getTypeProduction($type)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                productions
            WHERE
                is_active = 1 AND type = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $type);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>