<?php
if (!empty($_POST["BTNIngresar_Login"])) {
    if (empty($_POST["Usuario_Login"] and empty($_POST["Contraseña_login"]))) {
        echo '<div class="alert alert-danger">los campos estan vacios</div>';
    } else {
        $usuario = $_POST["Usuario_Login"];
        $contraseña = $_POST["Contraseña_login"];
        $sql = $conexion->query("select * from Login where Usuario='$usuario' and contraseña='$contraseña'");
        if ($datos=$sql->fetch_object()) {
            header("sistema_principal.php");
        } else {
            echo '<div class="alert alert-danger">Usuario o contraseña incorrectos </div>';
        }
        
    }
}



?>