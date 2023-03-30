<?php

require '../conexion_BD.php';
session_start();
include("../EVENT_BITACORA.PHP");

?>


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
	<section class="full-box cover dashboard-sideBar">
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
						<a href="../Pantallas/Login.php" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- Menu de la barra lateral -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
			<li>
					<a href="../Pantallas/home.php">
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
							<a href="Bitacora.php"><i class="zmdi zmdi-assignment-o"></i> Bitacora </a>
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
        <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Bitacora</h1>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-hover">
                        
                        <!-- Buscar -->
                        <form action="" method="post">
                            <label for="campo">Buscar:</label>
                            <input type="text" name="campo" id="campo">
                          </form>

                        <thead>
                            <th>ID bitacora</th>
                            <th>fecha</th>
                            <th>Usuario</th>
                            <th>Objeto</th>
                            <th>Accion</th>
                            <th>Descripcion</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
            $sql="SELECT b.ID_Bitacora,b.Fecha, u.Usuario, o.Objeto, b.Accion, b.Descripcion 
			from tbl_ms_bitacora b
			JOIN tbl_objetos o ON b.ID_Objeto = o.ID_Objeto
			JOiN tbl_ms_usuario u ON b.ID_Usuario = u.ID_Usuario
			ORDER BY fecha DESC";
            $result=mysqli_query($conexion,$sql);

            while($mostrar=mysqli_fetch_array($result)){
                ?>

                <tr> 
                    <td><?php echo $mostrar['ID_Bitacora']?></td>
                    <td><?php echo $mostrar['Fecha']?></td>
                    <td><?php echo $mostrar['Usuario']?></td>
                    <td><?php echo $mostrar['Objeto']?></td>
                    <td><?php echo $mostrar['Accion']?></td>
                    <td><?php echo $mostrar['Descripcion']?></td>
                </tr>
             <?php
            }
             ?>     
                          </tfoot>
                        </table>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
		</div>
	</section>


	
	<!--script en java para los efectos-->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/main.js"></script>
</body>
</html>