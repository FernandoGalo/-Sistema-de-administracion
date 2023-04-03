<?php


require '../../conexion_BD.php';
/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */

require_once "../../EVENT_BITACORA.php";
session_start();     
$usuario=$_SESSION['usuario'];
$ID_Rol = $_GET['ID_Rol'];
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
	<link rel="stylesheet" href="../../css/estiloCheckboxes.css">
  <script type="text/javascript">
    function confirmar(){
      return confirm('¿Está Seguro?, se eliminará el rol');
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
                          <h1 class="box-title">Permisos del rol <?php echo $ID_Rol; ?></h1>
                          <div class="box-tools pull-right">
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-hover">
                        
                        <!-- Buscar -->
                        <thead>
                         <tr>
                            <th>Tablas</th>
                            <th>Leer</th>
                            <th>Insertar</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                         </tr>
                        </thead>
                          <tbody> 
                            <tr>
                                <?php 
                                $sql="SELECT o.Objeto,p.Permiso_consultar, p.Permiso_Insercion,
                                p.Permiso_Actualizacion, p.Permiso_Eliminacion  from tbl_permisos p
                                JOIN tbl_objetos o ON o.ID_Objeto = p.ID_Objeto
                                where ID_Rol=$ID_Rol";
                                $result=mysqli_query($conexion,$sql);

                               while($mostrar=mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                <td><?php echo $mostrar['Objeto']?></td>
                                <?php if($mostrar['Permiso_consultar'] == 1){
                                echo '<td><input type="checkbox" id="switch2" name="switch2"  value="1" checked></td>';
                                }else{
                                  echo '<td><input type="checkbox" id="switch2" name="switch2" value="1"></td>';
                                } 
                                 ?>
                                <?php if($mostrar['Permiso_Insercion'] == 1){
                                echo '<td><input type="checkbox" id="switch2" name="switch2"  value="1" checked></td>';
                                }else{
                                  echo '<td><input type="checkbox" id="switch2" name="switch2" value="1"></td>';
                                }
                                ?>
                                <?php if($mostrar['Permiso_Actualizacion'] == 1){
                                echo '<td><input type="checkbox" id="switch2" name="switch2"  value="1" checked></td>';
                                }else{
                                  echo '<td><input type="checkbox" id="switch2" name="switch2" value="1"></td>';
                                }
                                ?>
                                 <?php if($mostrar['Permiso_Eliminacion'] == 1){
                                echo '<td><input type="checkbox" id="switch2" name="switch2"  value="1" checked></td>';
                                }else{
                                  echo '<td><input type="checkbox" id="switch2" name="switch2" value="1"></td>';
                                }
                                ?>
                            </tr>
                            <?php
                             }
                             ?>                            
                          </tbody>
                        </table>
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
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