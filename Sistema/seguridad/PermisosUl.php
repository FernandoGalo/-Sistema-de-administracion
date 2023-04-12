<?php 
//Controladores importantes
 require '../../conexion_BD.php'; 
 require_once "../../EVENT_BITACORA.php";
 session_start();     
 $usuario=$_SESSION['user'];
 $ID_Rol=$_SESSION['ID_Rol'];
 $ID_RolPer = $_GET['ID_Rol'];

//Consulta permiso
$rol_id = $ID_RolPer;

$Permiso="SELECT p.*, r.*, o.* 
from tbl_permisos p
JOIN tbl_ms_roles r ON p.ID_Rol = r.ID_Rol
JOIN tbl_objetos o ON p.ID_Objeto = o.ID_Objeto
WHERE p.ID_rol = $rol_id";

$resPermiso=$conexion->query($Permiso);
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
                          <h1 class="box-title">Permisos del rol seleccionado</h1>
                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-account-add"></i>Agregar permiso</button>
                          <div class="box-tools pull-right">
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-hover">
                      
                        <form  method="post">
			                    <table class="table">
				                    <tr>
                              <th>Pantallas</th>
                              <th>Insertar</th>
                              <th>Eliminar</th>
                              <th>Actualizar</th>
                              <th>Consultar</th>
				                    </tr>
                      <?php
			                  	while ($mostrar = $resPermiso->fetch_array(MYSQLI_BOTH))
				                    {
                              $id_objeto = $mostrar['ID_Objeto'];
                              $sql_objeto = "SELECT * FROM tbl_objetos WHERE ID_Objeto = $id_objeto";
                              $result_objeto = mysqli_query($conexion, $sql_objeto);
                              $objeto = mysqli_fetch_array($result_objeto);
					              echo'<tr>

						              <td hidden><input name="idalu[]" value="'.$mostrar['ID_permiso'].'" /></td>
						              <td>'.$mostrar['Objeto'].'</td>
						              <td><input type="checkbox" name="inser['.$mostrar['ID_permiso'].']"'.($mostrar['Permiso_Insercion'] == 1 ? 'checked' : '').' /></td>
                          <td><input type="checkbox" name="eli['.$mostrar['ID_permiso'].']"'.($mostrar['Permiso_Eliminacion'] == 1 ? 'checked' : '').' /></td>
                          <td><input type="checkbox" name="actu['.$mostrar['ID_permiso'].']"'.($mostrar['Permiso_Actualizacion'] == 1 ? 'checked' : '').' /></td>
                          <td><input type="checkbox" name="cons['.$mostrar['ID_permiso'].']"'.($mostrar['Permiso_consultar'] == 1 ? 'checked' : '').' /></td>
						             </tr>';
			                	}
				              ?>
		                	</table>
			                <input type="submit" name="actualizar" value="Actualizar Registros" class="btn btn-info col-md-offset-9" />
		                  </form>
                      <?php
                      include("../../conexion_BD.php");
                      if(isset($_POST['actualizar']))
                        {
                        foreach ($_POST['idalu'] as $ids) 
                        {
                        $edit2 = isset($_POST['inser'][$ids]) ? 1 : 0;
                        $edit3 = isset($_POST['eli'][$ids]) ? 1 : 0;
                        $edit4 = isset($_POST['actu'][$ids]) ? 1 : 0;
                        $edit5 = isset($_POST['cons'][$ids]) ? 1 : 0;
                            $actualizar=$conexion->query("UPDATE tbl_permisos SET Permiso_Insercion='$edit2', Permiso_Eliminacion='$edit3', Permiso_Actualizacion='$edit4', Permiso_consultar='$edit5' WHERE ID_permiso='$ids'");
                        }
                        if($actualizar==true)
                        {
                        echo "<p>FUNCIONA! <a href='#' id='enlaceClickAqui' onclick='location.reload();'>CLICK AQUÍ</a></p>";
                        echo "<script>
                        document.getElementById('enlaceClickAqui').addEventListener('click', function() {
                        this.style.display = 'none';
                        });
                        </script>";
                        }
                        else
                        {
                        echo "NO FUNIONA!";
                        }
                        }

                      ?>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" action="" method="POST">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Rol(*):</label>
                            <input type="hidden" name="Usuario" id="Usuario">
                            <input style="text-transform:uppercase" type="text" class="form-control" name="Usuario" id="Usuario" maxlength="100" placeholder="Ingrese el nombre del rol" onkeypress="validarMayusculas(event)" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Pantalla(*):</label>
                            <?php
                           $sql=$conexion->query("SELECT * FROM tbl_objetos");
                          ?>
                            <select class="controls" type="text" name="Objeto" id="Objeto" required ><br>
                           <?php
                            while($row1=mysqli_fetch_array($sql)){
                            ?>
                             <option value="<?php echo $row1['ID_Objeto'];?>"><?php echo $row1['Objeto'];?></option>
                            <?php
                             }
                            ?>
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
  <script src="../../js/events.js"></script>
 	<script src="../../js/jquery-3.1.1.min.js"></script>
	<script src="../../js/main.js"></script>
  <script src="../../js/usuario.js"></script>

</body>
</html>