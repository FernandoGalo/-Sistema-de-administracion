<?php
require '../../conexion_BD.php';
/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */
require_once "../../EVENT_BITACORA.php";
session_start();
$usuario=$_SESSION['user'];
$ID_usuario = $_SESSION['ID_User'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
  
<script>
function Editar_Boton(){
  var input1 = document.getElementById("N_U_Imput");
  var input2 = document.getElementById("U_Imput");
  var input3 = document.getElementById("C_E_Imput");
  var boton1 = document.getElementById("boton1");
  var boton2 = document.getElementById("boton2");
  var boton3 = document.getElementById("boton3");
  boton1.style.display = "none";
  boton2.style.display = "block";
  boton3.style.display = "block";
  input1.readOnly = false;
  input2.readOnly = false;
  input3.readOnly = false;
}
function Cancelar_Boton(){
  location.reload();
}
function opencontra() {
  // Definir las dimensiones de la ventana emergente
  var width = 400;
  var height = 400;

  // Obtener un identificador único para la ventana emergente
  var id = Date.now();

  // Obtener la URL de la página que se desea abrir en la ventana emergente
  var url = 'cambio_Contra_admin.php';

  // Abrir la ventana emergente
  window.open(url, id, 'width=' + width + ',height=' + height);
}
</script>
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
                    <?php 
                    
            $sql="SELECT * FROM tbl_ms_usuario where ID_Usuario='".$ID_usuario."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);

            $Nombre_Usuario=$fila['Nombre_Usuario'];
            $Usuario=$fila['Usuario'];
            $Contraseña=$fila['Contraseña'];
            $Correo_electronico=$fila['Correo_electronico'];
            mysqli_close($conexion);
            ?>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
  <form action2="controlador_Informacion_personal.php" method="post">
    <h3>Informacion personal</h3>
    <h3></h3>
    <h3>Nombre del usuario</h3>
    <input type="text" id="N_U_Imput" name="N_U_Imput" value="<?php echo $Nombre_Usuario ?>" readonly require>
    <h3>usuario</h3>
    <input type="text" id="U_Imput" name="U_Imput" value="<?php echo $Usuario ?>" readonly require>
    <h3>Correo electronico</h3>
    <input type="text" id="C_E_Imput" name="C_E_Imput" value="<?php echo $Correo_electronico ?>" readonly require>
    <h1></h1>
    <button id="boton2" name="boton2" style="display: none;"> Guardar Cambios</button> 
  </form>
  
    <h3></h3>
    <button id="boton1" onclick="Editar_Boton()">Editar Informacion Personal</button>  
    <button id="boton3" style="display: none;" onclick="Cancelar_Boton()">Cancelar Cambios</button> 
    <h3>Seguridad</h3>
    <h3>contraseña</h3>
    <input type="password" value="<?php echo $Contraseña ?>">
    <h3></h3>
    <button onclick="opencontra()">Cambiar contraseña</button>
</div>

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
