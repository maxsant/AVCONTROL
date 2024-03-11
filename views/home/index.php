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