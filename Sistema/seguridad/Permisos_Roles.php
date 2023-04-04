<?php


require '../../conexion_BD.php';
/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */

require_once "../../EVENT_BITACORA.php";
session_start();     
$usuario=$_SESSION['usuario'];

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
                          <h1 class="box-title">Permisos Roles de Usuarios</h1>
                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-account-add"></i>Agregar Rol</button>
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
                            <input type="text" id="buscador" onkeyup="buscarTabla()" placeholder="Buscar...">
                        </form>
                        <thead>
                         <tr>
                            <th>#</th>
                            <th>Modulo</th>
                            <th>Leer</th>
                            <th>Insertar</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                         </tr>
                        </thead>
                          <tbody> 
                            <tr>
                              <td>tbl_Usuario</td>
                                <td>
                                <?php 
                                $sql = ("SELECT * FROM tbl_permisos WHERE ID_Rol=1 and ID_Objeto=3");
                                $resultado=mysqli_query($conexion,$sql);

                                $row = mysqli_fetch_assoc($resultado);
                                $LeerV = $row['Permiso_Insercion'];
                                echo $LeerV;
                                ?>
                                       
                                    <div class="switch">
                                    <input type="checkbox" id="switch1" name="switch1" class="switch-input">
                                    <label for="switch1" class="switch-label"></label>
                                    </div>
                                    <!-- <div class="switch">
                                    <input type="checkbox" id="switch1" name="switch1" class="switch-input">
                                    <label for="switch1" class="switch-label"></label>
                                    </div> -->
                                </td>

                                <td>
                                <div class="switch">
                                    <input type="checkbox" id="switch2" name="switch2" class="switch-input">
                                    <label for="switch2" class="switch-label"></label>
                                    </div>
                                </td>

                                <td>
                                <div class="switch">
                                    <input type="checkbox" id="switch3" name="switch3" class="switch-input">
                                    <label for="switch3" class="switch-label"></label>
                                    </div>
                                </td>

                                <td>
                                <div class="switch">
                                    <input type="checkbox" id="switch4" name="switch4" class="switch-input">
                                    <label for="switch4" class="switch-label"></label>
                                    </div>
                                </td>

                                <td>
                                <div class="switch">
                                    <input type="checkbox" id="switch5" name="switch5" class="switch-input">
                                    <label for="switch5" class="switch-label"></label>
                                    </div>
                                </td>

                                <td>
                                    <div class="switch">
                                    <input type="checkbox" id="switch6" name="switch6" class="switch-input">
                                    <label for="switch6" class="switch-label"></label>
                                    </div>
                                </td>
                            </tr>                           
                          </tbody>
                        </table>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" name="enviar" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="zmdi zmdi-close-circle"></i> Cancelar</button>
                        </div>



                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" action="Insert_Roles.php" method="POST">
                        <div class="container">
                          <div class="row">

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre rol(*):</label>
                            <input type="hidden" name="Nombre_rol" id="Nombre_rol">
                            <input type="text" class="form-control" name="Nombre_rol" id="Nombre_rol" maxlength="100" placeholder="Ingrese el nombre del Rol" onkeypress="validarMayusculas(event)" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Descripcion(*):</label>
                            <input type="hidden" name="descripcion" id="descripcion">
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="100" placeholder="Ingrese la descripcion del rol" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Estado:</label>
                           <!-- <input type="number" min="1" max="3" class="form-control" name="Rol" id="Rol" maxlength="1" placeholder="1:Administrador 2:Editor 3:Supervisor">  -->
                            <select class="form-control" name="estado" id="estado" required>
                              <option value="">Selecione un estado</option>
                              <option value="1" >ACTIVO</option>
                              <option value="2" >INACTIVO</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
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
  <script src="../../js/jquery-3.1.1.min.js"></script>
  <script src="../../js/events.js"></script>
	<script src="../../js/main.js"></script>
  <script src="../../js/usuario.js"></script>

</body>
</html>