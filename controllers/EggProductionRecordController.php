<?php

require_once('../config/connection.php');
require_once('../models/EggProductionRecords.php');

$eggProductionRecord = new EggProductionRecords();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $eggProductionRecord->insertEggProductionRecords($_POST['production_date'], $_POST['production_quantity'], $_POST['egg_status']);
        }else{
            $eggProductionRecord->updateEggProductionRecordById($_POST['id'], $_POST['production_date'], $_POST['production_quantity'], $_POST['egg_status']);
        }
        break;
    case "listEggProductionRecord":
        $datos = $eggProductionRecord->getEggProductionRecords();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = $row['production_date'];
            $sub_array[] = $row['production_quantity'];
            $sub_array[] = $row['egg_status'];
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
    case "viewEggProductionRecord":
        $datos = $eggProductionRecord->getEggProductionRecordById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $eggProductionRecord->deleteEggProductionRecordById($_POST['id']);
        break;
}

?>