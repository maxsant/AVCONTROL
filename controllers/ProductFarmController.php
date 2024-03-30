<?php

require_once('../config/connection.php');
require_once('../models/ProductFarms.php');
require_once('../models/Products.php');
require_once('../models/Farms.php');
require_once('../models/ProductTypes.php');

$productFarm = new ProductFarms();
$product = new Products();
$farm = new Farms();
$productType = new ProductTypes();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $productFarm->insertProductFarm($_POST['product_id'], $_POST['farm_id']);
        }else{
            $productFarm->updateProductFarmById($_POST['id'], $_POST['product_id'], $_POST['farm_id']);
        }
        break;
    case "listProductFarm":
        $datos = $productFarm->getProductFarms();
        $data  = [];
        foreach($datos as $row){
            
            $productData = $product->getProductById($row['product_id']);
            $farmData    = $farm->getFarmById($row['farm_id']);
            $productTypeData = $productType->getProductTypeById($productData['product_type_id']);
            
            $sub_array   = [];
            $sub_array[] = $farmData['name'];
            $sub_array[] = $productData['expiration_date'];
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
    /* TODO lIstar combobox */
    case "combo":
        $datos = $productFarm->getProductFarms();
        
        if(is_array($datos) == true AND count($datos) > 0){
            $html = '';
            $html.= "<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['farm_id']." ".$row['product_id']."</option>";
            }
            echo $html;
        }
        break;
    case "viewProductFarm":
        $datos = $productFarm->getProductFarmById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $productFarm->deleteProductFarmById($_POST['id']);
        break;
}

?>