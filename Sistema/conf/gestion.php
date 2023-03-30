<?php
require '../../conexion_BD.php';
/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */
require_once "../../EVENT_BITACORA.php";
include("../../Controlador_C_contra_admin.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
</head>

<?php include '../sidebar.php'; ?>



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
                          <h1 class="box-title">Gestionar mi perfil</h1>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
                    <form actions2="Controlador_C_contra_admin.php" method="post">
                        <div class="container">
                          <div class="row">
<h3>ingrese su antigua contraseña<h3>
<input class="controls" type="password" maxlength="8" name="C_contra_A" id="C_contra_A" onkeypress="return bloquearEspacio(event)" onpaste="impedirPegar(event)" placeholder="Ingrese su antigua Contraseña"><br>
<h3>ingrese su nueva contraseña</h3> 
<input class="controls" type="password" maxlength="8" name="C_contra_N" id="C_contra_N" onkeypress="return bloquearEspacio(event)" onpaste="impedirPegar(event)" placeholder="Ingrese su nueva Contraseña"><br>
        <h3>ingrese nuevamente su Contraseña</h3>
        <input class="controls" type="password" maxlength="8" name="C_contra_N_2" id="C_contra_N_2" onkeypress="return bloquearEspacio(event)" onpaste="impedirPegar(event)" placeholder="Ingrese nuevamente su nueva Contraseña"><br>
                          <button class="btn btn-primary" type="submit" name="enviar" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="usuariosAdm.php" style="color:white; text-decoration:none;">
                          <i class="zmdi zmdi-close-circle"></i> Cancelar
                          </a>
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
  <script src="../../js/events.js"></script>
  <script src="../../js/jquery-3.1.1.min.js"></script>
  <script src="../../js/main.js"></script>
  <script src="../../js/usuario.js"></script>

</body>
</html>
