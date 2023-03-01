<?php
/*cuando se presiona el boton dentro de login se activa esta funcion */
if (!empty($_POST["btn_Login"])) {
    /*si el apartado text de usuario y contraseña esta vacio manda un echo de campo vacio */
    if (empty($_POST["usuario"]) and empty($_POST["contra"])) 
    { 
        echo '<div class="alert alert-danger">los campos estan vacios</div>';
    } else{
        /*crea 2 variables locales */
        $usuario=$_POST["usuario"];
        $contra=$_POST["contra"];
        /*manda un query preguntando por el usuario y contraseña */
        $sql=$conexion->query("SELECT * FROM tbl_ms_usuario where Usuario='$usuario' and Contraseña='$contra' ");
        if ($datos=$sql->fetch_object()) {
            /*si el usuario existe hace 2 acciones */
            /*este nuevo query revisa si el usuario tiene ingresos en primer_ingreso */
            $sql=$conexion->query("SELECT * FROM tbl_ms_usuario where Primer_Ingreso>='1'; ");
            /*si el usuario tiene un numero mayor a 0 crea variables globales y 
            va a la funcion que controla el ingreso al sistema principal*/
            if ($datos=$sql->fetch_object()) {
                session_start();
                $_SESSION['user']=$usuario;
                $_SESSION['passw']=$contra;
                header("location: controlador_de_inicio.php");
            } else {
                /*si el usuario fue creado en base de datos debe ir a el apartado de primer_ingreso.php */
                header("location: Primer_Ingreso.php");
            }
            
            /*si el usuario no existe en la base de datos manda un echo de datos incorrectos */
        } else {
            echo '<div class="alert alert-danger">Usuario o contraseña incorrecto </div>';
            //contador de sesiones erroneas
            //bitacora de usuario con error
        }
        
    }
}
/*este boton te lleva a registro */
if (!empty($_POST["btn_R_Ingreso"])) {
    header("location: Registro_N_Usuario.php");
}
    


?>