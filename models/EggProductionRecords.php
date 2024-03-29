<?php
class EggProductionRecords extends Connect
{
    /* TODO Traer las producciones de huevo del sistema */
    public function getEggProductionRecords()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                egg_production_records
            WHERE
                is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO insertar produccion de huevo */
    public function insertEggProductionRecords($production_date, $production_quantity, $egg_status)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                egg_production_records (production_date, production_quantity, egg_status, created)
            VALUES
                (?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$production_date);
        $query->bindValue(2,$production_quantity);
        $query->bindValue(3,$egg_status);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO actualizar produccion de huevo por ID */
    public function updateEggProductionRecordById($id, $production_date, $production_quantity, $egg_status)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                egg_production_records
            SET
                production_date = ?,
                production_quantity = ?,
                egg_status = ?
            WHERE
                id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$production_date);
        $query->bindValue(2,$production_quantity);
        $query->bindValue(3,$egg_status);
        $query->bindValue(4,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO obtener produccion de huevo por ID */
    public function getEggProductionRecordById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                egg_production_records
            WHERE
                is_active = 1 AND id=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO eliminar produccion de huevo por ID */
    public function deleteEggProductionRecordById($id)
    {
        $conectar = parent::connection();
        
        $sql = '
            UPDATE
                egg_production_records
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