<?php
class Roles extends Connect
{
    /* TODO Traer los roles del sistema */
    public function getRoles()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                roles
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>