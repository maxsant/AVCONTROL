<?php

require_once("../config/connection.php");
require_once("../models/FarmProductions.php");

$farmProduction = new FarmProductions();

switch($_GET["op"]){
    case 'registerFarmProduction':
        $datos = $farmProduction->insertFarmProductionByuser($_POST['user_id']);
        echo json_encode($datos);
        break;
    case 'saveFarmProductionDetail':
        $farmProduction->insertFarmProductionDetailByPurchase($_POST['chicken_egg_production_type'], $_POST['chicken_egg_production_price'], $_POST['chicken_egg_production_quantity'], $_POST['chicken_egg_production_date'], $_POST['chicken_egg_status']);
        break;
}
?>