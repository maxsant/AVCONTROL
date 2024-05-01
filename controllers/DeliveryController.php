<?php

require_once('../config/connection.php');
require_once('../models/Deliveries.php');
require_once('../models/DeliveryTypes.php');

$delivery = new Deliveries();
$deliveryType = new DeliveryTypes();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $delivery->insertDelivery($_POST['name'], $_POST['delivery_type_id'], $_POST['stock'], $_POST['price']);
        }else{
            $delivery->updateDeliveryById($_POST['id'], $_POST['name'], $_POST['delivery_type_id'], $_POST['stock'], $_POST['price']);
        }
        break;
    case "listDelivery":
        $datos = $delivery->getDeliveries();
        $data  = [];
        foreach($datos as $row){
            
            $dataDeliveryType = $deliveryType->getDeliveryTypeById($row['delivery_type_id']);
            
            $sub_array   = [];
            $sub_array[] = $row['name'];
            $sub_array[] = $dataDeliveryType['name'];
            $sub_array[] = $row['stock'];
            $sub_array[] = $row['price'];
            $sub_array[] = $row['created'];
            $sub_array[] = '<span class="">Activo</span>';
            
            // DIbujar los botones
            $sub_array[] = '<button type="button" onCLick="editar('.$row['id'].')" id="'.$row['id'].'" class="btn btn-warning btn-icon waves-effect waves-light">Editar</button>';
            $sub_array[] = '<button type="button" onCLick="eliminar('.$row['id'].')" id="'.$row['id'].'" class="btn btn-danger btn-icon waves-effect waves-light">Eliminar</button>';
            $data[]      = $sub_array;
            
        }
        
        $results = [
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDIsplayRecords" => count($data),
            "aaData" => $data
        ];
        echo json_encode($results);
        break;
    case "viewDelivery":
        $datos = $delivery->getDeliveryById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $delivery->deleteDeliveryById($_POST['id']);
        break;
        /* TODO lIstar combobox */
    case "combo":
        $datos = $delivery->getDeliveries();
        
        if(is_array($datos) == true AND count($datos) > 0){
            $html = '';
            $html.= "<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['name']."</option>";
            }
            echo $html;
        }
        break;
}

?>