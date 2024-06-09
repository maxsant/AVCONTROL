<?php

require_once('../config/connection.php');
require_once('../models/Suppliers.php');

$supplier = new Suppliers();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $supplier->insertSupplier($_POST['name'], $_POST['RUC'], $_POST['phone'], $_POST['email'], $_POST['address']);
        }else{
            $supplier->updateSupplierById($_POST['id'], $_POST['name'], $_POST['RUC'], $_POST['phone'], $_POST['email'], $_POST['address']);
        }
        break;
    case "listSupplier":
        $datos = $supplier->getSuppliers();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = $row['name'];
            $sub_array[] = $row['RUC'];
            $sub_array[] = $row['phone'];
            $sub_array[] = $row['address'];
            $sub_array[] = $row['email'];
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
    case "viewSupplier":
        $datos = $supplier->getSupplierById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $supplier->deleteSupplierById($_POST['id']);
        break;
        /* TODO lIstar combobox */
    case "combo":
        $datos = $supplier->getSuppliers();
        
        if(is_array($datos) == true AND count($datos) > 0){
            $html = '';
            $html.= "<option value='0' selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['name']."</option>";
            }
            echo $html;
        }
        break;
}

?>