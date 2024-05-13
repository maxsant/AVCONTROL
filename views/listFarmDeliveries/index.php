<?php
require_once("../../config/connection.php");
require_once('../../models/Roles.php');

$role = new Roles();

$data = $role->getAccessByRol($_SESSION['role_id'], 'listpurchases');

if($_SESSION['id']){
    if(is_array($data) AND count($data) > 0){
?>
<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Listado de Descargues</title>
    <?php require_once("../html/head.php"); ?>
</head>

<body>

    <div id="layout-wrapper">

        <?php require_once("../html/header.php"); ?>

        <?php require_once("../html/menu.php"); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Listado de Descargue</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Listado</a></li>
                                        <li class="breadcrumb-item active">Descargues</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- TODO: Tabla de Listado -->
                                    <table id="table_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Localizacion</th>
                                                <th>Granja</th>
                                                <th>Pago</th>
                                                <th>SubTotal</th>
                                                <th>IVA</th>
                                                <th>Total</th>
                                                <th>Usuario</th>
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
            <?php require_once("../html/footer.php"); ?>
        </div>

    </div>

    <?php
    require_once("mantenimiento.php");
    require_once("modalStatusPayment.php");
    ?>

    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="listFarmDelivery.js"></script>
</body>

</html>
<?php
    }else{
        header("Location:".Connect::route().'/views/html/logout.php');
        exit;
    }
}else{
    header("Location:".Connect::route()."/index.php");
}
?>