<?php
class ProductFarms extends Connect
{
    /* TODO Traer los productos de granja del sistema */
    public function getProductFarms()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                product_farms
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar productos de granja */
    public function insertProductFarm($product_id, $farm_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                product_farms (farm_id, product_id, created)
            VALUES
                (?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$farm_id);
        $query->bindValue(2,$product_id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar producto de granja por ID */
    public function updateProductFarmById($id, $product_id, $farm_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                product_farms
            SET
                farm_id = ?,
                product_id = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$farm_id);
        $query->bindValue(2,$product_id);
        $query->bindValue(3,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener producto de granja por ID */
    public function getProductFarmById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                product_farms
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar producto de granja por ID */
    public function deleteProductFarmById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                product_farms
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