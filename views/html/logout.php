<?php
    require_once("../../config/connection.php");
    header("Location:".Connect::route()."/index.php");
    /* TODO:Destruir Session */
    session_destroy();
    exit();
?>