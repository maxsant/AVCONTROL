<?php
class Suppliers extends Connect
{
    /* TODO Traer los proveedores del sistema */
    public function getSuppliers()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                suppliers
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar proveedor */
    public function insertSupplier($name, $ruc, $phone, $email, $address)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                suppliers (name, RUC, phone, email, address, created)
            VALUES
                (?, ?, ?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$ruc);
        $query->bindValue(3,$phone);
        $query->bindValue(4,$email);
        $query->bindValue(5,$address);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar provvedor por ID */
    public function updateSupplierById($id, $name, $ruc, $phone, $email, $address)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                suppliers
            SET
                name = ?,
                RUC = ?,
                phone = ?,
                email` = ?,
                address = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$ruc);
        $query->bindValue(3,$phone);
        $query->bindValue(4,$email);
        $query->bindValue(5,$address);
        $query->bindValue(6,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener proveedor por ID */
    public function getSupplierById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                suppliers
            WHERE
                is_active = 1 AND id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar proveedor por ID */
    public function deleteSupplierById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                suppliers
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