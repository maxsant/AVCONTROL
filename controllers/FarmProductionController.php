<?php

require_once("../config/connection.php");
require_once("../models/FarmProductions.php");

$farmProduction = new FarmProductions();

switch($_GET["op"]){
    case 'registerFarmProduction':
        $datos = $farmProduction->insertFarmProductionByuser($_POST['user_id']);
        echo json_encode($datos);
        break;
}
?>