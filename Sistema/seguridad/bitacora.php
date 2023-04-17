<?php

require '../../conexion_BD.php';
session_start();
$usuario=$_SESSION['user'];
$ID_Rol=$_SESSION['ID_Rol'];
include("../../EVENT_BITACORA.PHP");
// Definir la página actual. Si $_GET['pagina'] no está definido, se establece en 1
$fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
$fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : '';


?>
                      
<!DOCTYPE html>
<html lang="es">
<head>

	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
    
    

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

                          <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_consultar=1 and ID_Rol=$ID_Rol and ID_Objeto=2");
if ($datos=$sql->fetch_object()) { ?>
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

<div style="display: flex;">
    <form action="" method="POST">
        <label for="por_pagina">Cantidad de registros por página:</label>
        <select name="por_pagina" id="por_pagina" onchange="this.form.submit()">
            <option value="5" <?php if ($por_pagina == 5) echo 'selected="selected"'; ?>>5</option>
            <option value="10" <?php if ($por_pagina == 10) echo 'selected="selected"'; ?>>10</option>
            <option value="20" <?php if ($por_pagina == 20) echo 'selected="selected"'; ?>>20</option>
            <option value="10000" <?php if ($por_pagina == 10000) echo 'selected="selected"'; ?>>Todo</option>
        </select>
    </form>
    <form method="GET" style="margin-left: 400px;">
        <div class="form-group">
            <label for="buscar">Buscar:</label>
            <input type="text" id="buscar" name="buscar">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
</div>


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
$fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
$fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : '';


$sql = $conexion->query("SELECT * FROM tbl_ms_bitacora");

// Construir la condición de búsqueda
$condicion = '';
if (!empty($fecha_inicio) && !empty($fecha_fin)) {
    $fecha_inicio = date('Y-m-d', strtotime($fecha_inicio));
    $fecha_fin = date('Y-m-d', strtotime($fecha_fin));
    $condicion = " WHERE Fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
}

// Contar el número total de registros
$sql_contar = "SELECT COUNT(*) as total FROM tbl_ms_bitacora $condicion";
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
        $condicion
        ORDER BY Fecha DESC
        LIMIT $inicio_limit, $por_pagina";

// Mostrar los resultados
$resultado = mysqli_query($conexion, $sql);
if (!empty($fecha_inicio) && !empty($fecha_fin)) {
    echo '<p>Mostrando los resultados entre las fechas: ' . $fecha_inicio . ' y ' . $fecha_fin . '</p>';
}
?>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    
                    <div class="panel-body table-responsive" id="listadoregistros">

          
    <table id="tbllistado" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID bitacora</th>
                <th>fecha</th>
                <th>Usuario</th>
                <th>Objeto</th>
                <th>Accion</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Procesar criterios de búsqueda
        $busqueda = '';
        if (isset($_GET['buscar'])) {
            $busqueda = $_GET['buscar'];
            $sql = "SELECT b.ID_Bitacora,b.Fecha, u.Usuario, o.Objeto, b.Accion, b.Descripcion 
                    FROM tbl_ms_bitacora b
                    JOIN tbl_objetos o ON b.ID_Objeto = o.ID_Objeto
                    JOiN tbl_ms_usuario u ON b.ID_Usuario = u.ID_Usuario
                    WHERE b.ID_Bitacora LIKE '%$busqueda%' OR u.Usuario LIKE '%$busqueda%' OR o.Objeto LIKE '%$busqueda%' OR b.Accion LIKE '%$busqueda%' OR b.Descripcion LIKE '%$busqueda%'
                    ORDER BY fecha DESC
                    LIMIT $por_pagina OFFSET " . ($pagina_actual - 1) * $por_pagina;
        } else {
            $sql = "SELECT b.ID_Bitacora,b.Fecha, u.Usuario, o.Objeto, b.Accion, b.Descripcion 
                    FROM tbl_ms_bitacora b
                    JOIN tbl_objetos o ON b.ID_Objeto = o.ID_Objeto
                    JOiN tbl_ms_usuario u ON b.ID_Usuario = u.ID_Usuario
                    ORDER BY fecha DESC
                    LIMIT $por_pagina OFFSET " . ($pagina_actual - 1) * $por_pagina;
        }

        $resultado = mysqli_query($conexion,$sql);

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
   $sql_total = "SELECT COUNT(*) as total FROM tbl_ms_bitacora";
   $resultado_total = mysqli_query($conexion, $sql_total);
   $datos_total = mysqli_fetch_assoc($resultado_total);
   $total_filas = $datos_total['total'];
    
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
                    <?php
}
?>
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