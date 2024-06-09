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
            $product->insertProducts($_POST['name'], $_POST['description'], $_POST['price'], $_POST['expiration_date'], $_POST['stock'], $_POST['image']);
        }else{
            $product->updateProductById($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['expiration_date'], $_POST['stock'], $_POST['image']);
        }
        break;
    case "listProduct":
        $datos = $product->getProducts();
        $data  = [];
        foreach($datos as $row){
            
            $sub_array   = [];
            if($row['image'] != ''){
                $sub_array[] = 
                    "<div class='d-flex align-items-center'>".
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/Product/".$row['image']."' alt='' class='avatar-xs rounded-circle' />".
                        "</div>".
                    "</div>";
            }else{
                $sub_array[] =
                "<div class='d-flex align-items-center'>".
                    "<div class='flex-shrink-0 me-2'>".
                        "<img src='../../assets/Product/no_imagen.png' alt='' class='avatar-xs rounded-circle' />".
                    "</div>".
                "</div>";
            }
            $sub_array[] = $row['name'];
            $sub_array[] = $row['price'];
            $sub_array[] = $row['expiration_date'];
            $sub_array[] = $row['stock'];
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
        if($datos['image'] != ''){
            $datos['image'] = '<img src="../../assets/Product/'.$datos['image'].'" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image" />';
        }else{
            $datos['image'] = '<img src="../../assets/Product/no_imagen.png" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image" />';
        }
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $product->deleteProductById($_POST['id']);
        break;
        /* TODO lIstar combobox */
    case "combo":
        $datos = $product->getProducts();
        
        if(is_array($datos) == true AND count($datos) > 0){
            $html = '';
            $html.= "<option value='0' selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>Nombre: ".$row['name']." | Stock: ".$row['stock']."</option>";
            }
            echo $html;
        }
        break;
}

?>