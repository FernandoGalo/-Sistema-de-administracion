<?php 
//Controladores importantes
 require '../../conexion_BD.php'; 
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
        <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Mantenimiento Proyectos</h1>
                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-account-add"></i>Agregar Usuario</button>
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
                            <th>ID</th>
                            <th>Nombre del proyecto</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha final</th>
                            <th>Fondos proyecto</th>
                            <th>Estado Proyecto</th>
                            <th>Acciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>

                          <tfoot>
                          <?php
                          $sql="SELECT * from tbl_proyectos";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_proyecto']?></td> 
                              <td><?php echo $mostrar['Nombre_del_proyecto']?></td> 
                              <td><?php echo $mostrar['Fecha_de_inicio_P']?></td>
                              <td><?php echo $mostrar['Fecha_final_P']?></td>
                              <td><?php echo $mostrar['Fondos_proyecto']?></td>
                              <td><?php echo $mostrar['Estado_Proyecto']?></td>
                              <td>
                              <a href='Update_Donan.php?ID_proyecto=<?php echo $mostrar['ID_proyecto']; ?>' class='boton-editar'>
                              <i class='zmdi zmdi-edit'></i>
                              </a>
                              <a href='Delete_Donan.php?ID_proyecto=<?php echo $mostrar['ID_proyecto']; ?>' onclick='return confirmar()' class='boton-eliminar'>
                              <i class='zmdi zmdi-delete'></i>
                              </a>
                              <a href='ProyectosGest.php?ID_proyecto=<?php echo $mostrar['ID_proyecto']; ?>' class='boton-ver'>
                              <i class='zmdi zmdi-eye'></i>
                              </a>
                            </td>
                             </tr>
                            <?php
                             }
                             ?> 



                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" action="Insert_Usuarios.php" method="POST">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Usuario(*):</label>
                            <input type="hidden" name="Usuario" id="Usuario">
                            <input style="text-transform:uppercase" type="text" class="form-control" name="Usuario" id="Usuario" maxlength="100" placeholder="Ingrese el nombre de Usuario" onkeypress="validarMayusculas(event)" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre Usuario(*):</label>
                            <input type="hidden" name="Nombre_Usuario" id="Usuario">
                            <input type="text" class="form-control" name="Nombre_Usuario" id="Nombre_Usuario" maxlength="100" placeholder="Ingrese el nombre usuario" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Rol de usuario:</label>
                           <!-- <input type="number" min="1" max="3" class="form-control" name="Rol" id="Rol" maxlength="1" placeholder="1:Administrador 2:Editor 3:Supervisor">  -->
                            <select class="form-control" name="Rol" id="Rol" required>
                              <option value="">Selecione un Rol</option>
                              <option value= 1 >ADMINISTRADOR</option>
                              <option value= 2 >EDITOR</option>
                              <option value= 3 >SUPERVISOR</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Correo electronico(*):</label>
                            <input type="hidden" name="Correo_electronico" id="Correo_electronico">
                            <input type="text" class="form-control" name="Correo_electronico" id="Correo_electronico" maxlength="100" placeholder="Ingrese el correo electronico" onkeypress="validarCorreo(event)" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="contraseña">Contraseña</label>
                          <div class="input-group">
                          <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Ingrese su contraseña" onkeypress="return bloquearEspacio(event);" required>
                           <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="button" id="ver-ocultar" onclick="mostrarContrasena()">
                          <i class="zmdi zmdi-eye"></i>
                          </button>
                         </div>
                         </div>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Fecha de Vencimiento(*):</label>
                            <input type="hidden" name="FechaVencimiento" id="FechaVencimiento">
                            <input type="date" value="<?php echo $R_F_Vencida?>" class="form-control" name="FechaVencimiento" id="FechaVencimiento" maxlength="100" placeholder="Ingrese la fecha de Vencimiento" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Estado(*)</label>
                            <input type="text" class="form-control" name="Estado_actual" id="Estado_actual" maxlength="100" value="NUEVO" readonly>
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
  <script src="../../js/events.js"></script>
 	<script src="../../js/jquery-3.1.1.min.js"></script>
	<script src="../../js/main.js"></script>
  <script src="../../js/usuario.js"></script>

</body>
</html>