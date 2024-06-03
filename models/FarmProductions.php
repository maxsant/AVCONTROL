<?php
class FarmProductions extends Connect{
    /* TODO Insertar una produccion para granja por el usuario del sistema */
    public function insertFarmProductionByuser($user_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            INSERT INTO
                farm_productions (user_id, created)
            VALUES
                (?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $user_id);
        $query->execute();
        
        //Obtener el ultimo registro insertado
        $lastId = $conectar->lastInsertId();
        
        // Realizar consulta SELECT para obtener la compra del ultimo registro
        $sqlSelect = '
            SELECT
                *
            FROM
                farm_productions
            WHERE
                id = ? AND is_active = 1
        ';
        
        $querySelect = $conectar->prepare($sqlSelect);
        $querySelect->bindValue(1, $lastId);
        $querySelect->execute();
        
        return $querySelect->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO Insertar un detalle de la produccion por el usuario para la granja del sistema */
    public function insertFarmProductionDetailByEggs($chicken_egg_production_type, $chicken_egg_production_price, $chicken_egg_production_quantity, $chicken_egg_production_date, $chicken_egg_status)
    {
        $conectar = parent::connection();
        
        $total = $chicken_egg_production_price * $chicken_egg_production_quantity;
        
        $sql = '
            INSERT INTO
                farm_productions (chicken_egg_production_date , chicken_egg_production_quantity, status_product, price, stock, chicken_egg_status, total, created)
            VALUES
                (?, ?, ?, ?, ?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $chicken_egg_production_date);
        $query->bindValue(2, $chicken_egg_production_quantity);
        $query->bindValue(3, $chicken_egg_production_type);
        $query->bindValue(4, $chicken_egg_production_price);
        $query->bindValue(5, $chicken_egg_production_quantity);
        $query->bindValue(6, $chicken_egg_status);
        $query->bindValue(7, $total);
        
        if($query->execute()){
            $answer = [
                'status' => true
            ];
        }
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
    /* TODO Insertar un detalle de la produccion por el usuario para la granja del sistema */
    public function insertFarmProductionDetailByChickens($chicken_type, $chicken_price, $chicken_stock, $chicken_birthdate, $chicken_weight, $chicken_condition)
    {
        $conectar = parent::connection();
        
        $total = $chicken_price * $chicken_stock;
        
        $sql = '
            INSERT INTO
                farm_productions (chicken_birthdate , chicken_condition, status_product, price, stock, chicken_weight, total, created)
            VALUES
                (?, ?, ?, ?, ?, ?, ?, now())
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $chicken_birthdate);
        $query->bindValue(2, $chicken_condition);
        $query->bindValue(3, $chicken_type);
        $query->bindValue(4, $chicken_price);
        $query->bindValue(5, $chicken_stock);
        $query->bindValue(6, $chicken_weight);
        $query->bindValue(7, $total);
        
        if($query->execute()){
            $answer = [
                'status' => true
            ];
        }
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
}
?>