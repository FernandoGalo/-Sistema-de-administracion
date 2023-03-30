<?php
require '../../conexion_BD.php';
/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */
require_once "../../EVENT_BITACORA.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
  <script type="text/javascript">
    function confirmar(){
      return confirm('¿Está Seguro?, se eliminará el proyecto');
    }
  </script>
</head>

<?php include '../sidebar.php'; ?>

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
			<h1>Aqui irian los parametros</h1>
		</div>
		<div class="container-fluid">
		</div>
	</section>


	
	<!--script en java para los efectos-->
	<script src="../../js/Buscador.js"></script>
	<script src="../../js/jquery-3.1.1.min.js"></script>
	<script src="../../js/events.js"></script>
	<script src="../../js/main.js"></script>
    <script src="../../js/usuario.js"></script>

</body>
</html>
