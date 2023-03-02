<?php
/*cuando se presiona el boton dentro de login se activa esta funcion */
if (!empty($_POST["btn_Login"])) {
    /*si el apartado text de usuario y contraseña esta vacio manda un echo de campo vacio */
    if (empty($_POST["usuario"]) and empty($_POST["contra"]) )
    {
        echo '<div class="alert_danger">Por favor ingrese su nombre de usuario y contraseña </div>';
    }
    if (empty($_POST["usuario"]) and empty($_POST["contra"])) 
    { 
        echo '<div class="alert_danger">Por favor ingrese su nombre de usuario y contraseña </div>';
    } else{
        $usuario=$_POST["usuario"];
        $contra=$_POST["contra"];
        session_start();
        $_SESSION['usuario']=$usuario;
        $sql=$conexion->query("SELECT * FROM tbl_ms_usuario where Usuario='$usuario' and Contraseña='$contra'");


        if ($datos=$sql->fetch_object()) {
            //Si el usuario esta Bloqueado
            $sql=$conexion->query("SELECT * FROM tbl_ms_usuario where Estado_Usuario='BLOQUEADO'");
            if ($datos=$sql->fetch_object()) {
                 echo '<div class="alert_danger">Usuario Bloqueado, comuniquese con el Administrador del Sistema </div>';
            }else {
                //si el usuario esta activo y con preguntas ingresadas

            $sql=$conexion->query("SELECT * FROM tbl_ms_usuario where Primer_Ingreso>=1 and Estado_Usuario='ACTIVO' and
            Usuario='$usuario' ");


            if ($datos=$sql->fetch_object()) {
                 $sql1=$conexion->query("UPDATE tbl_ms_usuario SET Intentos='0' WHERE Usuario='$usuario'");
                 session_start();
                $_SESSION['user']=$usuario;
                $_SESSION['passw']=$contra;
                header("location: controlador_de_inicio.php");

            } else {
                //si el usuario le faltan ingresar Preguntas
                header("location: Primer_Ingreso.php");

            }
            
            
        }} else {
                 //trae el parametro de Intentos
                       $sql=$conexion->query("SELECT * FROM tbl_ms_parametros where ID_Parametro='1'");
                        while ($row=mysqli_fetch_array($sql)) {
                           $intentos_p=$row['Valor'];
                            
                        }
                        //Trae los intentos del usuario
                         $sql=$conexion->query("SELECT * FROM tbl_ms_usuario where Usuario='$usuario'");
                  while ($row=mysqli_fetch_array($sql)) {
                           $intentos_u=$row['Intentos']+1;

                               if ($intentos_u>=$intentos_p) {
                                //bloquea el usuario si llego a los intentos permitidos
                                $sql1=$conexion->query("UPDATE tbl_ms_usuario SET Estado_Usuario='BLOQUEADO', Intentos='$intentos_u' WHERE Usuario='$usuario'");
                                   echo '<div class="alert alert-danger">Usuario Bloqueado, comuniquese con el Administrador del Sistema </div>';
                                
                            } else {
                                //suma intentos
                                $sql1=$conexion->query("UPDATE tbl_ms_usuario SET Intentos='$intentos_u' WHERE Usuario='$usuario'");
                            }

                            
                        }

                        
                        

            echo '<div class="alert alert-danger">Usuario o contraseña incorrecto </div>';

        }
        
    }
}  
/*este boton te lleva a registro */
if (!empty($_POST["btn_R_Ingreso"])) {
    header("location: Registro_N_Usuario.php");
}
    


?>