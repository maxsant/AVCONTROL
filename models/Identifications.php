<?php
class Identifications extends Connect
{
    /* TODO Traer las identificaciones del sistema */
    public function getIdentifications()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                identifications
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>