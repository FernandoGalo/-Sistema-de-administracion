<?php
// Verificar si se envió el formulario
if(isset($_POST["submit"])) {
  // Verificar si se seleccionó un archivo
  if($_FILES["file"]["name"]) {
    // Conectar a la base de datos utilizando PDO
    $pdo = new PDO("mysql:host=localhost;dbname=bd_asociacion_creo_en_ti", "root", "");
    $pdo->exec("SET foreign_key_checks = 0;");
    // Cargar el archivo de copia de seguridad en un búfer
    $file = file_get_contents($_FILES["file"]["tmp_name"]);

    // Ejecutar una consulta SQL para restaurar la base de datos a partir del archivo de copia de seguridad
    $pdo->exec($file);
    $pdo->exec("SET foreign_key_checks = 1;");
    echo "La base de datos se ha restaurado exitosamente.";
  } else {
    echo "Debe seleccionar un archivo de copia de seguridad.";
  }
}
?>
