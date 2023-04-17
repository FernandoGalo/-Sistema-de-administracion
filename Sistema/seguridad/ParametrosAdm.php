<?php
require '../../conexion_BD.php';
/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */
require_once "../../EVENT_BITACORA.php";
session_start();     
$usuario=$_SESSION['usuario'];
$ID_Rol=$_SESSION['ID_Rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Parametros</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="../../css/main.css">
  <script type="text/javascript">
    function confirmar(){
      return confirm('¿Está Seguro?, se eliminará el proyecto');
    }
  </script>
</head>


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
                          <h1 class="box-title">Mantenimiento Parametros</h1>
                          <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Insercion=1 and ID_Rol=$ID_Rol and ID_Objeto=3");
                            if ($datos=$sql->fetch_object()) { ?>
                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-badge-check"></i> Agregar Parametros</button>
                          <div class="box-tools pull-right">
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_consultar=1 and ID_Rol=$ID_Rol and ID_Objeto=3");
                    if ($datos=$sql->fetch_object()) { ?>
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table style="text-align:center" id="tbllistado" class="table table-bordered table-hover">
                        
                        <!-- Buscar -->
                        <form action="" method="post">
                            <label for="campo">Buscar: </label>
                            <input style="margin-bottom: 20px; margin-left: 10px; display: inline-block;"type="text" id="buscador" onkeyup="buscarTabla()" placeholder="Buscar...">
                        </form>
                        <thead accept-charset="UTF-8">
                            <th style="text-align:center">ID</th>
                            <th style="text-align:center">Nombre del parametro</th>
                            <th style="text-align:center">Descripcion</th>
                            <th style="text-align:center">Valor</th>
                            <th style="text-align:center">Acciones</th>
                        </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
                          $sql="SELECT * from tbl_ms_parametros";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_Parametro']?></td> 
                              <td><?php echo $mostrar['Parametro']?></td> 
                              <td><?php echo $mostrar['Descripcion_P']?></td> 
                              <td><?php echo $mostrar['Valor']?></td>
        
                              <td>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Actualizacion=1 and ID_Rol=$ID_Rol and ID_Objeto=3");
                  if ($datos=$sql->fetch_object()) { ?>
                              <a href='Update_Parametros.php?ID_Parametro=<?php echo $mostrar['ID_Parametro']; ?>' class='boton-editar'>
                              <i class='zmdi zmdi-edit'></i>
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
                        <form name="formulario" id="formulario" action="Insert_Parametros.php" method="POST" accept-charset="UTF-8">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <?php //Me trae el ultimo ID y me suma 1
                                
                                // Conectar a la base de datos
                                require '../../conexion_BD.php';
                                // Crear una consulta para obtener el próximo valor AUTO_INCREMENT para la columna id_parametro
                                $query = "SHOW TABLE STATUS LIKE 'tbl_ms_parametros'";
                                $result = mysqli_query($conexion, $query);
                                $row = mysqli_fetch_assoc($result);
                                $next_id = $row['Auto_increment'];
                                
                              
                                
                               
                            ?>
                            <label>ID Parametro(*):</label>
                            <input type="hidden" name="ID_Pregunta" id="ID_VID_Preguntaoluntario">
                            <input class="form-control" name="ID_Pregunta" id="ID_Pregunta" value="<?php echo $next_id; ?>" readonly>
                          </div>
                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>Nombre del parametro(*):</label>
                            <input type="hidden" name="Nombre_Parametro" id="Nombre_Parametro">
                            <input onpaste="return false" type="text" class="form-control" name="Nombre_Parametro" id="Nombre_Parametro" maxlength="50" placeholder="Ingrese el Nombre del Parametro" onkeypress="return /[a-zA-Z_]/i.test(event.key) && (event.key === '_' || /^[a-z0-9_]*$/i.test(event.target.value));" oninput="this.value = this.value.toUpperCase();" required>
                          </div>
                          <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>Descripcion(*):</label>
                            <input type="hidden" name="Descrip_Parametro" id="Descrip_Parametro">
                            <input onpaste="return false" type="text" class="form-control" name="Descrip_Parametro" id="Descrip_Parametro" maxlength="80" placeholder="Ingrese la descripcion" onkeypress="this.value = this.value.toUpperCase();" required>
                          </div>
                          <div  class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label>Valor(*):</label>
                            <input type="hidden" name="Valor_Parametro" id="Valor_Parametro">
                            <input onpaste="return false" type="text" class="form-control" name="Valor_Parametro" id="Valor_Parametro" maxlength="50" placeholder="Valor del parametro" onkeypress="this.value = this.value.toUpperCase();" required>
                          </div>
                        
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="Enviar_Parametros" value="AGREGAR"><i class="zmdi zmdi-upload"></i> Guardar</button>
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
