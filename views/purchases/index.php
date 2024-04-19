<?php

require_once('../../config/connection.php');

if($_SESSION['id']){
    ?>
<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Nueva Compra</title>
    <?php
    require_once("../html/head.php");
    ?>
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
                                <h4 class="mb-sm-0">Nueva Compra</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Compra</a></li>
                                        <li class="breadcrumb-item active">Nueva Compra</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- TODO:Id de Compra -->
                    <input type="hidden" name="purchase_id" id="purchase_id"/>

                    <!-- TODO:Datos del Proveedor -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Datos del Proveedor</h4>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-center g-3">
                                            <div class="col-lg-4">
                                                <label for="supplier_id" class="form-label">Proveedor</label>
                                                <select id="supplier_id" name="prov_id" class="form-control form-select" aria-label="Seleccione">
                                                    <option value='0' selected>Seleccione</option>

                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="supplier_ruc" class="form-label">RUC</label>
                                                <input type="text" class="form-control" id="supplier_ruc" name="supplier_ruc" placeholder="RUC" readonly/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="supplier_address" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="supplier_address" name="supplier_address" placeholder="Dirección" readonly/>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="supplier_email" class="form-label">Correo</label>
                                                <input type="text" class="form-control" id="supplier_email" name="supplier_email" placeholder="Correo Electronico" readonly/>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="supplier_phone" class="form-label">Telefono</label>
                                                <input type="text" class="form-control" id="supplier_phone" name="supplier_phone" placeholder="Telefono" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TODO:Datos del Producto -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Agregar Alimento</h4>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-center g-3">

                                            <div class="col-lg-3">
                                                <label for="food_id" class="form-label">Alimento</label>
                                                <select id="food_id" name="food_id" class="form-control form-select" aria-label="Seleccionar">
                                                    <option selected>Seleccione</option>

                                                </select>
                                            </div>

                                            <div class="col-lg-3">
                                                <label for="food_type" class="form-label">Tipo Alimento</label>
                                                <input type="text" class="form-control" id="food_type" name="food_type" placeholder="Tipo" readonly />
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <label for="purchase_detail_price" class="form-label">Precio</label>
                                                <input type="number" class="form-control" id="purchase_detail_price" name="purchase_detail_price" placeholder="Precio" min="0" />
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="food_stock" class="form-label">Stock</label>
                                                <input type="text" class="form-control" id="food_stock" name="food_stock" placeholder="Stock" readonly/>
                                            </div>
                                            

                                            <div class="col-lg-2">
                                                <label for="purchase_detail_stock" class="form-label">Cant.</label>
                                                <input type="number" class="form-control" id="purchase_detail_stock" name="purchase_detail_stock" placeholder="Cant." min="0"/>
                                            </div>

                                            <div class="col-lg-1 d-grid gap-1">
                                                <label for="comp_cant" class="form-label">&nbsp;</label>
                                                <button type="button" id="btnagregar" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-add-box-line"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- TODO:Datos del Pago -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Tipo de Pago</h4>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-center g-3">

                                            <div class="col-lg-4">
                                                <label for="payment_id" class="form-label">Pago</label>
                                                <select id="payment_id" name="payment_id" class="form-control form-select" aria-label="Seleccionar">
                                                    <option value="0" selected>Seleccione</option>

                                                </select>
                                            </div>

                                            <!-- <div class="col-lg-4">
                                                <label for="mon_id" class="form-label">Moneda</label>
                                                <select id="mon_id" name="mon_id" class="form-control form-select" aria-label="Seleccionar">
                                                    <option value='0' selected>Seleccione</option>

                                                </select>
                                            </div> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TODO:Detalle de Compra -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Detalle de Compra</h4>
                                </div>

                                <div class="card-body">
                                    <table id="table_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Alimento</th>
                                                <th>Tipo</th>
                                                <th>P.Compra</th>
                                                <th>Cant</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                    <!-- TODO:Calculo Detalle -->
                                    <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td class="text-end" id="txtsubtotal">0</td>
                                            </tr>
                                            <tr>
                                                <td>IVA (19%)</td>
                                                <td class="text-end" id="txtiva">0</td>
                                            </tr>
                                            <tr class="border-top border-top-dashed fs-15">
                                                <th scope="row">Total</th>
                                                <th class="text-end" id="txttotal">0</th>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="mt-4">
                                        <label for="purchase_comment" class="form-label text-muted text-uppercase fw-semibold">Comentario</label>
                                        <textarea class="form-control alert alert-info" id="purchase_comment" name="purchase_comment" placeholder="Comentario" rows="4" required=""></textarea>
                                    </div>

                                    <div class="hstack gap-2 left-content-end d-print-none mt-4">
                                        <button type="button" id="btnguardar" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Guardar</button>
                                        <a id="btnlimpiar" class="btn btn-warning"><i class="ri-send-plane-fill align-bottom me-1"></i> Limpiar</a>
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
    <script type="text/javascript" src="purchase.js"></script>
</body>
</html>
<?php
}else{
    header("Location:".Connect::route().'/index.php');
    exit;
}
?>