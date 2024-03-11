<?php

require_once('../../config/connection.php');

if(!empty($_SESSION['id'])){
?>
<!DOCTYPE html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
	<title>inicio</title>
	<?php
	require_once('../html/head.php');
	?>
	
	<!-- jsvectormap css  -->
	<link href="../../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css">
	<!-- Swiper slider css  -->
	<link href="../../assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div class="layout-wrapper">
		<?php
		require_once("../html/header.php");
		require_once("../html/menu.php");
		?>
		<div class="main-content">
			<div class="page-content">
				<div class="row">
					<div class="col-12">
						<div class="page-title-box d-sm-flex align-items-center justify-content-between">
							<h4>Dashboard</h4>
							<div class="page-title-right">
								<ol class="breadcrumb m-0">
									<li class="breadcrumb-item"><a href="javascript:void(0);">Menu</a></li>
									<li class="breadcrumb-item active">Dashboard</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?php
    require_once("../html/js.php");
    ?>
    
    <!-- apexcharts -->
    <script src="../../assets/libs/apexcharts/apexcharts.min.js"></script>
    
    <!-- Vector map-->
    <script src="../../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../../assets/libs/jsvectormap/maps/world-merc.js"></script>
    
    <!--Swiper slider js-->
    <script src="../../assets/libs/swiper/swiper-bundle.min.js"></script>
    
    <!-- Dashboard init -->
    <script src="../../assets/js/pages/dashboard-ecommerce.init.js"></script>
    
    <!-- Chart JS -->
    <script src="../../assets/libs/chart.js/chart.min.js"></script>
    
    <script src="../../assets/js/pages/chartjs.init.js"></script>
    
    <script type="text/javascript" src="home.js"></script>
</body>
</html>
<?php
}else{
    header("Location:".Connect::route().'/index.php');
    exit;
}
?>