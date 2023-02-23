<?php
if (!empty($_POST["btn_Login"])) {
    if (empty($_POST["usuario"]) and empty($_POST["contra"])) 
    {
        echo '<div class="alert alert-danger">los campos estan vacios</div>';
    } else{
        $usuario=$_POST["usuario"];
        $contra=$_POST["contra"];
        $sql=$conexion->query("SELECT * FROM tbl_ms_usuario where Usuario='$usuario' and Contraseña='$contra' ");
        if ($datos=$sql->fetch_object()) {
            $sql=$conexion->query("SELECT * FROM tbl_ms_usuario where Primer_Ingreso>=1 ");
            if ($datos=$sql->fetch_object()) {
                header("location: Sistema_Principal.php");
            echo "Ingreso al sistema exitoso";
            } else {
                header("location: Primer_Ingreso.php");
                echo "Ingreso al sistema exitoso";
            }
            
            
        } else {
            echo '<div class="alert alert-danger">Usuario o contraseña incorrecto </div>';
        }
        
    }
}

if (!empty($_POST["btn_R_Ingreso"])) {
    header("location: Registro_N_Usuario.php");
}
    


?>