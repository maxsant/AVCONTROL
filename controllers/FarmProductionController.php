<?php

require_once("../config/connection.php");
require_once("../models/FarmProductions.php");

$farmProduction = new FarmProductions();

switch($_GET["op"]){
    case 'saveFarmProductionDetailEggs':
        $farmProduction->insertFarmProductionDetailByEggs($_POST['chicken_egg_production_type'], $_POST['chicken_egg_production_price'], $_POST['chicken_egg_production_quantity'], $_POST['chicken_egg_production_stock'], $_POST['chicken_egg_production_date'], $_POST['chicken_egg_status'], $_POST['user_id'], $_POST['farm_id']);
        break;
    case 'saveFarmProductionDetailChickens':
        $farmProduction->insertFarmProductionDetailByChickens($_POST['chicken_type'], $_POST['chicken_price'], $_POST['chicken_quantity'], $_POST['chicken_stock'], $_POST['chicken_birthdate'], $_POST['chicken_weight'], $_POST['chicken_condition'], $_POST['user_id'], $_POST['farm_id']);
        break;
    case 'saveFarmProductionDetailThirdParties':
        $farmProduction->insertFarmProductionDetailByThirdParties($_POST['third_party_type'], $_POST['third_party_price'], $_POST['third_party_quantity'], $_POST['third_party_stock'], $_POST['user_id'], $_POST['farm_id']);
        break;
    case 'updateFarmProduction':
        $farmProduction->updateFarmProduction($_POST['farm_id']);
        break;
    case 'listDetail':
        $datos = $farmProduction->getFarmProductionDetail($_POST['farm_id']);
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = $row["nameProduction"];
            $sub_array[] = $row["price"];
            $sub_array[] = $row["stock"];
            $sub_array[] = $row["total"];
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["farmProductionId"].','.$row["production_id"].')" id="'.$row["farmProductionId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
            $data[] = $sub_array;
        }
        
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
        break;
}
?>