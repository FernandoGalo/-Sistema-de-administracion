<?php
if (!empty($_POST["btn_Login"])) {
    if (empty($_POST["usuario"]) and empty($_POST["contra"])) 
    {
        echo '<div class="alert alert-danger">los campos estan vacios</div>';
    } else{
        $usuario=$_POST["usuario"];
        $contra=$_POST["contra"];
        $sql=$conexion->query("SELECT * FROM Login where nombre='$usuario' and contraseña='$contra'  ");
        if ($datos=$sql->fetch_object()) {
            header("location: Sistema_Principal.php");
            echo "Ingreso al sistema exitoso";
        } else {
            echo '<div class="alert alert-danger">Usuario o contraseña incorrectos </div>';
        }
        
    }
}



?>