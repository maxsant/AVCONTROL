<div class="app-menu navbar-menu">

    <div class="navbar-brand-box">

        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="https://firebasestorage.googleapis.com/v0/b/avcontrol-3dbb7.appspot.com/o/avcontrol_logo.png?alt=media&token=820276d1-4bb4-446e-9862-a8996156021c" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="https://firebasestorage.googleapis.com/v0/b/avcontrol-3dbb7.appspot.com/o/avcontrol_logo.png?alt=media&token=820276d1-4bb4-446e-9862-a8996156021c" alt="" height="17">
            </span>
        </a>

        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="https://firebasestorage.googleapis.com/v0/b/avcontrol-3dbb7.appspot.com/o/avcontrol_logo.png?alt=media&token=820276d1-4bb4-446e-9862-a8996156021c" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="https://firebasestorage.googleapis.com/v0/b/avcontrol-3dbb7.appspot.com/o/avcontrol_logo.png?alt=media&token=820276d1-4bb4-446e-9862-a8996156021c" alt="" height="17">
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>

    </div>

    <div id="scrollbar">

        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                	<li class="nav-item">
                        <a class="nav-link menu-link" href="../home/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Dashboard</span>
                        </a>
                    </li>
         		<?php if($_SESSION['role_id'] == 1){ ?>
                <li class="menu-title"><span data-key="t-menu">Mantenimiento</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="../users/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Usuarios</span>
                        </a>
                    </li>
         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../identifications/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Identificaciones</span>
                        </a>
                    </li>
         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../roles/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Roles</span>
                        </a>
                    </li>
         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../chickens/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Gallinas</span>
                        </a>
                    </li>
         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../foods/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Alimentos</span>
                        </a>
                    </li>
         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../eggProductionRecords/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Produccion Huevos</span>
                        </a>
                    </li>
         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../farms/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Granjas</span>
                        </a>
                    </li>
         			         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../productTypes/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Tipo Productos</span>
                        </a>
                    </li>
         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../products/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Productos</span>
                        </a>
                    </li>
         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../productFarms/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Producto Granja</span>
                        </a>
                    </li>
         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../payments/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Metodos Pago</span>
                        </a>
                    </li>
         			<li class="nav-item">
                        <a class="nav-link menu-link" href="../suppliers/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Proveedores</span>
                        </a>
                    </li>
         		<?php }else if($_SESSION['role_id'] == 2){ ?>
         		     <li class="menu-title"><span data-key="t-menu">Compra</span></li>
         		     	<li class="nav-item">
                        <a class="nav-link menu-link" href="../purchases/">
                            <i class="ri-honour-line"></i> <span data-key="t-widgets">Nueva Compra</span>
                        </a>
                    </li>
         		<?php }?>
                <li class="menu-title"><span data-key="t-menu">Compra</span></li>
                <li class="menu-title"><span data-key="t-menu">Venta</span></li>
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>