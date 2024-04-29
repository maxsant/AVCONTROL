<?php

require_once('../../config/connection.php');

if($_SESSION['id']){
?>
<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Perfil</title>
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
                                <h4 class="mb-sm-0">Perfil</h4>
                                
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Mantenimiento</a></li>
                                        <li class="breadcrumb-item active">Perfil</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
						<div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                	<div class="card-body">
                                		<div class="live-preview">
                                    		<div class="row gy-4" style="margin-bottom: 1rem;">
                                    			<div class="col-xxl-3 col-md-6">
                                					<div>
                                						<label for="basiInput" class="form-label">Nombre</label>
                                						<input type="text" class="form-control" id="name" />
                                					</div>
                                				</div>
                                				<div class="col-xxl-3 col-md-6">
                                					<div>
                                						<label for="basiInput" class="form-label">Apellido</label>
                                						<input type="text" class="form-control" id="lastname" />
                                					</div>
                                				</div>
                                				<div class="col-xxl-3 col-md-6">
                                					<div>
                                						<label for="basiInput" class="form-label">Telefono</label>
                                						<input type="text" class="form-control" id="phone" />
                                					</div>
                                				</div>
                                    		</div>
                                			<div class="row gy-4">
                                				<div class="col-xxl-3 col-md-6">
                                					<div>
                                						<label for="basiInput" class="form-label">Contraseña</label>
                                						<input type="password" class="form-control" id="password_hash" />
                                					</div>
                                				</div>
                                				<div class="col-xxl-3 col-md-6">
                                					<div>
                                						<label for="labelInput" class="form-label">Confirmar Contraseña</label>
                                						<input type="password" class="form-control" id="password_hash_confirmed" />
                                					</div>
                                				</div>
                                				<div class="col-xxl-3 col-md-6">
                                					<div>
                                						<label for="labelInput" class="form-label">&nbsp;</label>
                                						<button type="button" id="btnguardar" class="form-control btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Guardar</button>
                                					</div>
                                				</div>
                                			</div>
                                		</div>
                                	</div>
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
    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="perfil.js"></script>
</body>
</html>
<?php
}else{
    header("Location:".Connect::route().'/index.php');
    exit;
}
?>