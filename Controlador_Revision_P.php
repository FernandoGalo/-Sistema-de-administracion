<?php
if (!empty($_POST["btn_enviar_M_P"])) {
$conn = mysqli_connect("localhost", "root", "", "bd_asociacion_creo_en_ti", "3306");
session_start();
$User=$_SESSION['user'];
$idUser=$_SESSION['ID_User'];



$sql1=$conexion->query("SELECT valor FROM `tbl_ms_parametros` WHERE ID_Parametro=2");
                
                 while($row=mysqli_fetch_array($sql1)){
                    $parametro_preguntas=$row['valor'];
                 }

$sql=$conexion->query("SELECT Preguntas_Contestadas FROM `tbl_ms_usuario` WHERE ID_Usuario='$idUser' ");
                
                 while($row=mysqli_fetch_array($sql)){
                    $C_preguntas_respondidas=$row['Preguntas_Contestadas'];
                 }

if ($C_preguntas_respondidas >= $parametro_preguntas) {
    header("location: login.php");
    
 } else {
    header("location: Preguntas_RAI.php");
 }
 
 // Cerrar la conexión a la base de datos
 mysqli_close($conn);
}
if (!empty($_POST["btn_enviar_R"])) {
    $conn = mysqli_connect("localhost", "root", "", "bd_asociacion_creo_en_ti", "3306");
    session_start();
    $User=$_SESSION['user'];
    $idUser=$_SESSION['ID_User'];
    
    $sql1=$conexion->query("SELECT valor FROM `tbl_ms_parametros` WHERE ID_Parametro=2");
                
    while($row=mysqli_fetch_array($sql1)){
       $parametro_preguntas=$row['valor'];
    }

$sql=$conexion->query("SELECT Preguntas_Contestadas FROM `tbl_ms_usuario` WHERE ID_Usuario='$idUser' ");
   
    while($row=mysqli_fetch_array($sql)){
       $C_preguntas_respondidas=$row['Preguntas_Contestadas'];
    }

if ($C_preguntas_respondidas >= $parametro_preguntas) {
header("location: login.php");

} else {
header("location: Preguntas_RAI.php");
}
     
     // Cerrar la conexión a la base de datos
     mysqli_close($conn);
    }
?>