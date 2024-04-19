<?php

require_once('../config/connection.php');
require_once('../models/Farms.php');
require_once('../models/Chickens.php');
require_once('../models/Deliveries.php');
require_once('../models/EggProductionRecords.php');

$farm = new Farms();
$chicken = new Chickens();
$delivery = new Deliveries();
$eggProductionRecord = new EggProductionRecords();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $farm->insertFarm($_POST['name'], $_POST['location'], $_POST['size'], $_POST['chicken_id'], $_POST['delivery_id'], $_POST['egg_production_record_id']);
        }else{
            $farm->updateFarmById($_POST['id'], $_POST['name'], $_POST['location'], $_POST['size'], $_POST['chicken_id'], $_POST['delivery_id'], $_POST['egg_production_record_id']);
        }
        break;
    case "listFarm":
        $datos = $farm->getFarms();
        $data  = [];
        foreach($datos as $row){
            
            $chickenData = $chicken->getChickenById($row['chicken_id']);
            $foodData = $delivery->getDeliveryById($row['delivery_id']);
            $eggProduction = $eggProductionRecord->getEggProductionRecordById($row['egg_production_record_id']);
            
            $sub_array   = [];
            $sub_array[] = $row['name'];
            $sub_array[] = $row['location'];
            $sub_array[] = $row['size'];
            $sub_array[] = $chickenData['breed'];
            $sub_array[] = $foodData['name'];
            $sub_array[] = 'Fecha: '.$eggProduction['production_date'].' | Produccion: '.$eggProduction['production_quantity'];
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
    case "viewFarm":
        $datos = $farm->getFarmById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $farm->deleteFarmById($_POST['id']);
        break;
    /* TODO lIstar combobox */
    case "combo":
        $datos = $farm->getFarms();
        
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