<?php
class FarmProductions extends Connect{
    /* TODO Insertar un detalle de la produccion por el usuario para la granja del sistema */
    public function insertFarmProductionDetailByEggs($chicken_egg_production_type, $chicken_egg_production_price, $chicken_egg_production_quantity, $chicken_egg_production_stock, $chicken_egg_production_date, $chicken_egg_status, $user_id, $farm_id)
    {
        $conectar = parent::connection();
        
        // Consultar el stock total disponible
        $sqlStockProduction = '
            SELECT
                stock
            FROM
                productions
            WHERE
                id = ? AND is_active = 1
        ';
        
        $queryStockProduction = $conectar->prepare($sqlStockProduction);
        $queryStockProduction->bindValue(1, $chicken_egg_production_type);
        $queryStockProduction->execute();
        $sumStockProduction= $queryStockProduction->fetchColumn();
        
        // Calcular el stock total disponible
        $sqlStockFarmProduction = '
            SELECT
                COALESCE(SUM(stock), 0) as sumStock
            FROM
                farm_productions
            WHERE
                farm_id = ? AND is_active = 1 AND status_production = 2 AND production_id = ?
        ';
        
        $queryStockFarmproduction = $conectar->prepare($sqlStockFarmProduction);
        $queryStockFarmproduction->bindValue(1, $farm_id);
        $queryStockFarmproduction->bindValue(2, $chicken_egg_production_type);
        $queryStockFarmproduction->execute();
        $sumStockFarmProduction = $queryStockFarmproduction->fetchColumn();
        
        // Calcular el stock total disponible
        $available_stock = $sumStockProduction - $sumStockFarmProduction;
        
        if ($chicken_egg_production_stock > 0 && $chicken_egg_production_stock <= $available_stock) {
            $total = $chicken_egg_production_price * $chicken_egg_production_stock;
            
            $sql = '
                INSERT INTO
                    farm_productions (chicken_egg_production_date , chicken_egg_production_quantity, production_id, price, stock, chicken_egg_status, total, user_id, farm_id, created)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, now())
            ';
            
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $chicken_egg_production_date);
            $query->bindValue(2, $chicken_egg_production_stock);
            $query->bindValue(3, $chicken_egg_production_type);
            $query->bindValue(4, $chicken_egg_production_price);
            $query->bindValue(5, $chicken_egg_production_stock);
            $query->bindValue(6, $chicken_egg_status);
            $query->bindValue(7, $total);
            $query->bindValue(8, $user_id);
            $query->bindValue(9, $farm_id);
            
