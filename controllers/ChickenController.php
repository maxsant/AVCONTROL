<?php

require_once('../config/connection.php');
require_once('../models/Chickens.php');

$chicken = new Chickens();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $chicken->insertChicken($_POST['breed'], $_POST['birthdate'], $_POST['condition']);
        }else{
            $chicken->updateChickenById($_POST['id'], $_POST['breed'], $_POST['birthdate'], $_POST['condition']);
        }
        break;
    case "listChicken":
        $datos = $chicken->getChickens();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = $row['breed'];
            $sub_array[] = $row['birthdate'];
            $sub_array[] = $row['condition'];
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
    case "viewChicken":
        $datos = $chicken->getChickenById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $chicken->deleteChickenById($_POST['id']);
        break;
        /* TODO lIstar combobox */
    case "combo":
        $datos = $chicken->getChickens();
        
        if(is_array($datos) == true AND count($datos) > 0){
            $html = '';
            $html.= "<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['breed']."</option>";
            }
            echo $html;
        }
        break;
}

?>