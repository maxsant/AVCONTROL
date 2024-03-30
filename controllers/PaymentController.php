<?php

require_once('../config/connection.php');
require_once('../models/Payments.php');

$payment = new Payments();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $payment->insertPayment($_POST['name']);
        }else{
            $payment->updatePaymentById($_POST['id'], $_POST['name']);
        }
        break;
    case "listPayment":
        $datos = $payment->getPayments();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = $row['name'];
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
    /* TODO lIstar combobox */
    case "combo":
        $datos = $payment->getPayments();
        
        if(is_array($datos) == true AND count($datos) > 0){
            $html = '';
            $html.= "<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['name']."</option>";
            }
            echo $html;
        }
        break;
    case "viewPayment":
        $datos = $payment->getPaymentById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $payment->deletePaymentById($_POST['id']);
        break;
}

?>