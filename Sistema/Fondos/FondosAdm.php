<?php

require '../../conexion_BD.php';

/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */

require_once "../../EVENT_BITACORA.php";




//Parte 2
                
$R_Fecha_actual = date('Y-m-d');       /*obtiene la fecha actual*/
session_start();     
$usuario=$_SESSION['user'];
$ID_Rol=$_SESSION['ID_Rol'];
$IDProyecto=$_SESSION['ID_Proyect'];
include("../../conexion_BD.php");
    $sql1=$conexion->query("SELECT * FROM `tbl_proyectos` WHERE ID_proyecto='$IDProyecto'");

    while($row=mysqli_fetch_array($sql1)){
        $Nombre_del_proyecto=$row['Nombre_del_proyecto'];
    }
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
  <script type="text/javascript">
    function confirmar(){
      return confirm('¿Está Seguro?, se eliminará el Fondo');
    }
  </script>
<script>
function redirigirProyectos() {
  var url = "../Proyectos/ProyectosAdm.php";
  if (url) {
    window.location.href = url;
  }
}

function redirigirDonaciones() {
  var url = "DonacAdm.php";
  if (url) {
    window.location.href = url;
  }
}


function redirigirTFondos() {
  var url = "Tipo_Fondo_Adm.php";
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
                          <h1 class="box-title">Mantenimiento de fondos</h1>
                          <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Insercion=1 and ID_Rol=$ID_Rol and ID_Objeto=7");
if ($datos=$sql->fetch_object()) { ?>

                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-account-add"></i> Agregar Tipo de Fondo</button>
                          <button id="proyectos-btn" onclick="redirigirProyectos()">Ir a Proyectos </button>
<button id="donaciones-btn" onclick="redirigirDonaciones()">Ir a Donaciones</button>
<button id="T_Fondos-btn" onclick="redirigirTFondos()">Ir a Tipos de Fondos</button>
                          <div class="box-tools pull-right">
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_consultar=1 and ID_Rol=$ID_Rol and ID_Objeto=7 ");
if ($datos=$sql->fetch_object()) { ?>
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-hover">
                        
                        <!-- Buscar -->
                        <form action="" method="post">
                            <label for="campo">Buscar:</label>
                            <input type="text" id="buscador" onkeyup="buscarTabla()" placeholder="Buscar...">
                        </form>
                        <thead>
                            <th>ID fondo</th>
                            <th>Tipo de fondo</th>
                            <th>Nombre_del_Objeto</th>
                            <th>Cantidad_Recibida</th>
                            <th>valor monetario</th>
                            <th>Proyecto</th>
                            <th>Donante </th>
                            <th>Fecha de aquisicion </th>
                            <th>acciones </th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
                          $sql="SELECT f.ID_de_fondo,tf.nombre_T_Fondo,f.Nombre_del_Objeto,f.Cantidad_Rec,f.Valor_monetario, p.Nombre_del_proyecto, d.Nombre_D, f.Fecha_de_adquisicion_F
                          FROM tbl_fondos f 
                          JOIN tbl_tipos_de_fondos tf ON f.ID_Tipo_Fondo = tf.ID_Tipo_Fondo
                          JOIN tbl_donantes d ON f.ID_Donante = d.ID_Donante
                          JOIN tbl_proyectos p ON f.ID_Proyecto = p.ID_proyecto 
                          where f.ID_proyecto=$IDProyecto";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_de_fondo']?></td> 
                              <td><?php echo $mostrar['nombre_T_Fondo']?></td>
                              <td><?php echo $mostrar['Nombre_del_Objeto']?></td>
                              <td><?php echo $mostrar['Cantidad_Rec']?></td>
                              <td><?php echo $mostrar['Valor_monetario']?></td>
                              
                              <td><?php echo $mostrar['Nombre_del_proyecto']?></td>
                              <td><?php echo $mostrar['Nombre_D']?></td> 
                              <td><?php echo $mostrar['Fecha_de_adquisicion_F']?></td>
                              <td>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Actualizacion=1 and ID_Rol=$ID_Rol and ID_Objeto=7");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Update_Fondo.php?ID_de_fondo=<?php echo $mostrar['ID_de_fondo']; ?>' class='boton-editar'>
                              <i class='zmdi zmdi-edit'></i>
                                <?php } ?>
                              </a>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Eliminacion=1 and ID_Rol=$ID_Rol and ID_Objeto=7");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Delete_Fondo.php?ID_de_fondo=<?php echo $mostrar['ID_de_fondo']; ?>' onclick='return confirmar()' class='boton-eliminar'>
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
                        <form name="formulario" id="formulario" action="Insert_Fondo.php" method="POST">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Tipo de Fondo(*):</label>
                            <?php
                           $sql=$conexion->query("SELECT * FROM tbl_tipos_de_fondos");
                          ?>
                            <select class="controls" type="text" name="tipos_de_fondos" id="tipos_de_fondos" required ><br>
                           <?php
                            while($row1=mysqli_fetch_array($sql)){
                            ?>
                             <option value="<?php echo $row1['ID_tipo_fondo'];?>"><?php echo $row1['nombre_T_Fondo'];?></option>
                            <?php
                             }
                            ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre del Objeto</label>
                            <input type="text" class="form-control"  name="Nombre_del_Objeto" id="Nombre_del_Objeto" placeholder="Ingrese el nombre del objeto" require>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Cantidad recibida</label>
                            <input type="text" class="form-control"  name="Cantidad_Rec" id="Cantidad_Rec" placeholder="Ingrese la cantidad de fondos recibidos" require>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Valor monetario</label>
                            <input type="text" class="form-control"  name="Valor_monetario" id="Valor_monetario" placeholder="Ingrese el Valor monetario" require>
                          </div>	
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Donante del fondo:</label>
                            <?php
                           $sql=$conexion->query("SELECT * FROM tbl_donantes");
                          ?>
                            <select class="controls" type="text" name="Donante" id="Donante" required ><br>
                           <?php
                            while($row1=mysqli_fetch_array($sql)){
                            ?>
                             <option value="<?php echo $row1['ID_Donante'];?>"><?php echo $row1['Nombre_D'];?></option>
                            <?php
                             }
                            ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Proyecto al que esta siendo donado:</label>
                            <input type="text" class="form-control"  name="Proyecto" id="Proyecto" placeholder="<?php echo $Nombre_del_proyecto?>" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Usuario</label>
                            <input type="text" class="form-control"  name="Usuario" id="Usuario" maxlength="100" placeholder="<?php echo $usuario?>" style="text-transform:uppercase" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Fecha de Adquisicion:</label>
                            <input type="date" class="form-control" name="FechaAdquisicion" id="FechaAdquisicion" maxlength="100" placeholder="Ingrese la Fecha de Adquisicion" require>
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