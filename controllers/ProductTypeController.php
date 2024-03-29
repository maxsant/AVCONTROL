<?php

require_once('../config/connection.php');
require_once('../models/ProductTypes.php');

$productType = new ProductTypes();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $productType->insertProductType($_POST['name'], $_POST['description'], $_POST['price']);
        }else{
            $productType->updateProductTypeById($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price']);
        }
        break;
    case "listProductType":
        $datos = $productType->getProductTypes();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = $row['name'];
            $sub_array[] = $row['description'];
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
    case "viewProductType":
        $datos = $productType->getProductTypeById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $productType->deleteProductTypeById($_POST['id']);
        break;
        /* TODO lIstar combobox */
    case "combo":
        $datos = $productType->getProductTypes();
        
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