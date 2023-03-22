<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGREGAR</title>
    <link rel="stylesheet" href="css/estilos.css">

    <script>
        function soloLetras(e) {
            // Obtener el código ASCII de la tecla presionada
            var key = e.keyCode || e.which;
            
            // Convertir el código ASCII a una letra
            var letra = String.fromCharCode(key).toLowerCase();
            
            // Definir la expresión regular
            var soloLetras = /[a-z\s]/;
            
            // Verificar si la letra es válida
            if (!soloLetras.test(letra)) {
                // Si la letra no es válida, cancelar el evento
                e.preventDefault();
                return false;
            }
        }
        </script>
            <script>
                function validarMayusculas(e) {
                    var tecla = e.keyCode || e.which;
                    var teclaFinal = String.fromCharCode(tecla).toUpperCase();
                    var letras = /^[A-Z]+$/;

                    if(!letras.test(teclaFinal)){
                        e.preventDefault();
                    }
                }
            </script>
                    <script>
        function bloquearEspacio(event) {
        var tecla = event.keyCode || event.which;
        if (tecla == 32) {
            return false;
        }
        }
</script>

</head>
<body>
    <?php
    include("conexion_BD.php");

    //===================================================
    
                        /*despues de haber validad todo el documento y que se haya cumplido todo comienza esta seccion */
                    /*primero crea un id aleatorio de solo numeros con un tamaño de 5 caracteres */
                    $caracteres = '0123456789'; /*abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ mantengo esto por si se desea usar varchar*/

	                function generarID($caracteres, $Tamaño= 5)
	                {
		                    $Max = strlen($caracteres);
		                     $ID_A = '';
		                     for ($c = 0; $c < $Tamaño; $c++) {
			                 $ID_A .= $caracteres[random_int(0, $Max - 1)];
		                   }
		
		               return $ID_A;
	                }
                $ID_Usuario=(generarID($caracteres, $Tamaño= 5));
    
                //Parte 2
                
                $R_Fecha_actual = date('Y-m-d');       /*obtiene la fecha actual*/


                $sql1=$conexion->query("SELECT * FROM `tbl_ms_parametros` WHERE ID_Parametro=7");
                
                    while($row=mysqli_fetch_array($sql1)){
                    $diasV=$row['Valor'];
                    }
                $R_F_Vencida= date("Y-m-j",strtotime($R_Fecha_actual."+ ".$diasV." days")); /*le suma 1 mes a la fecha actual*/
                //fin parte 2
    //====================================================
        if(isset($_POST['enviar'])){
            $nombreCompleto = $_POST['Nombre_Usuario'];
            $nombreUsuario = $_POST['Usuario'];
            $contraseña = $_POST['contraseña'];
            $Rol = $_POST['Rol'];
            //$verifContra = $_POST[''];
            $email = $_POST['Correo_electronico'];
            $vencimiento = $_POST['FechaVencimiento'];

            include("conexion_BD.php");




            if(empty($nombreCompleto)){
                echo"<p class='error'>* Debes colocar tu nombre completo</p>";
            }else if(empty($nombreUsuario)){
                echo"<p class='error'>* Debes colocar tu usuario</p>";
            }else if(empty($contraseña)){
                echo"<p class='error'>* Debes colocar tu password</p>";
            }else if(empty($Rol)){
                echo"<p class='error'>* Debes colocar el rol del 1 al 3</p>";
            }else if(empty($vencimiento)){
                echo"<p class='error'>* Debes colocar la fecha de vencimiento</p>";
            }else if(empty($email)){
                echo"<p class='error'>* Debes colocar tu correo</p>";
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<p class='error'> El correo es incorrecto</p>";
            }else{

                if (strlen($contraseña) < 8 || !preg_match('/[a-z]/', $contraseña) || !preg_match('/[A-Z]/', $contraseña) || !preg_match('/[0-9]/', $contraseña) ) {
                    echo'<script>alert("Contraseña poco segura. Debe contener al menos 8 caracteres , 1 numero, 1 Mayuscula y 1 minuscula")</script>';
                    header("refresh:0;url=usuariosAdm.php");
                    //echo '<div class="alert_danger">Contraseña poco segura. Debe contener al menos 8 caracteres , 1 numero, 1 Mayuscula y 1 minuscula</div>';


                }else{

                

                
            $sql = "INSERT INTO tbl_ms_usuario (ID_Usuario, ID_Rol, Nombre_Usuario, Usuario, Contraseña, Correo_electronico, Fecha_Vencimiento, Fecha_Creacion, Estado_Usuario) VALUES ($ID_Usuario, $Rol,'$nombreCompleto', '$nombreUsuario','$contraseña','$email', '$vencimiento','$R_Fecha_actual', 'NUEVO')";

            $resultado = mysqli_query($conexion,$sql);

            if($resultado){
                //Los datos ingresados a la BD
                echo "<script languaje='JavaScript'>
                        alert('Los datos fueron ingresados correctamente a la BD');
                            location.assign('usuariosAdm.php');
                            </script>";     
                            require_once "EVENT_BITACORA.php";
                            $model = new EVENT_BITACORA;
                            session_start();
                            $_SESSION['UsuarioBitacora']=$nombreUsuario;
                            $_SESSION['IDUsuarioBitacora']=$ID_Usuario;
                            $model->RegInsert();

            }else{
                // Los dcatos NO ingresaron a la BD
                echo "<script languaje='JavaScript'>
                alert('Los datos NO fueron ingresados a la BD');
                    location.assign('usuariosAdm.php');
                    </script>";
            }
            mysqli_close($conexion);
            }
        }




        }
    ?>
</body>
</html>