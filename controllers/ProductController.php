<?php

require_once('../config/connection.php');
require_once('../models/Products.php');
require_once('../models/ProductTypes.php');

$product = new Products();
$productType = new ProductTypes();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $product->insertProducts($_POST['expiration_date'], $_POST['stock'], $_POST['product_type_id']);
        }else{
            $product->updateProductById($_POST['id'], $_POST['expiration_date'], $_POST['stock'], $_POST['product_type_id']);
        }
        break;
    case "listProduct":
        $datos = $product->getProducts();
        $data  = [];
        foreach($datos as $row){
            
            $productTypeData = $productType->getProductTypeById($row['product_type_id']);
            
            $sub_array   = [];
            $sub_array[] = $row['expiration_date'];
            $sub_array[] = $row['stock'];
            $sub_array[] = $productTypeData['name'];
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
    case "viewProduct":
        $datos = $product->getProductById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $product->deleteProductById($_POST['id']);
        break;
        /* TODO lIstar combobox */
    case "combo":
        $datos = $productType->getProducts();
        
        if(is_array($datos) == true AND count($datos) > 0){
            $html = '';
            $html.= "<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>Fecha Expiracion: ".$row['expiration_date']." | Stock: ".$row['stock']."</option>";
            }
            echo $html;
        }
        break;
}

?>