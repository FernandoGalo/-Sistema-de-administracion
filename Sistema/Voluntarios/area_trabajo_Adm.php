<?php

require '../../conexion_BD.php';

/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */

require_once "../../EVENT_BITACORA.php";




//Parte 2
                
$R_Fecha_actual = date('Y-m-d');       /*obtiene la fecha actual*/
session_start();     
$usuario=$_SESSION['user'];
$ID_Rol=$_SESSION['ID_Rol'];

$sql1=$conexion->query("SELECT * FROM `tbl_ms_parametros` WHERE ID_Parametro=7");

    while($row=mysqli_fetch_array($sql1)){
    $diasV=$row['Valor'];
    }
$R_F_Vencida= date("Y-m-j",strtotime($R_Fecha_actual."+ ".$diasV." days")); /*le suma 1 mes a la fecha actual*/
//fin parte 2


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function confirmar(){
      return confirm('¿Está Seguro?, se eliminará el area trabajo');
    }
  </script>
<script>
function redirigirProyectos() {
  var url = "../Proyectos/ProyectosAdm.php";
  if (url) {
    window.location.href = url;
  }
}

function redirigirVoluntarios() {
  var url = "VoluntariosAdm.php";
  if (url) {
    window.location.href = url;
  }
}
</script>
</head>
<body>
	<!--Seccion donde va toda la barra lateral -->
	<?php include '../sidebarpro.php'; ?>

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
                          <h1 class="box-title">Mantenimiento de las areas de trabajos</h1>
                          <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Insercion=1 and ID_Rol=$ID_Rol and ID_Objeto=14");
if ($datos=$sql->fetch_object()) { ?>

                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-account-add"></i> Agregar Fondo</button>
                          <button id="proyectos-btn" onclick="redirigirProyectos()">Ir a Proyectos</button>
                          <button id="Voluntarios-btn" onclick="redirigirVoluntarios()">Ir a Voluntarios</button>
                          <div class="box-tools pull-right">
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_consultar=1 and ID_Rol=$ID_Rol and ID_Objeto=14 ");
if ($datos=$sql->fetch_object()) { ?>
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-hover">
                        
                        <!-- Buscar -->
                        <form action="" method="post">
                            <label for="campo">Buscar:</label>
                            <input type="text" id="buscador" onkeyup="buscarTabla()" placeholder="Buscar...">
                        </form>
                        <thead>
                            <th>ID del Area de Trabajo</th>
                            <th>nombre del Area de Trabajo</th>
                            <th>descripcion del Area de trabajo</th>
                            <th>acciones </th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
                          $sql="SELECT ID_Area_Trabajo ,nombre_Area_Trabajo, descripcion_A_Trabajo
                          FROM tbl_area_trabajo ";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_Area_Trabajo']?></td> 
                              <td><?php echo $mostrar['nombre_Area_Trabajo']?></td>
                              <td><?php echo $mostrar['descripcion_A_Trabajo']?></td>
                              <td>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Actualizacion=1 and ID_Rol=$ID_Rol and ID_Objeto=14");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Update_area_trabajo_Adm.php?ID_Area_Trabajo=<?php echo $mostrar['ID_Area_Trabajo']; ?>' class='boton-editar'>
                              <i class='zmdi zmdi-edit'></i>
                                <?php } ?>
                              </a>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Eliminacion=1 and ID_Rol=$ID_Rol and ID_Objeto=14");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Delete_area_trabajo.php?ID_Area_Trabajo=<?php echo $mostrar['ID_Area_Trabajo']; ?>' onclick='return confirmar()' class='boton-eliminar'>
                              <i class='zmdi zmdi-delete'></i>
                              <?php } ?>
                              </a>
                            </td>
                             </tr>
                            <?php
                             }
                             ?>     
                          </tfoot>
                        </table>
                    </div>
                    <?php } ?>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" action="Insert_area_trabajo.php" method="POST">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>nombre del Area de Trabajo</label>
                            <input type="text" class="form-control"  name="nombre_Area_Trabajo" id="nombre_Area_Trabajo" placeholder="Ingrese el nombre del Area de Trabajo" require>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>descripcion del Area de Trabajo</label>
                            <input type="text" class="form-control"  name="descripcion_A_Trabajo" id="descripcion_A_Trabajo" placeholder="Ingrese la descripcion del Area de Trabajo" require>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar_F" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
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
  <script src="../../js/Buscador.js"></script>
  <script src="../../js/events.js"></script>
 	<script src="../../js/jquery-3.1.1.min.js"></script>
	<script src="../../js/main.js"></script>
  <script src="../../js/usuario.js"></script>
  
</body>
</html>