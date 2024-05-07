<?php

require_once("../config/connection.php");
require_once("../models/FarmDeliveries.php");

$farmDelivery = new FarmDeliveries();

switch($_GET["op"]){
    case 'registerFarmDeliveries':
        $datos = $farmDelivery->insertFarmDeliveriesByuser($_POST['user_id']);
        echo json_encode($datos);
        break;
}
?>