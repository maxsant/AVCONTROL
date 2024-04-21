<?php
class Products extends Connect
{
    /* TODO Traer los productos del sistema */
    public function getProducts()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                products
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar productos */
    public function insertProducts($expiration_date, $stock, $product_type_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                products (expiration_date, stock, product_type_id, created)
            VALUES
                (?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$expiration_date);
        $query->bindValue(2,$stock);
        $query->bindValue(3,$product_type_id);
        
        return  $query->execute();
    }
    /* TODO actualizar producto por ID */
    public function updateProductById($id, $expiration_date, $stock, $product_type_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                products
            SET
                expiration_date = ?,
                stock = ?,
                product_type_id = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$expiration_date);
        $query->bindValue(2,$stock);
        $query->bindValue(3,$product_type_id);
        $query->bindValue(4,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener productos por ID */
    public function getProductById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                products
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener productos por su tipo mediante la ID */
    public function getProductByTypeId($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                products
            WHERE
                is_active = 1 AND product_type_id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar productos por ID */
    public function deleteProductById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                products
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