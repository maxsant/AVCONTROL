<?php

require_once('../config/connection.php');
require_once('../models/User.php');

$user = new User();

switch($_GET['op'])
{
    case "listUser":
        $datos = $user->getUsers();
        $data  = [];
        foreach($datos as $row){
            $sub_array   = [];
            $sub_array[] = $row['email'];
            $sub_array[] = $row['name'];
            $sub_array[] = $row['lastname'];
            $sub_array[] = $row['identification'];
            $sub_array[] = $row['phone'];
            $sub_array[] = $row['nameRol'];
            $sub_array[] = $row['created'];
            
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
    case "createAndUpdate":
        if(empty($_POST['id'])){
            $user->insertUser($_POST['name'], $_POST['lastname'], $_POST['identification'], $_POST['phone'], $_POST['email'], $_POST['password_hash'], $_POST['role_id'], $_POST['identification_type_id']);
        }else{
            $user->updateUserById($_POST['id'], $_POST['name'], $_POST['lastname'], $_POST['identification'], $_POST['phone'], $_POST['email'], $_POST['password_hash'], $_POST['role_id'], $_POST['identification_type_id']);
        }
        break;
    case "viewUser":
        $datos = $user->getUserById($_POST['id']);
        echo json_encode($datos);
        break;
    case "delete":
        $datos = $user->deleteUserById($_POST['id']);
        break;
    case "registerUser":
        $user->registerUser($_POST['name'], $_POST['lastname'], $_POST['identification'], $_POST['phone'], $_POST['email'], $_POST['password_hash'], $_POST['identification_type_id']);
        break;
    case "updatePerfil":
        $user->updatePerfilById($_POST['id'], $_POST['password_hash'], $_POST['name'], $_POST['lastname'], $_POST['phone']);
        break;
}

?>