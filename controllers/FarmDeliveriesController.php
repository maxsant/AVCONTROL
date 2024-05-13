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
    case 'deleteFarmDeliveryDetail':
        $farmDelivery->deleteFarmDeliveryDetail($_POST['farm_delivery_detail_id']);
        break;
    case 'updateFarmDelivery':
        $farmDelivery->updateFarmDelivery($_POST['farm_delivery_id'], $_POST['farm_id'], $_POST['farm_name'], $_POST['farm_location'], $_POST['payment_id'], $_POST['farm_delivery_comment'], $_POST['status_payment'], $_POST['delivery_id']);
        break;
    case 'viewFarmDelivery':
        $datos = $farmDelivery->getViewFarmDelivery($_POST['farm_delivery_id']);
        echo json_encode($datos);
        break;
    case 'listFormatDetail':
        $datos = $farmDelivery->getFarmDeliveryDetails($_POST['farm_delivery_id']);
        foreach($datos as $row){
            $dataType = $deliveryType->getDeliveryTypeById($row['delivery_type_id']);
            ?>
            <tr>
            	<td><?php echo $row["nameDelivery"]; ?></td>
            	<td><?php echo $dataType["name"]; ?></td>
            	<td scope="row"><?php echo $row["price"]; ?></td>
            	<td><?php echo $row["stock"]; ?></td>
            	<td class="text-end"><?php echo $row["total"]; ?></td>
            </tr>
            <?php
        }
        break;
    case 'listFarmDeliveries':
        $datos = $farmDelivery->getFarmDeliveries();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = 'D-'.$row["id"];
            $sub_array[] = $row["farm_location"];
            $sub_array[] = $row["farm_name"];
            $sub_array[] = $row["payment_name"];
            $sub_array[] = $row["farm_delivery_subtotal"];
            $sub_array[] = $row["farm_delivery_iva"];
            $sub_array[] = $row["farm_delivery_total"];
            $sub_array[] = $row["userName"].' '.$row['userLastname'];
            if($row['status_payment'] == 1){
                $sub_array[] = '<a onClick="editStatus('.$row['id'].')"; id="'.$row['id'].'"><span class="badge badge-soft-success fs-11">Pagado</span></a>';
            }else{
                $sub_array[] = '<a onClick="editStatus('.$row['id'].')"; id="'.$row['id'].'"><span class="badge badge-soft-danger fs-11">Pendiente</span></a>';
            }
            $sub_array[] = '<a href="../viewFarmDeliveries/?farmDeliveryId='.$row["id"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
            $sub_array[] = '<button type="button" onClick="ver('.$row["id"].')" id="'.$row["id"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
            $data[] = $sub_array;
        }
        
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
        break;
    case 'updateStatusPayment':
        $farmDelivery->updateStatusPayment($_POST['farm_delivery_id'], $_POST['status_payment']);
        break;
}
?>