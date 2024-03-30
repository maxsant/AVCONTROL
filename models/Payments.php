<?php
class Payments extends Connect
{
    /* TODO Traer los metodos de pago del sistema */
    public function getPayments()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                payments
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar metodo de pago */
    public function insertPayment($name)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                payments (name, created)
            VALUES
                (?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar metodo de pago por ID */
    public function updatePaymentById($id, $name)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                payments
            SET
                name = ?
            WHERE
                id = ?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener metodo de pago por ID */
    public function getPaymentById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                payments
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar metodo de pago por ID */
    public function deletePaymentById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                payments
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