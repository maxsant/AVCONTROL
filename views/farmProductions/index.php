<?php

require_once('../../config/connection.php');
require_once('../../models/Roles.php');

$role = new Roles();

$data = $role->getAccessByRol($_SESSION['role_id'], 'farmproductions');

if($_SESSION['id']){
    if(is_array($data) AND count($data) > 0){
?>
<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Produccion Granja</title>
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
                                <h4 class="mb-sm-0">Produccion Granja</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Compra</a></li>
                                        <li class="breadcrumb-item active">Produccion Granja</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- TODO:Id de Compra -->
                    <input type="hidden" name="farm_production_id" id="farm_production_id"/>
                    
                    <!-- TODO:Datos del Proveedor -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Datos de la Granja</h4>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-center g-3">
                                            <div class="col-lg-4">
                                                <label for="farm_id" class="form-label">Granja</label>
                                                <select id="farm_id" name="farm_id" class="form-control form-select" aria-label="Seleccione">
                                                    <option value='0' selected>Seleccione</option>

                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="farm_name" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="farm_name" name="farm_name" placeholder="Nombre" readonly/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="farm_location" class="form-label">Localización</label>
                                                <input type="text" class="form-control" id="farm_location" name="farm_location" placeholder="Localizacion" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TODO:Datos del Proveedor -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Tipo de Produccion</h4>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-center g-3">
                                            <div class="col-lg-4">
                                                <label for="type_production" class="form-label">Produccion</label>
                                                <select id="type_production" name="type_production" class="form-control form-select" aria-label="Seleccione">
                                                    <option value='0' selected>Seleccione</option>
                                                    <option value='1'>Huevos</option>
                                                    <option value='2'>Insumos</option>
                                                    <option value='3'>Gallinas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- TODO:Datos de los huevos -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Agregar Huevos</h4>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-center g-3">

                                            <div class="col-lg-3">
                                                <label for="chicken_egg_production_type" class="form-label">Tipo Huevos</label>
                                                <select id="chicken_egg_production_type" name="chicken_egg_production_type" class="form-control form-select" aria-label="Seleccionar" disabled>
                                                    <option value="0" selected>Seleccione</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <label for="chicken_egg_production_price" class="form-label">Precio</label>
                                                <input type="number" class="form-control" id="chicken_egg_production_price" name="chicken_egg_production_price" placeholder="Precio" min="0" disabled />
                                            </div>
                                            

                                            <div class="col-lg-2">
                                                <label for="chicken_egg_production_quantity" class="form-label">Cant.</label>
                                                <input type="number" class="form-control" id="chicken_egg_production_quantity" name="chicken_egg_production_quantity" placeholder="Cant." min="0" readonly/>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <label for="chicken_egg_status" class="form-label">Estado</label>
                                                <input type="text" class="form-control" id="chicken_egg_status" name="chicken_egg_status" placeholder="Estado" min="0" disabled/>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <label for="chicken_egg_production_date" class="form-label">Fecha</label>
                                                <input type="date" class="form-control" id="chicken_egg_production_date" name="chicken_egg_production_date" placeholder="Fecha" min="0" disabled/>
                                            </div>

                                            <div class="col-lg-1 d-grid gap-1">
                                                <label for="egg_button" class="form-label">&nbsp;</label>
                                                <button type="button" id="btnegg" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-add-box-line"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- TODO:Datos de los huevos -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Agregar Insumos</h4>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-center g-3">
                                        
                                        	<div class="col-lg-3">
                                                <label for="third_party_type" class="form-label">Insumos</label>
                                                <select id="third_party_type" name="third_party_type" class="form-control form-select" aria-label="Seleccionar" disabled>
                                                    <option value="0" selected>Seleccione</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <label for="third_party_price" class="form-label">Precio</label>
                                                <input type="number" class="form-control" id="third_party_price" name="third_party_price" placeholder="Precio" min="0" disabled />
                                            </div>
                                            

                                            <div class="col-lg-2">
                                                <label for="third_party_stock" class="form-label">Cant.</label>
                                                <input type="number" class="form-control" id="third_party_stock" name="third_party_stock" placeholder="Cant." min="0" disabled/>
                                            </div>

                                            <div class="col-lg-1 d-grid gap-1">
                                                <label for="comp_cant" class="form-label">&nbsp;</label>
                                                <button type="button" id="btnthirdparty" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-add-box-line"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- TODO:Datos de las gallinas -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Agregar Gallinas</h4>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-center g-3">
                                        
                                        	<div class="col-lg-3">
                                                <label for="chicken_type" class="form-label">Gallina</label>
                                                <select id="chicken_type" name="chicken_type" class="form-control form-select" aria-label="Seleccionar" disabled>
                                                    <option value="0" selected>Seleccione</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <label for="chicken_price" class="form-label">Precio</label>
                                                <input type="number" class="form-control" id="chicken_price" name="chicken_price" placeholder="Precio" min="0" disabled />
                                            </div>
                                            

                                            <div class="col-lg-2">
                                                <label for="chicken_stock" class="form-label">Cant.</label>
                                                <input type="number" class="form-control" id="chicken_stock" name="chicken_stock" placeholder="Cant." min="0" disabled/>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <label for="chicken_birthdate" class="form-label">Fecha Nacimiento</label>
                                                <input type="number" class="form-control" id="chicken_birthdate" name="chicken_birthdate" placeholder="Nacimiento" min="0" disabled/>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <label for="chicken_weihg" class="form-label">Peso</label>
                                                <input type="number" class="form-control" id="chicken_weihg" name="chicken_weihg" placeholder="Peso" min="0" disabled/>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <label for="chicken_condition" class="form-label">Condicion</label>
                                                <input type="number" class="form-control" id="chicken_condition" name="chicken_condition" placeholder="Condicion" min="0" disabled/>
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

                    <!-- TODO:Detalle de Compra -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Detalle de Produccion</h4>
                                </div>

                                <div class="card-body">
                                    <table id="table_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Produccion</th>
                                                <th>Tipo</th>
                                                <th>P.Venta</th>
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
    <script type="text/javascript" src="farmProduction.js"></script>
</body>
</html>
<?php
    }else{
        header("Location:".Connect::route().'/views/html/logout.php');
        exit;
    }
}else{
    header("Location:".Connect::route().'/index.php');
    exit;
}
?>