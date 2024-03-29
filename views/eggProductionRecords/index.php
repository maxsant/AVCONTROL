<?php

require_once('../../config/connection.php');

if($_SESSION['id']){
?>
<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Produccion de Huevos</title>
    <?php
    require_once("../html/head.php");
    ?>
</head>

<body>

    <div id="layout-wrapper">
        <?php
        require_once("../html/header.php");
        require_once("../html/menu.php");
        ?>
        
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Produccion de Huevos</h4>
                                
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Mantenimiento</a></li>
                                        <li class="breadcrumb-item active">Produccion de Huevo</li>
                                    </ol>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" id="btnnuevo" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Nuevo Registro</button>
                                </div>
                                <div class="card-body">
                                    <table id="table_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Fecha Produccion</th>
                                                <th>Cantidad Produccion</th>
                                                <th>Estado Huevos</th>
                                                <th>Creado</th>
                                                <th>Estado</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require_once("../html/footer.php");
            ?>
        </div>
    </div>
    <?php require_once("mantenimiento.php"); ?>
    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="eggProductionRecord.js"></script>
</body>
</html>
<?php
}else{
    header("Location:".Connect::route().'/index.php');
    exit;
}
?>