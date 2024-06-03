<?php

require_once("../config/connection.php");
require_once("../models/FarmProductions.php");

$farmProduction = new FarmProductions();

switch($_GET["op"]){
    case 'registerFarmProduction':
        $datos = $farmProduction->insertFarmProductionByuser($_POST['user_id']);
        echo json_encode($datos);
        break;
    case 'saveFarmProductionDetailEggs':
        $farmProduction->insertFarmProductionDetailByEggs($_POST['chicken_egg_production_type'], $_POST['chicken_egg_production_price'], $_POST['chicken_egg_production_quantity'], $_POST['chicken_egg_production_date'], $_POST['chicken_egg_status']);
        break;
    case 'saveFarmProductionDetailChickens':
        $farmProduction->insertFarmProductionDetailByChickens($_POST['chicken_type'], $_POST['chicken_price'], $_POST['chicken_stock'], $_POST['chicken_birthdate'], $_POST['chicken_weight'], $_POST['chicken_condition']);
        break;
}
?>