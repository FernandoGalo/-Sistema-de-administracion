
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>
	<!--Seccion donde va toda la barra lateral -->
	<section class="full-box cover dashboard-sideBar" style="overflow-y: auto;">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--Muestra el titulo de la barra lateral-->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				Creo en ti <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- Informacion de usuario de la barra lateral -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="../img/avatar.jpg" alt="UserIcon">
					<figcaption class="text-center text-titles">Nombre de usuario</figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="../Sistema/conf/gestion.php">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
                        <a href="Login.php" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- Menu de la barra lateral -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
			<li>
					<a href="home.php">
						<i class="zmdi zmdi-home"></i> Home
					</a>
			</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Sistema/Usuarios/usuariosAdm.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Mantenimiento usuarios</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Seguridad <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Controladores/Bitacora.php"><i class="zmdi zmdi-assignment-o"></i> Bitacora </a>
						</li>
						<li>
							<a href="../Sistema/seguridad/ParametrosAdm.php"><i class="zmdi zmdi-archive"></i> Parametros </a>
						</li>
						<li>
							<a href="../Sistema/seguridad/RolesAdm.php"><i class="zmdi zmdi-face"></i> Roles </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Proyectos <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Sistema/proyectos/proyectosAdm.php"><i class="zmdi zmdi-markunread-mailbox"></i> Mantenimiento Proyectos </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-money-box"></i> Fondos <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Sistema/Fondos/FondosAdm.php"><i class="zmdi zmdi-assignment-returned"></i> Mantenimiento Fondos </a>
						</li>
						<li>
							<a href="../Sistema/Fondos/DonacAdm.php"><i class="zmdi zmdi-favorite"></i> Donaciones </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-accounts"></i> Voluntarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Sistema/Voluntarios/VoluntariosAdm.php"><i class="zmdi zmdi-accounts-list-alt"></i> Mantenimiento voluntarios </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-money"></i> Pagos <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Sistema/pagos/PagosAdm.php"><i class="zmdi zmdi-money-box"></i> Mantenimiento pagos </a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-money"></i> SAR <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Sistema/SAR/SAR_Adm.php"><i class="zmdi zmdi-file zmdi-hc-fw"></i> Mantenimiento SAR </a>
						</li>
					</ul>
				</li>

			</ul>
		</div>
	</section>

	<!-- Pagina de contenido-->
	<section class="full-box dashboard-contentPage" style="overflow-y: auto;">
		<!-- Barra superior -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
			</ul>
		</nav>
		<!-- Muestra el contenido de la pagina -->
		<div class="container-fluid">
			<h1>Sistema Principal</h1>
		</div>
		<div class="container-fluid">
		</div>
	</section>


	
	<!--script en java para los efectos-->
	<script src="../js/usuario.js"></script>
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/main.js"></script>
</body>
</html>