<?php

require_once('../config/connection.php');
require_once('../models/Payments.php');

$payment = new Payments();

switch($_GET['op'])
{
    /* TODO lIstar combobox */
    case "combo":
        $datos = $payment->getPayments();
        
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