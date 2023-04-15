</style>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">

<?php
// Datos de conexión a la base de datos

$host = "localhost";
$user = 'root';
$password = '';
$database = 'bd_asociacion_creo_en_ti';

// Comprobar si se hizo clic en el botón "Crear copia de seguridad"
if(isset($_POST['crear_copia_btn'])) {
  // Nombre del archivo de backup
  $conn = mysqli_connect($host, $user, $password, $database);
  $backups_folder = "C:/xampp/htdocs/Sistema-administrativo-de-fondos-y-proyectos/Sistema/seguridad/Backups/";

  // Nombre del archivo de backup
  $backup_file = $backups_folder . $database ."-" . date("Y-m-d_H-i-s") . ".sql";
  
  // Comando de MySQL para hacer el backup
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
 
  // Comprobación de errores
  if (file_exists($backup_file)) {
    echo "<script language='JavaScript'>
                alert('Backup Creado con éxito.');
            location.assign('Backups_BD.php');
            </script>";
  } else {
    echo "<script language='JavaScript'>
                alert('Error al Crear el backup.');
            location.assign('Backups_BD.php');
            </script>";
  }
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
    <div class="contenedor">
    <h1>Backups y Restauraciones</h1>
    </div>
    <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_consultar=1 and ID_Rol=$ID_Rol and ID_Objeto=12");
if ($datos=$sql->fetch_object()) { ?>
  <div class="izquierda">
<form method="post" enctype="multipart/form-data">
    <h3>Guardar copia de seguridad</h3>
    <h2></h2>
    <button class="zmdi zmdi-cloud-download" type="submit" name="crear_copia_btn">Crear copia de seguridad</button>
</form>
</div>
<div class="derecha">
<h1>Seleccionar Backup</h1>
  <form action="restore.php" method="post">
    <label for="backup_file">Seleccione un archivo de backup:</label>
    <select id="backup_file" name="backup_file">
      <?php
      // Ruta absoluta de la carpeta de backups
      $backups_folder = "C:/xampp/htdocs/Sistema-administrativo-de-fondos-y-proyectos/Sistema/seguridad/Backups/";

      // Obtener la lista de archivos de backup disponibles
      $backup_files = glob($backups_folder . "*.sql");

      // Mostrar la lista de archivos de backup en el formulario
      foreach ($backup_files as $backup_file) {
        echo "<option value=\"" . basename($backup_file) . "\">" . basename($backup_file) . "</option>";
      }
      ?>
    </select>
    <br><br>
    <button class="zmdi zmdi-cloud-upload" type="submit" > Restaurar Backup</button>
  </form>
</div>
<h1>Eliminar Backup</h1>
<form action="Eliminar_backup.php" method="post">
    <label for="backup_file">Seleccione un archivo de backup para eliminar:</label>
    <select id="backup_file" name="backup_file">
        <?php
        // Ruta absoluta de la carpeta de backups
        $backups_folder = "C:/xampp/htdocs/Sistema-administrativo-de-fondos-y-proyectos/Sistema/seguridad/Backups/";

        // Obtener la lista de archivos de backup disponibles
        $backup_files = glob($backups_folder . "*.sql");

        // Mostrar la lista de archivos de backup en el formulario
        foreach ($backup_files as $backup_file) {
            echo "<option value=\"" . basename($backup_file) . "\">" . basename($backup_file) . "</option>";
        }
        ?>
    </select>
    <br><br>
    <button class="zmdi zmdi-close" type="submit"> Eliminar Backup</button>
</form>
  
  </section>
  <?php } ?>
  </body>
  <script src="../../js/Buscador.js"></script>
  <script src="../../js/jquery-3.1.1.min.js"></script>
  <script src="../../js/events.js"></script>
	<script src="../../js/main.js"></script>
