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
}
?>