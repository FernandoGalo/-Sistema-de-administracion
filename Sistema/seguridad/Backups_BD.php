<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">

<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = 'root';
$password = '';
$database = 'bd_asociacion_creo_en_ti';

// Comprobar si se hizo clic en el botón "Crear copia de seguridad"
if(isset($_POST['crear_copia_btn'])) {
  $conn = mysqli_connect($servername, $username, $password, $database);

  // Nombre del archivo de backup
  $backup_file = $database . '_' . date("YmdHis") . '.sql';
  
  // Obtener listado de tablas
  $tables = array();
  $result = mysqli_query($conn, "SHOW TABLES");
  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $tables[] = $row[0];
  }
  
  // Generar archivo de backup
  $handle = fopen($backup_file, 'w');
  foreach ($tables as $table) {
    // Obtener definición de la tabla
    fwrite($handle, "DROP TABLE IF EXISTS `$table`;" . PHP_EOL); // Agrega la sentencia DROP TABLE
    $result = mysqli_query($conn, "SHOW CREATE TABLE `$table`");
    $row = mysqli_fetch_row($result);
    fwrite($handle, $row[1] . ";" . PHP_EOL);
  
    // Obtener contenido de la tabla
    $result = mysqli_query($conn, "SELECT * FROM `$table`");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $fields = array();
      foreach ($row as $key => $value) {
        $fields[] = "`$key`='" . mysqli_real_escape_string($conn, $value) . "'";
      }
      fwrite($handle, "INSERT INTO `$table` SET " . implode(',', $fields) . ";" . PHP_EOL);
    }
    fwrite($handle, PHP_EOL);
  }
  
  fclose($handle);
  
  // Cerrar conexión
  mysqli_close($conn);
  
  // Descargar archivo
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="' . basename($backup_file) . '"');
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($backup_file));
  ob_clean();
  flush();
  readfile($backup_file);
  unlink($backup_file);
  
  exit;
}

// Comprobar si se hizo clic en el botón "Restaurar copia de seguridad"
if(isset($_POST['restaurar_copia_btn'])) {
  $conn = mysqli_connect($servername, $username, $password, $database);

  // Nombre del archivo de backup
  $backup_file = $database . '_' . date("YmdHis") . '.sql';
  
  // Agregar sentencia SET al inicio del archivo
  $handle = fopen($backup_file, 'w');
  fwrite($handle, "SET FOREIGN_KEY_CHECKS = 0;" . PHP_EOL);
  
  // Obtener listado de tablas
  $tables = array();
  $result = mysqli_query($conn, "SHOW TABLES");
  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $tables[] = $row[0];
  }
  
  // Generar archivo de backup
  foreach ($tables as $table) {
    // Obtener definición de la tabla
    fwrite($handle, "DROP TABLE IF EXISTS `$table`;" . PHP_EOL);
    $result = mysqli_query($conn, "SHOW CREATE TABLE `$table`");
    $row = mysqli_fetch_row($result);
    fwrite($handle, $row[1] . ";" . PHP_EOL);
  
    // Obtener contenido de la tabla
    $result = mysqli_query($conn, "SELECT * FROM `$table`");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $fields = array();
      foreach ($row as $key => $value) {
        $fields[] = "`$key`='" . mysqli_real_escape_string($conn, $value) . "'";
      }
      fwrite($handle, "INSERT INTO `$table` SET " . implode(',', $fields) . ";" . PHP_EOL);
    }
    fwrite($handle, PHP_EOL);
  }
  
  // Agregar sentencia SET al final del archivo
  fwrite($handle, "SET FOREIGN_KEY_CHECKS = 1;" . PHP_EOL);
  fclose($handle);
  
  // Cerrar conexión
  mysqli_close($conn);
  
  // Descargar archivo
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="' . basename($backup_file) . '"');
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($backup_file));
  ob_clean();
  flush();
  readfile($backup_file);
  unlink($backup_file);
  
  exit;
}
?>
</head>
<body>
<?php
session_start();     
$usuario=$_SESSION['user'];
$ID_Rol=$_SESSION['ID_Rol'];
?>
<?php include '../sidebar.php'; ?>
<!-- Formulario para crear y restaurar una copia de seguridad -->
<section class="full-box dashboard-contentPage" style="overflow-y: auto;">
		<!-- Barra superior -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
			</ul>
		</nav>
<form method="post" enctype="multipart/form-data">
    <h1>Backups y Restauraciones</h1>
    <h2></h2>
    <h1>Descargar copia de seguridad</h1>
    <h2></h2>
    <button class="zmdi zmdi-cloud-download" type="submit" name="crear_copia_btn">Crear copia de seguridad</button>
</form>
<h2></h2>
<h3></h3>
<form action="restore.php" method="post" enctype="multipart/form-data">
  <h1>Restaurar copia de seguridad</h1>
  <h2></h2>
  <label for="file">Seleccione un archivo de copia de seguridad:</label>
  <input type="file" name="file" id="file">
  <br>
  <button class="zmdi zmdi-cloud-upload" type="submit" name="submit" onclick='return confirmar()'>Restaurar base de datos</button>
</form>

<script type="text/javascript">
    function confirmar(){
      return confirm('¿Está Seguro de restaurar la Base de datos?');
    }
  </script>
  </section>
  </body>
  <script src="../../js/Buscador.js"></script>
  <script src="../../js/jquery-3.1.1.min.js"></script>
  <script src="../../js/events.js"></script>
	<script src="../../js/main.js"></script>
