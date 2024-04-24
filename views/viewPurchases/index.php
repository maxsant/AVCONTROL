<?php
require_once("../../config/connection.php");

if(isset($_SESSION["id"])){
?>

<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Compra</title>
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
                                <h4 class="mb-sm-0">Vista Compra</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Vista</a></li>
                                        <li class="breadcrumb-item active">Compra</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xxl-9">
                            <div class="card" id="demo">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-header border-bottom-dashed p-4">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <img src="../../assets/images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark" height="30">
                                                    <img src="../../assets/images/logo-light.png" class="card-logo card-logo-light" alt="logo light" height="30">
                                                    <div class="mt-sm-5 mt-4">
                                                        <h6 class="text-muted text-uppercase fw-semibold">Direccion</h6>
                                                        <p class="text-muted mb-1" id="txtdirecc"></p>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                                    <h6><span class="text-muted fw-normal">Empresa: </span><span>AVCONTROL</span></h6>
                                                    <h6><span class="text-muted fw-normal">Email: </span><span>avcontrol@gmail.com</span></h6>
                                                    <h6><span class="text-muted fw-normal">Pagina Web: </span> <a href="https://localhost/AVCONTROL/" class="link-primary" target="_blank" id="txtweb">AVCONTROL Site</a></h6>
                                                    <h6 class="mb-0"><span class="text-muted fw-normal">Telefono: </span><span>(+1) 1038209201</span></h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="row g-3">
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Nro de Compra</p>
                                                    <h5 class="fs-14 mb-0">C-<span id="purchase_id"></span></h5>
                                                </div>

                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Fecha</p>
                                                    <h5 class="fs-14 mb-0"><span id="purchase_created"></span></h5>
                                                </div>

                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Pago</p>
                                                    <span class="badge badge-soft-success fs-11" id="payment_name"></span>
                                                </div>
                                                
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Estado</p>
                                                    <span class="badge badge-soft-primary fs-11" id="status_payment"></span>
                                                </div>

                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Total</p>
                                                    <h5 class="fs-14 mb-0"><span id="txttotal"></span></h5>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card-body p-4 border-top border-top-dashed">
                                            <div class="row g-3">

                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Datos del Proveedor</h6>
                                                    <p class="fw-medium mb-2" id="supplier_name"></p>
                                                    <p class="fw-medium mb-2" id="supplier_ruc"></p>
                                                    <p class="fw-medium mb-2" id="supplier_address"></p>
                                                    <p class="fw-medium mb-2" id="supplier_email"></p>
                                                    <p class="fw-medium mb-2" id="supplier_phone"></p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card-body p-4 border-top border-top-dashed">
                                            <div class="row g-3">

                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Usuario</h6>
                                                    <p class="fw-medium mb-2" id="user_name"></p>
                                                </div>

                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Pago</h6>
                                                    <p class="fw-medium mb-2" id="payment_name_user"></p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="table-responsive">

                                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr class="table-active">
                                                            <th scope="col">Alimento</th>
                                                            <th scope="col">Tipo</th>
                                                            <th scope="col" style="width: 50px;">Precio</th>
                                                            <th scope="col">Cantidad</th>
                                                            <th scope="col" class="text-end">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="listDetail">

                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="border-top border-top-dashed mt-2">

                                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                                    <tbody>
                                                        <tr>
                                                            <td>Sub Total</td>
                                                            <td class="text-end" id="purchase_subtotal"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>IVA (19%)</td>
                                                            <td class="text-end" id="purchase_iva"></td>
                                                        </tr>
                                                        <tr class="border-top border-top-dashed fs-15">
                                                            <th scope="row">Total</th>
                                                            <th class="text-end" id="purchase_total"></th>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>

                                            <div class="mt-4">
                                                <div class="alert alert-info">
                                                    <p class="mb-0"><span class="fw-semibold">Comentario:</span>
                                                        <span id="purchase_comment">
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                                <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <?php require_once("../html/footer.php"); ?>
        </div>

    </div>

    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="viewPurchase.js"></script>
</body>

</html>
<?php
}else{
    header("Location:".Connect::ruta()."index.php");
}
?>