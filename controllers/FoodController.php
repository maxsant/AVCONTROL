<?php

require_once('../config/connection.php');
require_once('../models/Foods.php');

$food = new Foods();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $food->insertFood($_POST['name'], $_POST['type'], $_POST['stock'], $_POST['required_quantity']);
        }else{
            $food->updateFoodById($_POST['id'], $_POST['name'], $_POST['type'], $_POST['stock'], $_POST['required_quantity']);
        }
        break;
    case "listFood":
        $datos = $food->getFoods();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = $row['name'];
            $sub_array[] = $row['type'];
            $sub_array[] = $row['stock'];
            $sub_array[] = $row['required_quantity'];
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
    case "viewFood":
        $datos = $food->getFoodById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $food->deleteFoodById($_POST['id']);
        break;
        /* TODO lIstar combobox */
    case "combo":
        $datos = $food->getFoods();
        
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