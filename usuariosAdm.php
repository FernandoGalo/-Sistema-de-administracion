<?php

$conexion = new mysqli("localhost", "root", "", "bd_asociacion_creo_en_ti", "3306");
$conexion->set_charset("utf8");
session_start();
require_once "EVENT_BITACORA.php";

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
  <script type="text/javascript">
    function confirmar(){
      return confirm('¿Está Seguro?, se eliminará el usuario');
    }
  </script>
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
					<img src="./img/avatar.jpg" alt="UserIcon">
					<figcaption class="text-center text-titles">Nombre de usuario</figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!">
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
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="usuariosAdm.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Mantenimiento usuarios</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Seguridad <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../Controladores/Bitacora.php"><i class="zmdi zmdi-file zmdi-hc-fw"></i> Bitacora </a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</section>

	<!-- Pagina de contenido-->
	<section class="full-box dashboard-contentPage">
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
                          <h1 class="box-title">Mantenimiento usuarios</h1>
                          <a href="Insert_Usuarios.php">Nuevo Usuario</a>
                          <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="zmdi zmdi-account-add"></i>Agregar Usuario</button>
                          <div class="box-tools pull-right">
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
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>correo electronico</th>
                            <th>Contraseña</th>
                            <th>Fecha Creacion</th>
                            <th>Fecha Vencimiento </th>
                            <th>Estado del usuario</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
                          $sql="SELECT * from tbl_ms_usuario";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_Usuario']?></td> 
                              <td><?php echo $mostrar['Usuario']?></td> 
                              <td><?php echo $mostrar['Nombre_Usuario']?></td>
                              <td><?php echo $mostrar['ID_Rol']?></td>
                              <td><?php echo $mostrar['Correo_electronico']?></td>
                              <td><?php echo $mostrar['Contraseña']?></td>
                              <td><?php echo $mostrar['Fecha_Creacion']?></td>
                              <td><?php echo $mostrar['Fecha_Vencimiento']?></td>
                              <td><?php echo $mostrar['Estado_Usuario']?></td>
                              <td>
                                <?php echo "<a href='Update_Usuarios.php?ID_Usuario=".$mostrar['ID_Usuario']."'>EDITAR</a>"; ?>
                                -
                                <?php echo "<a href='Delete_Usuarios.php?Nombre_Usuario=".$mostrar['Nombre_Usuario']."' onclick='return confirmar()'>ELIMINAR</a>"; ?>
                              </td>
                             </tr>
                            <?php
                             }
                             ?>     
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" action="Agregar.php" method="POST">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>ID:</label>
                            <input type="number" class="form-control" name="ID" id="ID" maxlength="20" placeholder="ID">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Usuario(*):</label>
                            <input type="hidden" name="usuario" id="usuario">
                            <input type="text" class="form-control" name="usuario" id="usuario" maxlength="100" placeholder="Nombre usuario" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre Usuario(*):</label>
                            <input type="hidden" name="nombusu" id="nombusu">
                            <input type="text" class="form-control" name="nombusu" id="nombusu" maxlength="100" placeholder="Nombre usuario" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Rol:</label>
                            <input type="number" class="form-control" name="Rol" id="Rol" maxlength="20" placeholder="Rol">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Correo electronico(*):</label>
                            <input type="hidden" name="correo" id="correo">
                            <input type="text" class="form-control" name="correo" id="correo" maxlength="100" placeholder="Nombre usuario" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Contraseña (*):</label>
                            <input type="password" class="form-control" name="clave" id="clave" maxlength="64" placeholder="Contraseña" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha Creacion:</label>
                            <input type="text" class="form-control" name="Fechacrea" id="Fechacrea" maxlength="20" placeholder="Fecha">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha Vencimiento:</label>
                            <input type="text" class="form-control" name="Fechaven" id="Fechaven" maxlength="20" placeholder="Fecha">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Estado(*):</label>
                            <input type="hidden" name="estado" id="estado">
                            <input type="text" class="form-control" name="estado" id="estado" maxlength="100" placeholder="Nombre usuario" required>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="zmdi zmdi-download"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="zmdi zmdi-close-circle"></i> Cancelar</button>
                          </div>
                          </div>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
		</div>
	</section>


	
	<!--script en java para los efectos-->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/main.js"></script>
    <script src="./js/usuario.js"></script>
</body>
</html>