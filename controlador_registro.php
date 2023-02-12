<?php
if (!empty($_POST["btn_enviar_R"])) {
    if (empty($_POST["R_usuario"]) and empty($_POST["R_contra"])and empty($_POST["R_correo"])) 
    {
        echo '<div class="alert alert-danger">los campos estan vacios</div>';
    } else{
        $R_usuario=$_POST["R_usuario"];
        $R_contra=$_POST["R_contra"];
        $R_Correo=$_POST["R_correo"];
        $sql=$conexion->query("INSERT INTO usuarios(ID_Usuario,Nombre_Usuario,Contrasena_usuario,Correo_Electronico,Telefono_Hogar,Celular_Usuario,ID_estado) VALUES (NULL, '$R_usuario', '$R_contra', '$R_Correo', NULL, NULL, '1');");
        header("location: Login.php");
    }
}



?>