<?php
$IDusuarioDelete = $_GET['ID_Usuario'];
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=bd_asociacion_creo_en_ti', 'root', '');
// Desactivar las restricciones de clave externa
$stmt = $pdo->prepare('SELECT Usuario FROM tbl_ms_usuario WHERE ID_Usuario= :id');

// Vincular el valor del ID al parámetro de la consulta
$id = $IDusuarioDelete; // El ID del usuario a buscar
$stmt->bindParam(':id', $id);

// Ejecutar la consulta
$stmt->execute();

// Obtener el resultado de la consulta
$usuario = $stmt->fetch();
$usuarioDelete = $usuario['Usuario'];

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');

// Borrar los registros de las tablas
$stmt1 = $pdo->prepare('DELETE FROM tbl_ms_hist_contraseña WHERE ID_Usuario = ?');
$stmt1->execute([$IDusuarioDelete]);
$rowCount1 = $stmt1->rowCount();

$stmt2 = $pdo->prepare('DELETE FROM tbl_ms_preguntas_x_usuario WHERE ID_Usuario = ?');
$stmt2->execute([$IDusuarioDelete]);
$rowCount2 = $stmt2->rowCount();

$stmt3 = $pdo->prepare('DELETE FROM tbl_ms_bitacora WHERE ID_Usuario = ?');
$stmt3->execute([$IDusuarioDelete]);
$rowCount3 = $stmt3->rowCount();

$stmt4 = $pdo->prepare('DELETE FROM tbl_ms_usuario WHERE ID_Usuario = ?');
$stmt4->execute([$IDusuarioDelete]);
$rowCount4 = $stmt4->rowCount();

$totalRowCount = $rowCount1 + $rowCount2 + $rowCount3 + $rowCount4;

// Verificar si se borraron registros
if ($totalRowCount > 0) {
    echo "<script languaje='JavaScript'>
                alert('Los datos se eliminaron correctamente de la Base de Datos');
                location.assign('usuariosAdm.php');
                </script>";
                
                   
                require_once "EVENT_BITACORA.php";
                $model = new EVENT_BITACORA;
                session_start();
                $_SESSION['UsuarioBitacoraDELETE']=$usuarioDelete;
                $_SESSION['IDUsuarioBitacoraDELETE']=$IDusuarioDelete;
                $model->RegDelete();
             
} else {
    echo "<script languaje='JavaScript'>
    alert('Los datos NO se eliminaron de la BD');
    location.assign('usuariosAdm.php');
    </script>";   
}

?>