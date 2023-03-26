<?php
if (!empty($_POST["btn_enviar_N_Contra"])){
    
 if (empty($_POST["C_contra_A"]) and empty($_POST["C_contra_N"])and empty($_POST["C_contra_N_2"])) {
        echo '<div class="alert alert-danger">los campos estan vacios</div>';
 } else {
    $contraseña_A = $_POST["C_contra_A"];
    $contraseña_Nueva = $_POST["C_contra_N"];
    $contraseña_Nueva_2 = $_POST["C_contra_N_2"];
    $ID_usuario = $_SESSION['ID_User'];
    $usuario = $_SESSION['User'];   
    $sql=$conexion->query("SELECT * FROM tbl_ms_usuario where ID_Usuario='$ID_usuario' and Contraseña='$contraseña_A'");
    if ($datos=$sql->fetch_object()) {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[_\W]).{8,}$/', $contraseña_Nueva)) {
            echo "La contraseña debe tener al menos una letra minúscula, una letra mayúscula, un carácter especial y un número.";
            echo"ingrese una contraseña de 8 digitos";
        }else{
            if (($_POST["C_contra_N"]) != ($_POST["C_contra_N_2"])) { /*esta parte valida si ambas contraseñas son iguales*/
                echo '<div class="alert alert-danger">la contraseña es distinta </div>';
            }else{
                $sql3=$conexion->query("UPDATE tbl_ms_usuario SET Contraseña='$contraseña_Nueva', Modificado_Por='$usuario', Fecha_Modificacion='$Fecha_Actual' WHERE ID_Usuario='$ID_usuario'");
                echo '<div class="alert alert-danger">contraseña cambiada con exito</div>';
            }
        }
    }else{
        echo '<div class="alert_danger">contraseña antigua incorrecta </div>';
    }

 }

}
    
?>