            if($query->execute()){
                $answer = [
                    'status' => true
                ];
            }
        }else{
            $answer = [
                'status' => false,
                'msg' => 'Ha superado el stock maximo disponible'
            ];
        }
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
    /* TODO Insertar un detalle de la produccion por el usuario para la granja del sistema */
    public function insertFarmProductionDetailByChickens($chicken_type, $chicken_price, $chicken_quantity, $chicken_stock, $chicken_birthdate, $chicken_weight, $chicken_condition, $user_id, $farm_id)
    {
        $conectar = parent::connection();
        
        // Consultar el stock total disponible
        $sqlStockProduction = '
            SELECT
                stock
            FROM
                productions
            WHERE
                id = ? AND is_active = 1
        ';
        
        $queryStockProduction = $conectar->prepare($sqlStockProduction);
        $queryStockProduction->bindValue(1, $chicken_type);
        $queryStockProduction->execute();
        $sumStockProduction= $queryStockProduction->fetchColumn();
        
        // Calcular el stock total disponible
        $sqlStockFarmProduction = '
            SELECT
                COALESCE(SUM(stock), 0) as sumStock
            FROM
                farm_productions
            WHERE
                farm_id = ? AND is_active = 1 AND status_production = 2 AND production_id = ?
        ';
        
        $queryStockFarmproduction = $conectar->prepare($sqlStockFarmProduction);
        $queryStockFarmproduction->bindValue(1, $farm_id);
        $queryStockFarmproduction->bindValue(2, $chicken_type);
        $queryStockFarmproduction->execute();
        $sumStockFarmProduction = $queryStockFarmproduction->fetchColumn();
        
        // Calcular el stock total disponible
        $available_stock = $sumStockProduction - $sumStockFarmProduction;
        
        if ($chicken_stock > 0 && $chicken_stock <= $available_stock) {
            $total = $chicken_price * $chicken_stock;
            
            $sql   = '
                INSERT INTO
                    farm_productions (chicken_birthdate , chicken_condition, production_id, price, stock, chicken_weight, total, user_id, farm_id, created)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, now())
            ';
            
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $chicken_birthdate);
            $query->bindValue(2, $chicken_condition);
            $query->bindValue(3, $chicken_type);
            $query->bindValue(4, $chicken_price);
            $query->bindValue(5, $chicken_stock);
            $query->bindValue(6, $chicken_weight);
            $query->bindValue(7, $total);
            $query->bindValue(8, $user_id);
            $query->bindValue(9, $farm_id);
            
            if($query->execute()){
                $answer = [
                    'status' => true
                ];
            }
        }else{
            $answer = [
                'status' => false,
                'msg' => 'Ha superado el stock maximo disponible'
            ];
        }
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
    /* TODO Insertar un detalle de la produccion por el usuario para la granja del sistema */
    public function insertFarmProductionDetailByThirdParties($third_party_type, $third_party_price, $third_party_quantity, $third_party_stock, $user_id, $farm_id)
    {
        $conectar = parent::connection();
        
        // Consultar el stock total disponible
        $sqlStockProduction = '
            SELECT
                stock
            FROM
                productions
            WHERE
                id = ? AND is_active = 1
        ';
        
        $queryStockProduction = $conectar->prepare($sqlStockProduction);
        $queryStockProduction->bindValue(1, $third_party_type);
        $queryStockProduction->execute();
        $sumStockProduction= $queryStockProduction->fetchColumn();
        
        // Calcular el stock total disponible
        $sqlStockFarmProduction = '
            SELECT
                COALESCE(SUM(stock), 0) as sumStock
            FROM
                farm_productions
            WHERE
                farm_id = ? AND is_active = 1 AND status_production = 2 AND production_id = ?
        ';
        
        $queryStockFarmproduction = $conectar->prepare($sqlStockFarmProduction);
        $queryStockFarmproduction->bindValue(1, $farm_id);
        $queryStockFarmproduction->bindValue(2, $third_party_type);
        $queryStockFarmproduction->execute();
        $sumStockFarmProduction = $queryStockFarmproduction->fetchColumn();
        
        // Calcular el stock total disponible
        $available_stock = $sumStockProduction - $sumStockFarmProduction;
        
        if ($third_party_stock > 0 && $third_party_stock <= $available_stock) {
            $total = $third_party_price * $third_party_stock;
            
            $sql = '
                INSERT INTO
                    farm_productions (production_id, price, stock, total, user_id, farm_id, created)
                VALUES
                    (?, ?, ?, ?, ?, ?, now())
            ';
            
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $third_party_type);
            $query->bindValue(2, $third_party_price);
            $query->bindValue(3, $third_party_stock);
            $query->bindValue(4, $total);
            $query->bindValue(5, $user_id);
            $query->bindValue(6, $farm_id);
            
            if($query->execute()){
                $answer = [
                    'status' => true
                ];
            }
        }else{
            $answer = [
                'status' => false,
                'msg' => 'Ha superado el stock maximo disponible'
            ];
        }
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
    /* TODO Obtener los detalles de la compra por medio de la produccion de granja del sistema */
    public function getFarmProductionDetail($farm_id)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                p.id as productionId,
                p.name as nameProduction,
                fp.stock,
                fp.price,
                fp.total,
                fp.id as farmProductionId,
                fp.farm_id,
                fp.production_id
            FROM
                farm_productions as fp
            INNER JOIN productions p ON fp.production_id = p.id
            WHERE
                fp.farm_id = ? AND fp.is_active = 1 AND fp.status_production = 2
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1, $farm_id);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /* TODO Actualizar compra de suministro ppor granja del sistema */
    public function updateFarmProduction($farm_id)
    {
        $conectar = parent::connection();
        
        // Obtener el stock total agrupado por production_id
        $sqlSelectStock = '
            SELECT
                production_id,
                SUM(stock) AS total_stock
            FROM
                farm_productions
            WHERE
                farm_id = ? AND status_production = 2
            GROUP BY
                production_id
        ';
        
        $querySelectStock = $conectar->prepare($sqlSelectStock);
        $querySelectStock->bindValue(1, $farm_id);
        $querySelectStock->execute();
        
        $productionStocks = $querySelectStock->fetchAll(PDO::FETCH_ASSOC);
        
        // Actualizar el status_production en farm_productions
        $sqlUpdateStatus = '
            UPDATE
                farm_productions
            SET
                status_production = 1
            WHERE
                farm_id = ? AND status_production = 2
        ';
        
        $queryUpdateStatus = $conectar->prepare($sqlUpdateStatus);
        $queryUpdateStatus->bindValue(1, $farm_id);
        $success = $queryUpdateStatus->execute();
        
        if($success){
            foreach ($productionStocks as $productionStock) {
                $prod_id = $productionStock['production_id'];
                $totalStock = $productionStock['total_stock'];
                
                // Actualizar stock de la tabla productions
                $sqlUpdateStockDelivery = '
                    UPDATE
                        productions
                    SET
                        stock = stock - ?
                    WHERE
                        id = ?
                ';
                
                $queryUpdateStockDelivery = $conectar->prepare($sqlUpdateStockDelivery);
                $queryUpdateStockDelivery->bindValue(1, $totalStock);
                $queryUpdateStockDelivery->bindValue(2, $prod_id);
                $queryUpdateStockDelivery->execute();
            }
            
            // Calcular el stock total para actualizar la tabla farms
            $totalStockAllProductions = array_sum(array_column($productionStocks, 'total_stock'));
            
            // Actualizar stock de la tabla farms
            $sqlUpdateStock = '
                UPDATE
                    farms
                SET
                    stock_production = stock_production + ?
                WHERE
                    id = ?
            ';
            
            $queryUpdateStock = $conectar->prepare($sqlUpdateStock);
            $queryUpdateStock->bindValue(1, $totalStockAllProductions);
            $queryUpdateStock->bindValue(2, $farm_id);
            $queryUpdateStock->execute();
        }
    }
}
?>