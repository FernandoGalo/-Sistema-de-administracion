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
      return confirm('¿Está Seguro?, se eliminará el pago');
    }
  </script>
  <script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    // Nombre del archivo
    filename = filename?filename+'.xls':'Reporte de tabla.xls';

    // Crear descarga
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Crear enlace para descargar
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Establecer nombre de archivo
        downloadLink.download = filename;

        // Descargar archivo
        downloadLink.click();
    }
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
                          <h1 class="box-title">Mantenimiento de Pagos</h1>
                          <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Insercion=1 and ID_Rol=$ID_Rol and ID_Objeto=10");
if ($datos=$sql->fetch_object()) { ?>
                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-account-add"></i>Agregar Pago</button>
                          <button class="btn btn-success" id="Excel_Btn" onclick="exportTableToExcel('tbllistado')"><i class="zmdi zmdi-archive"></i> Exportar a Excel</button>
                          <div class="box-tools pull-right">
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_consultar=1 and ID_Rol=$ID_Rol and ID_Objeto=10");
if ($datos=$sql->fetch_object()) { ?>
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-hover">
                        
                        <!-- Buscar -->
                        <form action="" method="post">
                            <label for="campo">Buscar:</label>
                            <input type="text" name="campo" id="campo">
                          </form>

                        <thead>
                            <th>ID pago</th>
                            <th>Monto pagado</th>
                            <th>Tipo pago</th>
                            <th>proyecto</th>
                            <th>Usuario</th>
                            <th>Fecha de Transaccion</th>
                            <th>Acciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
                          $sql="SELECT s.ID_de_pago, s.Monto_pagado, t.nombre,p.Nombre_del_proyecto, u.Nombre_Usuario,s.Fecha_de_transaccion
                          FROM tbl_pagos_realizados s
                          JOIN tbl_tipo_pago_r t ON s.ID_T_pago = t.ID_T_pago
                          JOIN tbl_proyectos p ON s.ID_de_proyecto = p.ID_proyecto
                          JOIN tbl_ms_usuario u ON s.ID_usuario = u.ID_Usuario";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_de_pago']?></td> 
                              <td><?php echo $mostrar['Monto_pagado']?></td> 
                              <td><?php echo $mostrar['nombre']?></td>
                              <td><?php echo $mostrar['Nombre_del_proyecto']?></td>
                              <td><?php echo $mostrar['Nombre_Usuario']?></td>
                              <td><?php echo $mostrar['Fecha_de_transaccion']?></td>
                              <td>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Actualizacion=1 and ID_Rol=$ID_Rol and ID_Objeto=10");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Update_Pago.php?ID_de_pago=<?php echo $mostrar['ID_de_pago']; ?>' class='boton-editar'>
                              <i class='zmdi zmdi-edit'></i>
                              <?php } ?>
                              </a>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Eliminacion=1 and ID_Rol=$ID_Rol and ID_Objeto=10");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Delete_Pago.php?ID_de_pago=<?php echo $mostrar['ID_de_pago']; ?>' onclick='return confirmar()' class='boton-eliminar'>
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
                        <form name="formulario" id="formulario" action="Insert_Pago.php" method="POST">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>ID del Pago(*):</label>
                            <input type="hidden" name="ID_de_pago" id="ID_de_pago">
                            <input style="text" type="text" class="form-control" name="ID_de_pago" id="ID_de_pago" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  placeholder="Ingrese el ID del pago" required>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          </div>
                          <label>Monto Pagado(*):</label>
                            <input type="hidden" name="Monto_pagado" id="Monto_pagado">
                            <input style="text" type="text" class="form-control" name="Monto_pagado" id="Monto_pagado" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  placeholder="Ingrese la cantidad del pago" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Tipo de Pago(*):</label>
                            <?php
                           $sql=$conexion->query("SELECT * FROM tbl_tipo_pago_r");
                          ?>
                            <select class="controls" type="text" name="Pago" id="Pago" required ><br>
                           <?php
                            while($row1=mysqli_fetch_array($sql)){
                            ?>
                             <option value="<?php echo $row1['ID_T_pago'];?>"><?php echo $row1['Nombre'];?></option>
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
                            <input type="text" class="form-control"  name="Usuario" id="Usuario" maxlength="100" placeholder="<?php echo $usuario?>" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Fecha de Transaccion:</label>
                            <input type="date" class="form-control" name="FechaTransaccion" id="FechaTransaccion" maxlength="100" placeholder="Ingrese la Fecha de Transaccion">
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
  
 	<script src="../../js/jquery-3.1.1.min.js"></script>
  <script src="../../js/events.js"></script>
	<script src="../../js/main.js"></script>
  <script src="../../js/usuario.js"></script>

</body>
</html>