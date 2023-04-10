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
      $result = mysqli_query($conn, "SELECT * FROM `$table`");
      fwrite($handle, "DROP TABLE IF EXISTS `$table`;" . PHP_EOL);
      fwrite($handle, "CREATE TABLE `$table` (" . PHP_EOL);
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
    // Verificación de la existencia del archivo de la copia de seguridad
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
      $result = mysqli_query($conn, "SELECT * FROM `$table`");
      fwrite($handle, "DROP TABLE IF EXISTS `$table`;" . PHP_EOL);
      fwrite($handle, "CREATE TABLE `$table` (" . PHP_EOL);
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
?>

<!-- Formulario para crear y restaurar una copia de seguridad -->
<form method="post" enctype="multipart/form-data">

    <button type="submit" name="crear_copia_btn">Crear copia de seguridad</button>
</form>

<form action="restore.php" method="post" enctype="multipart/form-data">
  <label for="file">Seleccione un archivo de copia de seguridad:</label>
  <input type="file" name="file" id="file">
  <br>
  <button type="submit" name="submit">Restaurar base de datos</button>
</form>
