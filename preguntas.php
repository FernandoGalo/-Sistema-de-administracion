<?php
require 'conexion_BD.php';
       
  
  session_start();
    $User=$_SESSION['usuario'];


 //Extrae el ID Del usuario
  $sql1=$conexion->query("SELECT * FROM `tbl_ms_usuario` WHERE Usuario='$User'");
                
                 while($row=mysqli_fetch_array($sql1)){
                      $idUser=$row['ID_Usuario'];
                 }

//if (!empty($_POST["btn_enviar_pi"])) {
   
                 
                $pregunta=$_POST["Pregunta"];
                $respuesta=$_POST["respuesta"];
                $NContra=$_POST["contranueva"];
                $R_Fecha_actual = date("Y-m-j");



              
  
                //Insert de Nueva Pregunta
                $sql=$conexion->query("INSERT INTO tbl_ms_preguntas_x_usuario(`ID_Pregunta`, `ID_Usuario`, `Respuesta`, `Creado_Por`, `Fecha_Creacion`) 
                    VALUES ('$pregunta','$idUser','$respuesta', '$User', '$R_Fecha_actual')");

                //edicion de contraseña, preguntas y primer ingreso
                $sql2=$conexion->query("UPDATE tbl_ms_usuario SET Contraseña='$NContra', Preguntas_Contestadas='1',Primer_Ingreso='1', Modificado_Por='$User', Fecha_Modificacion='$R_Fecha_actual', Estado_Usuario='ACTIVO' WHERE ID_Usuario='$idUser'");

                if ($sql) {
                        echo'<script>alert("Datos Guardados exitosamente ")</script>';
                          header("refresh:0;url=Login.php");
                } else {
            ini_set('error_reporting', E_ALL);
           
        }
          // } 
            
          
 

  

?>