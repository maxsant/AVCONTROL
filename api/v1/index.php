<?php 
require_once 'controllers/routesController.php';
require_once 'controllers/usersController.php';
require_once 'models/userModel.php';

$routes=new routesController();
$routes->inicio();
?>