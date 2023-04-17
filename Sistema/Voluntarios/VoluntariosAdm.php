<?php


require '../../conexion_BD.php';
/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */

require_once "../../EVENT_BITACORA.php";
session_start();     
$usuario=$_SESSION['user'];
$ID_Rol=$_SESSION['ID_Rol'];

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
      return confirm('¿Está Seguro?, se eliminará el usuario');
    }
  </script>
    <script>
function redirigirProyectos() {
  var url = "../Proyectos/ProyectosAdm.php";
  if (url) {
    window.location.href = url;
  }
}

function redirigirarea_trabajo() {
  var url = "area_trabajo_Adm.php";
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
                          <h1 class="box-title">Mantenimiento Voluntarios</h1>
                          <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Insercion=1 and ID_Rol=$ID_Rol and ID_Objeto=9");
if ($datos=$sql->fetch_object()) { ?>
                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-account-add"></i> Agregar Voluntario</button>
                          <button id="proyectos-btn" onclick="redirigirProyectos()">Ir a Proyectos</button>
                          <button id="area_trabajo-btn" onclick="redirigirarea_trabajo()">Ir a el area de trabajo</button> 
                          <div class="box-tools pull-right">
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_consultar=1 and ID_Rol=$ID_Rol and ID_Objeto=9");
if ($datos=$sql->fetch_object()) { ?>
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table style="text-align:center" id="tbllistado" class="table table-bordered table-hover">
                        
                        <!-- Buscar -->
                        <form action="" method="post">
                            <label for="campo">Buscar:</label>
                            <input style="margin-bottom: 20px; margin-left: 10px; display: inline-block;"  type="text" id="buscador" onkeyup="buscarTabla()" placeholder="Buscar...">
                        </form>
                        <thead accept-charset="UTF-8">
                        <th style="text-align:center">ID</th>
                            <th style="text-align:center">Nombre voluntario</th>
                            <th style="text-align:center">Telefono voluntario</th>
                            <th style="text-align:center">Direccion voluntario</th>
                            <th style="text-align:center">Acciones</th>
                        </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
                          $sql="SELECT * from tbl_voluntarios";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_Voluntario']?></td> 
                              <td><?php echo $mostrar['Nombre_Voluntario']?></td> 
                              <td><?php echo $mostrar['Telefono_Voluntario']?></td>
                              <td><?php echo $mostrar['Direccion_Voluntario']?></td>
                              <td>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Actualizacion=1 and ID_Rol=$ID_Rol and ID_Objeto=9");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Update_Voluntarios.php?ID_Voluntario=<?php echo $mostrar['ID_Voluntario']; ?>' class='boton-editar'>
                              <i class='zmdi zmdi-edit'></i>
                              <?php } ?>
                              </a>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Eliminacion=1 and ID_Rol=$ID_Rol and ID_Objeto=9");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Delete_Voluntarios.php?ID_Voluntario=<?php echo $mostrar['ID_Voluntario']; ?>' onclick='return confirmar()' class='boton-eliminar'>
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
                        <form name="formulario" id="formulario" action="Insert_Voluntarios.php" method="POST">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            
                            <?php //Me trae el ultimo ID y me suma 1
                                
                                // Conectar a la base de datos
                                require '../../conexion_BD.php';
                                // Crear una consulta para obtener el próximo valor AUTO_INCREMENT para la columna id_parametro
                                $query = "SHOW TABLE STATUS LIKE 'tbl_voluntarios';";
                                $result = mysqli_query($conexion, $query);
                                $row = mysqli_fetch_assoc($result);
                                $next_id = $row['Auto_increment'];

                            ?>
                            <label>ID Voluntario(*):</label>
                            <input type="hidden" name="ID_Voluntario" id="ID_Voluntario">
                            <input class="form-control" name="ID_Voluntario" id="ID_Voluntario" value="<?php echo $next_id; ?>" readonly>
                          </div>
                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>Nombre Voluntario(*):</label>
                            <input type="hidden" name="Nombre_Voluntario" id="Nombre_Voluntario">
                            <input onpaste="return false" style="text-transform:uppercase" type="text" class="form-control" name="Nombre_Voluntario" id="Nombre_Voluntario" maxlength="39" placeholder="Ingrese el nombre del voluntario" onkeypress="this.value = this.value.toUpperCase();" require>
                          </div>
                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>Telefono(*):</label>
                            <input type="hidden" name="Telefono_Voluntario" id="Telefono_Voluntario">
                            <input style="text-transform:uppercase" style="text" type="text" class="form-control" name="Telefono_Voluntario" id="Telefono_Voluntario" maxlength="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  placeholder="Ingrese el numero telefonico del voluntario" required>
                          </div>
                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>Direccion Voluntario(*):</label>
                            <input type="hidden" name="Direccion_Voluntario" id="Direccion_Voluntario">
                            <textarea style="text-transform:uppercase" type="text" class="form-control" name="Direccion_Voluntario" id="Direccion_Voluntario" maxlength="100" placeholder="Ingrese la direccion voluntario"  required></textarea>
                          </div>
                        
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar_V" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
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

