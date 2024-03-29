<?php
class Foods extends Connect
{
    /* TODO Traer los alimentos del sistema */
    public function getFoods()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                foods
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar alimento */
    public function insertFood($name, $type, $stock, $required_quantity)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                foods (name, type, stock, required_quantity, created)
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
    /* TODO actualizar alimento por ID */
    public function updateFoodById($id, $name, $type, $stock, $required_quantity)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                foods
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
    /* TODO obtener alimento por ID */
    public function getFoodById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                foods
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar alimento por ID */
    public function deleteFoodById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                foods
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