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
      return confirm('¿Está Seguro de eliminar la pregunta?');
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
                          <h1 class="box-title">Mantenimiento Preguntas</h1>
                          <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Insercion=1 and ID_Rol=$ID_Rol and ID_Objeto=4");
                            if ($datos=$sql->fetch_object()) { ?>
                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-account-add"></i> Agregar Preguntas</button>
                          <div class="box-tools pull-right">
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_consultar=1 and ID_Rol=$ID_Rol and ID_Objeto=4");
                            if ($datos=$sql->fetch_object()) { ?>
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table style="text-align:center" id="tbllistado" class="table table-bordered table-hover">
                        
                        <!-- Buscar -->
                        <form action="" method="post">
                            <label for="campo">Buscar:</label>
                            <input style="margin-bottom: 20px; margin-left: 10px; display: inline-block;" type="text" id="buscador" onkeyup="buscarTabla()" placeholder="Buscar...">
                        </form>
                        <thead accept-charset="UTF-8">
                            <th style="text-align:center">ID</th>
                            <th style="text-align:center">Preguntas</th>
                            <th style="text-align:center">Acciones</th>
                        </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
                          $sql="SELECT * from tbl_preguntas";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_Pregunta']?></td> 
                              <td><?php echo $mostrar['Pregunta']?></td> 
                              <td>
                           <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Actualizacion=1 and ID_Rol=$ID_Rol and ID_Objeto=4");
                                if ($datos=$sql->fetch_object()) { ?>
                              <a href='Update_Preguntas.php?ID_Pregunta=<?php echo $mostrar['ID_Pregunta']; ?>' class='boton-editar'>
                              <i class='zmdi zmdi-edit'></i>
                              <?php } ?>
                              </a>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Eliminacion=1 and ID_Rol=$ID_Rol and ID_Objeto=4");
                                    if ($datos=$sql->fetch_object()) { ?>
                              <a href='Delete_Preguntas.php?ID_Pregunta=<?php echo $mostrar['ID_Pregunta']; ?>' onclick='return confirmar()' class='boton-eliminar'>
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
                        <form name="formulario" id="formulario" action="Insert_Preguntas.php" method="POST" accept-charset="UTF-8">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <?php //Me trae el ultimo ID y me suma 1
                                $sql=$conexion->query("SELECT * FROM tbl_preguntas ORDER BY `ID_Pregunta` DESC LIMIT 1;");
                                while($row=mysqli_fetch_array($sql)){
                                    $ID_Pregunta=$row['ID_Pregunta'];
                                }
                                $ID_Pregunta= $ID_Pregunta + 1;
                            ?>
                            <label>ID Pregunta(*):</label>
                            <input type="hidden" name="ID_Pregunta" id="ID_VID_Preguntaoluntario">
                            <input class="form-control" name="ID_Pregunta" id="ID_Pregunta" value="<?php echo $ID_Pregunta; ?>" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Pregunta(*):</label>
                            <input type="hidden" name="Pregunta" id="Pregunta">
                            <input onpaste="return false" type="text" class="form-control" name="Pregunta" id="Pregunta" maxlength="50" placeholder="Ingrese una pregunta" onkeypress="return validarEspaciosMayus_Y_Minus(event)" required>
                          </div>
                        
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar_Pregunta" value="AGREGAR"><i class="zmdi zmdi-upload"></i> Guardar</button>
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

  <script>
    //Validar Mayusculas, Minusculas, espacios y signo de interrogacion(¿,?)
    function validarEspaciosMayus_Y_Minus(event) {
      const patron = /[A-Za-z\s\?\¿]/;
      const tecla = String.fromCharCode(event.keyCode || event.which);
      return patron.test(tecla);
      }
  </script>



</body>
</html>