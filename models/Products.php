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
    public function insertProducts($name, $description, $price, $expiration_date, $stock, $image)
    {
        $conectar = parent::connection();
        
        require_once ('Products.php');
        $product = new Products();
        $image = '';
        
        if($_FILES['image']['name'] != ''){
            $image = $product->uploadFile();
        }
        
        $sql = '
            INSERT INTO
                products (name, description, price, expiration_date, stock, image, created)
            VALUES
                (?, ?, ?, ?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$description);
        $query->bindValue(3,$price);
        $query->bindValue(4,$expiration_date);
        $query->bindValue(5,$stock);
        $query->bindValue(6,$image);
        
        return  $query->execute();
    }
    /* TODO actualizar producto por ID */
    public function updateProductById($id, $name, $description, $price, $expiration_date, $stock, $image)
    {
        $conectar = parent::connection();
        
        require_once ('Products.php');
        $product = new Products();
        $image = '';
        
        if($_FILES['image']['name'] != ''){
            $image = $product->uploadFile();
        }else{
            $image = $_POST['hidden_producto_imagen'];
        }
        
        $sql = '
            UPDATE
                products
            SET
                name = ?,
                description = ?,
                price = ?,
                expiration_date = ?,
                stock = ?,
                image = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$description);
        $query->bindValue(3,$price);
        $query->bindValue(4,$expiration_date);
        $query->bindValue(5,$stock);
        $query->bindValue(6,$image);
        $query->bindValue(7,$id);
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
    /* TODO Registrar imagen */
    public function uploadFile()
    {
        if(isset($_FILES["image"])){
            $extension = explode('.', $_FILES['image']['name']);
            $newName   = rand().'.'.$extension[1];
            $destination = '../assets/Product/'.$newName;
            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            return $newName;
        }
    }
}
?>