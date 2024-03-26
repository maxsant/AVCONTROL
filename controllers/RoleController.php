<?php

require_once('../config/connection.php');
require_once('../models/Roles.php');

$role = new Roles();

switch($_GET['op'])
{
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $role->insertRole($_POST['name'], $_POST['description']);
        }else{
            $role->updateRoleById($_POST['id'], $_POST['name'], $_POST['description']);
        }
        break;
    case "listRole":
        $datos = $role->getRoles();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = $row['name'];
            $sub_array[] = $row['description'];
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
        $datos = $role->getRoles();
        
        if(is_array($datos) == true AND count($datos) > 0){
            $html = '';
            $html.= "<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['name']."</option>";
            }
            echo $html;
        }
        break;
    case "viewRole":
        $datos = $role->getRoleById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $role->deleteRoleById($_POST['id']);
        break;
}

?>