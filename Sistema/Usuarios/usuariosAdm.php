<script>
function buscarTabla() {
  // Obtener el valor del campo de entrada
  var valorBuscado = document.getElementById("buscador").value.toLowerCase();
  
  // Obtener la tabla
  var tabla = document.getElementById("tbllistado");

  // Obtener todas las filas de la tabla, excepto la fila de encabezado
  var filas = tabla.getElementsByTagName("tr");
  
  // Recorrer todas las filas de la tabla y comprobar si coinciden con el valor buscado
  for (var i = 0; i < filas.length; i++) {
    var mostrarFila = false;
    
    // Obtener todas las celdas de la fila actual
    var celdas = filas[i].getElementsByTagName("td");
    
    // Recorrer todas las celdas de la fila y comprobar si alguna coincide con el valor buscado
    for (var j = 0; j < celdas.length; j++) {
      var celda = celdas[j];
      if (celda) {
        var contenidoCelda = celda.innerHTML.toLowerCase();
        if (contenidoCelda.indexOf(valorBuscado) > -1) {
          mostrarFila = true;
          break;
        }
      }
    }
    
    // Mostrar u ocultar la fila según si se encontró una coincidencia o no
    if (mostrarFila) {
      filas[i].style.display = "";
    } else {
      filas[i].style.display = "none";
    }
  }
}
</script>
<?php


require '../../conexion_BD.php';
/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */

require_once "../../EVENT_BITACORA.php";





//Parte 2
                
$R_Fecha_actual = date('Y-m-d');       /*obtiene la fecha actual*/


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
      return confirm('¿Está Seguro?, se eliminará el usuario');
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
                          <h1 class="box-title">Mantenimiento usuarios</h1>
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
                        
                        <thead >
                        
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>correo electronico</th>
                            <th>Contraseña</th>
                            <th>Fecha Creacion</th>
                            <th>Fecha Vencimiento </th>
                            <th>Estado del usuario</th>
                            <th>Acciones</th>
                            <form action="" method="post">
                            <label for="campo">Buscar:</label>
                            <input type="text" name="buscador" id="buscador" onkeyup="buscarTabla()">
                          </form>
                          </thead>
                          <tbody>                      
                          </tbody>
                          <tfoot>

                          <?php
                          $sql="SELECT u.ID_Usuario, u.Usuario, u.Nombre_Usuario, r.Rol, u.Correo_electronico, u.Contraseña, u.Fecha_Creacion, u.Fecha_Vencimiento, u.Estado_Usuario
                          FROM tbl_ms_usuario u
                          JOIN tbl_ms_roles r ON u.ID_Rol = r.ID_Rol";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_Usuario']?></td> 
                              <td><?php echo $mostrar['Usuario']?></td> 
                              <td><?php echo $mostrar['Nombre_Usuario']?></td>
                              <td><?php echo $mostrar['Rol']?></td>
                              <td><?php echo $mostrar['Correo_electronico']?></td>
                              <td><?php echo $mostrar['Contraseña']?></td>
                              <td><?php echo $mostrar['Fecha_Creacion']?></td>
                              <td><?php echo $mostrar['Fecha_Vencimiento']?></td>
                              <td><?php echo $mostrar['Estado_Usuario']?></td>
                              <td>
                              <a href='Update_Usuarios.php?ID_Usuario=<?php echo $mostrar['ID_Usuario']; ?>' class='boton-editar'>
                              <i class='zmdi zmdi-edit'></i> Editar
                              </a>
                              <a href='Delete_Usuarios.php?Usuario=<?php echo $mostrar['Usuario']; ?>' onclick='return confirmar()' class='boton-eliminar'>
                              <i class='zmdi zmdi-delete'></i> Eliminar
                              </a>
                            </td>
                             </tr>
                            <?php
                             }
                             ?>     
                          </tfoot>
                        </table >
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
  
 	<script src="../../js/jquery-3.1.1.min.js"></script>
  <script src="../../js/events.js"></script>
	<script src="../../js/main.js"></script>
  <script src="../../js/usuario.js"></script>

</body>
</html>