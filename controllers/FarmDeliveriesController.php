<?php

require_once("../config/connection.php");
require_once("../models/FarmDeliveries.php");
require_once("../models/DeliveryTypes.php");

$farmDelivery = new FarmDeliveries();
$deliveryType = new DeliveryTypes();

switch($_GET["op"]){
    case 'registerFarmDeliveries':
        $datos = $farmDelivery->insertFarmDeliveriesByuser($_POST['user_id']);
        echo json_encode($datos);
        break;
    case 'saveFarmDeliveryDetail':
        $farmDelivery->insertFarmDeliveryDetailByPurchase($_POST['farm_delivery_id'], $_POST['delivery_id'], $_POST['farm_delivery_detail_price'], $_POST['farm_delivery_detail_stock']);
        break;
    case 'listDetail':
        $datos = $farmDelivery->getFarmDeliveryDetails($_POST['farm_delivery_id']);
        $data  = [];
        foreach($datos as $row){
            
            $dataType = $deliveryType->getDeliveryTypeById($row['delivery_type_id']);
            
            $sub_array   = [];
            $sub_array[] = $row["nameDelivery"];
            $sub_array[] = $dataType["name"];
            $sub_array[] = $row["price"];
            $sub_array[] = $row["stock"];
            $sub_array[] = $row["total"];
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["farm_delivery_detail_id"].','.$row["farm_delivery_id"].')" id="'.$row["farm_delivery_detail_id"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
            $data[] = $sub_array;
        }
        
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
        break;
    case 'calculate':
        $datos = $farmDelivery->getFarmDeliveryPurchaseCalculate($_POST['farm_delivery_id']);
        echo json_encode($datos);
        break;
}
?>