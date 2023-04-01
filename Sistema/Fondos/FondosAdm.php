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
  <script type="text/javascript">
    function confirmar(){
      return confirm('¿Está Seguro?, se eliminará el Fondo');
    }
  </script>
</head>
<body>
	<!--Seccion donde va toda la barra lateral -->
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
        <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Mantenimiento de fondos</h1>
                          <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Insercion=1 and ID_Rol=$ID_Rol ");
if ($datos=$sql->fetch_object()) { ?>
                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-account-add"></i>Agregar Fondo</button>
                          <div class="box-tools pull-right">
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_consultar=1 and ID_Rol=$ID_Rol ");
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
                            <th>Donante</th>
                            <th>proyecto</th>
                            <th>usuario</th>
                            <th>Fecha adquisicion_F</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
                          $sql="SELECT f.ID_de_fondo, d.Nombre_D, p.Nombre_del_proyecto, u.Nombre_Usuario, f.Fecha_de_adquisicion_F
                          FROM tbl_fondos f
                          JOIN tbl_donantes d ON f.ID_Donante = d.ID_Donante
                          JOIN tbl_proyectos p ON f.ID_de_proyecto = p.ID_proyecto
                          JOIN tbl_ms_usuario u ON f.ID_usuario = u.ID_Usuario";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_de_fondo']?></td> 
                              <td><?php echo $mostrar['Nombre_D']?></td> 
                              <td><?php echo $mostrar['Nombre_del_proyecto']?></td>
                              <td><?php echo $mostrar['Nombre_Usuario']?></td>
                              <td><?php echo $mostrar['Fecha_de_adquisicion_F']?></td>
                              <td>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Actualizacion=1 and ID_Rol=$ID_Rol");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Update_Fondo.php?ID_de_fondo=<?php echo $mostrar['ID_de_fondo']; ?>' class='boton-editar'>
                              <i class='zmdi zmdi-edit'></i> Editar
                                <?php } ?>
                              </a>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Eliminacion=1 and ID_Rol=$ID_Rol ");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Delete_Fondo.php?ID_de_fondo=<?php echo $mostrar['ID_de_fondo']; ?>' onclick='return confirmar()' class='boton-eliminar'>
                              <i class='zmdi zmdi-delete'></i> Eliminar
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
                            <label>ID del fondo(*):</label>
                            <input type="hidden" name="ID_Fondo" id="ID_Fondo">
                            <input style="text" type="text" class="form-control" name="ID_Fondo" id="ID_Fondo" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  placeholder="Ingrese el ID del fondo" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Donante(*):</label>
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
                            <label>Proyecto(*):</label>
                            <?php
                           $sql2=$conexion->query("SELECT * FROM tbl_proyectos");
                          ?>
                            <select class="controls" type="text" name="Proyecto" id="Proyecto" required ><br>
                           <?php
                            while($row1=mysqli_fetch_array($sql2)){
                            ?>
                             <option value="<?php echo $row1['ID_proyecto'];?>"><?php echo $row1['Nombre_del_proyecto'];?></option>
                            <?php
                             }
                            ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Usuario</label>
                            <input type="text" class="form-control"  name="Usuario" id="Usuario" maxlength="100" placeholder="<?php echo $usuario?>" style="text-transform:uppercase" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Fecha de Adquisicion:</label>
                            <input type="date" class="form-control" name="FechaAdquisicion" id="FechaAdquisicion" maxlength="100" placeholder="Ingrese la Fecha de Adquisicion">
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