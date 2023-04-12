<?php 
//Controladores importantes
 require '../../conexion_BD.php';     
 $usuario=$_SESSION['user'];
 $ID_Rol=$_SESSION['ID_Rol'];
?>

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
					<img src="../../img/avatar.jpg" alt="UserIcon">
					<figcaption class="text-center text-titles"><?php echo $usuario; ?></figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="../conf/gestion.php">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
					    <a href="#!" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- Menu de la barra lateral -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
			<li>
					<a href="../Home/home.php">
						<i class="zmdi zmdi-home"></i> Home
					</a>
			</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Usuarios/usuariosAdm.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Mantenimiento usuarios</a>
						</li>
					</ul>
				</li>
				<?php $sql=$conexion->query("SELECT * FROM tbl_ms_usuario where Usuario='$usuario' and ID_Rol=1 ");
if ($datos=$sql->fetch_object()) { ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Seguridad <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Seguridad/bitacora.php"><i class="zmdi zmdi-assignment-o"></i> Bitacora </a>
						</li>
						<li>
							<a href="../seguridad/ParametrosAdm.php"><i class="zmdi zmdi-archive"></i> Parametros </a>
						</li>
						<li>
							<a href="../seguridad/PreguntasAdm.php"><i class="zmdi zmdi-view-list"></i> Preguntas </a>
						</li>
						<li>
							<a href="../seguridad/RolesAdm.php"><i class="zmdi zmdi-face"></i> Roles </a>
						</li>
					</ul>
				</li>
				<?php } ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Proyectos <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../proyectos/proyectosAdm.php"><i class="zmdi zmdi-markunread-mailbox"></i> Mantenimiento Proyectos </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-money-box"></i> Fondos <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Fondos/FondosAdm.php"><i class="zmdi zmdi-assignment-returned"></i> Mantenimiento Fondos </a>
						</li>
						<li>
							<a href="../Fondos/DonacAdm.php"><i class="zmdi zmdi-favorite"></i> Donaciones </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-accounts"></i> Voluntarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Voluntarios/VoluntariosAdm.php"><i class="zmdi zmdi-accounts-list-alt"></i> Mantenimiento voluntarios </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-money"></i> Pagos <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../pagos/PagosAdm.php"><i class="zmdi zmdi-money-box"></i> Mantenimiento pagos </a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-money"></i> SAR <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../SAR/SAR_Adm.php"><i class="zmdi zmdi-file zmdi-hc-fw"></i> Mantenimiento SAR </a>
						</li>
					</ul>
				</li>
				
			</ul>
		</div>
	</section>

    <!--script en java para los efectos-->
	<script src="../../js/sweetalert2.min.js"></script>