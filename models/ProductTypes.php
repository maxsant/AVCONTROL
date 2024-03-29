<?php
class ProductTypes extends Connect
{
    /* TODO Traer los tipos de producto del sistema */
    public function getProductTypes()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                product_types
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar tipos de producto */
    public function insertProductType($name, $description, $price)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                product_types (name, description, price, created)
            VALUES
                (?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$description);
        $query->bindValue(3,$price);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar alimento por ID */
    public function updateProductTypeById($id, $name, $description, $price)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                product_types
            SET
                name = ?,
                description = ?,
                price = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$description);
        $query->bindValue(3,$price);
        $query->bindValue(4,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener tipo de producto por ID */
    public function getProductTypeById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                product_types
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar tipo de producto por ID */
    public function deleteProductTypeById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                product_types
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