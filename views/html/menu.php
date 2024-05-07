<?php

require_once("../../config/connection.php");
require_once("../../models/Menus.php");

$menu  = new Menus();
$menus = $menu->getMenusByRole($_SESSION['role_id']);

?>

<div class="app-menu navbar-menu">

    <div class="navbar-brand-box">

        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="https://firebasestorage.googleapis.com/v0/b/avcontrol-3dbb7.appspot.com/o/avcontrol_logo.png?alt=media&token=820276d1-4bb4-446e-9862-a8996156021c" alt="" height="150">
            </span>
            <span class="logo-lg">
                <img src="https://firebasestorage.googleapis.com/v0/b/avcontrol-3dbb7.appspot.com/o/avcontrol_logo.png?alt=media&token=820276d1-4bb4-446e-9862-a8996156021c" alt="" height="70">
            </span>
        </a>

        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="https://firebasestorage.googleapis.com/v0/b/avcontrol-3dbb7.appspot.com/o/avcontrol_logo.png?alt=media&token=820276d1-4bb4-446e-9862-a8996156021c" alt="" height="150">
            </span>
            <span class="logo-lg">
                <img src="https://firebasestorage.googleapis.com/v0/b/avcontrol-3dbb7.appspot.com/o/avcontrol_logo.png?alt=media&token=820276d1-4bb4-446e-9862-a8996156021c" alt="" height="70">
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>

    </div>

    <div id="scrollbar">

        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <?php foreach($menus as $row){
                    if($row['group'] == 'Dashboard' AND $row['permission'] == "Si"){
                    ?>
             		   	<li class="nav-item">
                            <a class="nav-link menu-link" href="<?php echo $row["route"]; ?>">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets"><?php echo $row['name']; ?></span>
                            </a>
                        </li>
                    <?php
                    }
                }?>
                <li class="menu-title"><span data-key="t-menu">Mantenimiento</span></li>
                <?php foreach($menus as $row){
                    if($row['group'] == 'Mantenimiento' AND $row['permission'] == "Si"){
                    ?>
             		   	<li class="nav-item">
                            <a class="nav-link menu-link" href="<?php echo $row["route"]; ?>">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets"><?php echo $row['name']; ?></span>
                            </a>
                        </li>
                    <?php
                    }
                }?>
                <li class="menu-title"><span data-key="t-menu">Suministros</span></li>
                <?php foreach($menus as $row){
                    if($row['group'] == 'Compra' AND $row['permission'] == "Si"){
                    ?>
             		   	<li class="nav-item">
                            <a class="nav-link menu-link" href="<?php echo $row["route"]; ?>">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets"><?php echo $row['name']; ?></span>
                            </a>
                        </li>
                    <?php
                    }
                }?>
                <li class="menu-title"><span data-key="t-menu">Granjas</span></li>
                <?php foreach($menus as $row){
                    if($row['group'] == 'Compra Granja' AND $row['permission'] == "Si"){
                    ?>
             		   	<li class="nav-item">
                            <a class="nav-link menu-link" href="<?php echo $row["route"]; ?>">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets"><?php echo $row['name']; ?></span>
                            </a>
                        </li>
                    <?php
                    }
                }?>
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>