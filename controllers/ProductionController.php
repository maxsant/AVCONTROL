<?php

require_once('../config/connection.php');
require_once('../models/Productions.php');

$production = new Productions();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $production->insertProduction($_POST['name'], $_POST['stock'], $_POST['type']);
        }else{
            $production->updateProductionById($_POST['id'], $_POST['name'], $_POST['stock'], $_POST['type']);
        }
        break;
    case "listProduction":
        $datos = $production->getProductions();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = $row['name'];
            if($row['type'] == 1){
                $sub_array[] = 'Huevos';
            }else if($row['type'] == 2){
                $sub_array[] = 'Insumos';
            }else if($row['type'] == 3){
                $sub_array[] = 'Gallina por peso';
            }
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
    case "viewProduction":
        $datos = $production->getProductionById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $production->deleteProductionById($_POST['id']);
        break;
        /* TODO lIstar combobox */
    case "combo":
        $datos = $production->getProductions();
        
        if(is_array($datos) == true AND count($datos) > 0){
            $html = '';
            $html.= "<option value='0' selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['name']."</option>";
            }
            echo $html;
        }
        break;
    case "type_production":
        $datos = $production->getTypeProduction($_POST['type']);
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