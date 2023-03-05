<?php
require 'conexion_BD.php';
       
  
  session_start();
    $User=$_SESSION['user'];


 //Extrae el ID Del usuario
  $sql1=$conexion->query("SELECT * FROM `tbl_ms_usuario` WHERE Usuario='$User'");
                
                 while($row=mysqli_fetch_array($sql1)){
                      $idUser=$row['ID_Usuario'];
                 }

//if (!empty($_POST["btn_enviar_pi"])) {
                $NContra=$_POST["contranueva"];
                $R_Fecha_actual = date("Y-m-j");
                
                //edicion de contraseña, preguntas y primer ingreso
                $sql2=$conexion->query("UPDATE tbl_ms_usuario SET Contraseña='$NContra', Modificado_Por='$User', Fecha_Modificacion='$R_Fecha_actual', Estado_Usuario='ACTIVO' WHERE ID_Usuario='$idUser' ");

                
                        echo'<script>alert("Datos Guardados exitosamente ")</script>';
                        session_start();
                        
                        $_SESSION['user']=$User;
                        $_SESSION['ID_User']=$idUser;
                        header("location: Login.php");
            ini_set('error_reporting', E_ALL);
           
          // } 
            
          
 

  

?>