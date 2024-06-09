<?php

require_once("../../config/connection.php");

if(!empty($_GET['token'])){
    $token = $_GET['token'];
    require_once("../../models/User.php");
    $user = new User();
    $dataUser = $user->getUserByToken($token);
    if($dataUser['validate'] == 0){
        if($dataUser['email_token'] === $token){
            $emailToken     = str_replace("$", "a", crypt($token.$dataUser['identification'].$dataUser['phone'], '$2a$07$afartwetsdAD52356FEDGsfhsd$'));
            $user->updateTokenUser($dataUser['id'], $emailToken);
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
                                        <h1>Has confirmado correctamente tu correo electronico</h1>
                                        <section class="widget widget-simple-sm-fill-green" style="width: 10rem; margin-left: 430px; border-radius: 5rem;">
                                        	<span>&#10004;</span>
                                        </section>
                                        <div class="mt-4">
                                           	<a href="../../index.php" class="w-100">Regresar</a>
                                        </div>
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
<?php
        }else{
            header("Location:".Connect::route().'/views/site/submitted-email.php?msg=3');
            exit;
        }
    }else{
        header("Location:".Connect::route().'/views/site/submitted-email.php?msg=2');
        exit;
    }
}else{
    header("Location:".Connect::route().'/views/site/submitted-email.php?msg=1');
    exit;
}

?>