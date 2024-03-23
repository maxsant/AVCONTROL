<?php

require_once('../config/connection.php');
require_once('../models/Roles.php');

$role = new Roles();

switch($_GET['op'])
{
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
}

?>