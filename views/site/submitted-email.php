<?php

require_once("../../config/connection.php");

?>

<!DOCTYPE html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
	<?php
	require_once("../html/head.php");
	?>
	<title>AVCONTROL</title>
</head>
<body>

	<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
		<div class="bg-overlay"></div>
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="p-lg-5 p-4">
                                	<div>
                                    	<h5 class="text-primary">Bienvenido !</h5>
                                        <p class="text-muted">Confirmacion de Correo Electronico</p>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <h1>Reenvio de correo electronico para usuario</h1>
                                        <?php
                                        if(isset($_GET['msg'])){
                                            switch($_GET['msg'])
                                            {
                                                case "1":
                                                ?>
                                                	<div class="alert alert-warning alert-icon alert-close" role="alert">
                                                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">X</button>
                                                     	<i class="font-icon font-icon-warning"></i>
                                                		Se requiere un token de verificacion
                                                	</div>
                                                <?php
                                                break;
                                                case "2":
                                                    ?>
                                                	<div class="alert alert-warning alert-icon alert-close" role="alert">
                                                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">X</button>
                                                     	<i class="font-icon font-icon-warning"></i>
                                                		El usuario se encuentra validado
                                                	</div>
                                                <?php
                                                break;
                                                case "3":
                                                    ?>
                                                	<div class="alert alert-warning alert-icon alert-close" role="alert">
                                                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">X</button>
                                                     	<i class="font-icon font-icon-warning"></i>
                                                		El token que esta utilizando esta vencido. Por favor, pida otra confirmacion
                                                	</div>
                                                <?php
                                                break;
                                            }
                                        }
                                        ?>
                                        <form action="" method="post" id="submitEmail_form">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Correo Electronico</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese su correo">
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" id="btnsubmitemail" type="submit">Enviar Correo</button>
                                            </div>
                                            
                                            <div class="mt-4">
                                                <a href="../../index.php" id="btnregister">Regresar</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                         	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>document.write(new Date().getFullYear())</script> AVCONTROL. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>	
	</div>

	<?php
	require_once("../html/js.php");
	?>
    <script src="site.js" type="text/javascript"></script>
</body>
</html>