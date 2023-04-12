<?php

require '../../conexion_BD.php';
session_start();
$usuario=$_SESSION['user'];
$ID_Rol=$_SESSION['ID_Rol'];
include("../../EVENT_BITACORA.PHP");
// Definir la página actual. Si $_GET['pagina'] no está definido, se establece en 1


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
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
                          <h1 class="box-title">Bitacora principal</h1>


                          <?php
    // Inicializamos la variable $por_pagina con un valor de 10
    if (isset($_POST['por_pagina'])) {
        $_SESSION['por_pagina'] = $_POST['por_pagina'];
    }
    
    if (isset($_SESSION['por_pagina'])) {
        $por_pagina = $_SESSION['por_pagina'];
    } else {
        $por_pagina = 10;
    }

    // Si se envió el formulario, actualizamos la variable con el valor seleccionado
    if (isset($_POST['por_pagina'])) {
        $por_pagina = $_POST['por_pagina'];
    }
?>

<form action="" method="POST">
    <label for="por_pagina">Cantidad de registros por página:</label>
    <select name="por_pagina" id="por_pagina" onchange="this.form.submit()">
        <option value="5" <?php if ($por_pagina == 5) echo 'selected="selected"'; ?>>5</option>
        <option value="10" <?php if ($por_pagina == 10) echo 'selected="selected"'; ?>>10</option>
        <option value="20" <?php if ($por_pagina == 20) echo 'selected="selected"'; ?>>20</option>
    </select>
</form>
<button class="btn btn-success" id="Excel_Btn" onclick="exportTableToExcel('tbllistado')"><i class="zmdi zmdi-archive"></i> Exportar a Excel</button>
<?php
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if (isset($_GET['pagina'])) {
    $pagina_actual = $_GET['pagina'];
} else {
    $pagina_actual = 1;
}

// Calcular el número de filas de la tabla
$sql_contar = "SELECT COUNT(*) as total FROM tbl_ms_bitacora";
$resultado_contar = mysqli_query($conexion, $sql_contar);
$total_filas = mysqli_fetch_assoc($resultado_contar)['total'];

// Calcular el número total de páginas
$total_paginas = ceil($total_filas / $por_pagina);

// Calcular el registro inicial para la consulta LIMIT
$inicio_limit = ($pagina - 1) * $por_pagina;

// Consultar los registros para la página actual
$sql = "SELECT b.ID_Bitacora, b.Fecha, u.Usuario, o.Objeto, b.Accion, b.Descripcion 
        FROM tbl_ms_bitacora b
        JOIN tbl_objetos o ON b.ID_Objeto = o.ID_Objeto
        JOIN tbl_ms_usuario u ON b.ID_Usuario = u.ID_Usuario
        ORDER BY fecha DESC
        LIMIT $inicio_limit, $por_pagina";
$resultado = mysqli_query($conexion, $sql);
?>
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
                            <th>ID bitacora</th>
                            <th>fecha</th>
                            <th>Usuario</th>
                            <th>Objeto</th>
                            <th>Accion</th>
                            <th>Descripcion</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
           $sql="SELECT b.ID_Bitacora,b.Fecha, u.Usuario, o.Objeto, b.Accion, b.Descripcion 
		   from tbl_ms_bitacora b
		   JOIN tbl_objetos o ON b.ID_Objeto = o.ID_Objeto
		   JOiN tbl_ms_usuario u ON b.ID_Usuario = u.ID_Usuario
		   ORDER BY fecha DESC
		   LIMIT $por_pagina OFFSET " . ($pagina_actual - 1) * $por_pagina;

            while($mostrar=mysqli_fetch_array($resultado)){
                ?>

                <tr> 
                    <td><?php echo $mostrar['ID_Bitacora']?></td>
                    <td><?php echo $mostrar['Fecha']?></td>
                    <td><?php echo $mostrar['Usuario']?></td>
                    <td><?php echo $mostrar['Objeto']?></td>
                    <td><?php echo $mostrar['Accion']?></td>
                    <td><?php echo $mostrar['Descripcion']?></td>
                </tr>
             <?php
            }
             ?>   
			 <?php
    $sql_total="SELECT COUNT(*) as total FROM tbl_ms_bitacora";
    $resultado_total=mysqli_query($conexion,$sql_total);
    $fila_total=mysqli_fetch_assoc($resultado_total);
    $total_registros=$fila_total['total'];
    $total_paginas=ceil($total_registros/$por_pagina);
?>

<nav>
    <ul class="pagination">
        <?php if($pagina_actual != 1): ?>
            <li><a href="?pagina=<?php echo $pagina_actual - 1; ?>">Anterior</a></li>
        <?php endif; ?>

        <?php for($i = 1; $i <= $total_paginas; $i++): ?>
            <?php if($i == $pagina_actual): ?>
                <li class="active"><a href="#"><?php echo $i; ?></a></li>
            <?php else: ?>
                <li><a href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if($pagina_actual != $total_paginas): ?>
            <li><a href="?pagina=<?php echo $pagina_actual + 1; ?>">Siguiente</a></li>
        <?php endif; ?>
    </ul>
</nav>  
                          </tfoot>
                        </table>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
		</div>
	</section>

	<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/sweetalert2.all.min.js"></script>
<script src="../js/app.js"></script>
	
	<!--script en java para los efectos-->
    <script src="../../js/Buscador.js"></script>
  <script src="../../js/events.js"></script>
 	<script src="../../js/jquery-3.1.1.min.js"></script>
	<script src="../../js/main.js"></script>
  <script src="../../js/usuario.js"></script>
</body>
</html>