<?php

require_once("../config/connection.php");
require_once("../models/Purchases.php");
require_once("../models/DeliveryTypes.php");

$deliveryType = new DeliveryTypes();
$purchase = new Purchases();

switch($_GET["op"]){
    case 'registerPurchase':
        $datos = $purchase->insertPurchaseByuser($_POST['user_id']);
        echo json_encode($datos);
        break;
    case 'savePurchaseDetail':
        $purchase->insertPurchaseDetailByPurchase($_POST['purchase_id'], $_POST['delivery_id'], $_POST['purchase_detail_price'], $_POST['purchase_detail_stock']);
        break;
    case 'listDetail':
        $datos = $purchase->getPurchaseDetails($_POST['purchase_id']);
        $data  = [];
        foreach($datos as $row){
            
            $dataType = $deliveryType->getDeliveryTypeById($row['delivery_type_id']);
            
            $sub_array   = [];
            $sub_array[] = $row["nameDelivery"];
            $sub_array[] = $dataType["name"];
            $sub_array[] = $row["price"];
            $sub_array[] = $row["stock"];
            $sub_array[] = $row["total"];
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["purchase_detail_id"].','.$row["purchase_id"].')" id="'.$row["purchase_detail_id"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
            $data[] = $sub_array;
        }
        
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
        break;
    case 'deletePurchaseDetail':
        $purchase->deletePurchaseDetail($_POST['purchase_detail_id']);
        break;
    case 'calculate':
        $datos = $purchase->getPurchaseCalculate($_POST['purchase_id']);
        echo json_encode($datos);
        break;
    case 'updatePurchase':
        $purchase->updatePurchase($_POST['purchase_id'], $_POST['supplier_id'], $_POST['supplier_ruc'], $_POST['supplier_address'], $_POST['supplier_email'], $_POST['supplier_phone'], $_POST['payment_id'], $_POST['purchase_comment'], $_POST['status_payment']);
        break;
    case 'viewPurchase':
        $datos = $purchase->getViewPurchase($_POST['purchase_id']);
        echo json_encode($datos);
        break;
    case 'listFormatDetail':
        $datos = $purchase->getPurchaseDetails($_POST['purchase_id']);
        foreach($datos as $row){
            ?>
            <tr>
            	<td><?php echo $row["nameDelivery"]; ?></td>
            	<td><?php echo $row["type"]; ?></td>
            	<td scope="row"><?php echo $row["price"]; ?></td>
            	<td><?php echo $row["stock"]; ?></td>
            	<td class="text-end"><?php echo $row["total"]; ?></td>
            </tr>
            <?php
        }
        break;
    case 'listPurchase':
        $datos = $purchase->getPurchases();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = 'C-'.$row["id"];
            $sub_array[] = $row["supplier_ruc"];
            $sub_array[] = $row["supplier_name"];
            $sub_array[] = $row["payment_name"];
            $sub_array[] = $row["purchase_subtotal"];
            $sub_array[] = $row["purchase_iva"];
            $sub_array[] = $row["purchase_total"];
            $sub_array[] = $row["userName"].' '.$row['userLastname'];
            if($row['status_payment'] == 1){
                $sub_array[] = '<a onClick="editStatus('.$row['id'].')"; id="'.$row['id'].'"><span class="badge badge-soft-success fs-11">Pagado</span></a>';
            }else{
                $sub_array[] = '<a onClick="editStatus('.$row['id'].')"; id="'.$row['id'].'"><span class="badge badge-soft-danger fs-11">Pendiente</span></a>';
            }
            $sub_array[] = '<a href="../viewPurchases/?purchaseId='.$row["id"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
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
        $purchase->updateStatusPayment($_POST['purchase_id'], $_POST['status_payment']);
        break;
}
?>