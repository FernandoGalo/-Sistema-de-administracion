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
            $contrasena = $_POST['Contraseña'];
            //$verifContra = $_POST[''];
            $email = $_POST['Correo_electronico'];

            include("conexion_BD.php");




            if(empty($nombreCompleto)){
                echo"<p class='error'>* Debes colocar tu nombre completo</p>";
            }else if(empty($nombreUsuario)){
                echo"<p class='error'>* Debes colocar tu usuario</p>";
            }else if(empty($contrasena)){
                echo"<p class='error'>* Debes colocar tu password</p>";
            }else if(empty($email)){
                echo"<p class='error'>* Debes colocar tu correo</p>";
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<p class='error'> El correo es incorrecto</p>";
            }else{

                
            $sql = "INSERT INTO tbl_ms_usuario (ID_Usuario, ID_Rol, Nombre_Usuario, Usuario, Contraseña, Correo_electronico, Fecha_Vencimiento, Fecha_Creacion, Estado_Usuario) VALUES ($ID_Usuario, 3,'$nombreCompleto', '$nombreUsuario','$contrasena','$email', '$R_F_Vencida','$R_Fecha_actual', 'ACTIVO')";

            $resultado = mysqli_query($conexion,$sql);

            if($resultado){
                //Los datos ingresados a la BD
                echo "<script languaje='JavaScript'>
                        alert('Los datos fueron ingresados correctamente a la BD');
                            location.assign('usuariosAdm.php');
                            </script>";                          
            }else{
                // Los dcatos NO ingresaron a la BD
                echo "<script languaje='JavaScript'>
                alert('Los datos NO fueron ingresados a la BD');
                    location.assign('usuariosAdm.php');
                    </script>";
            }
            mysqli_close($conexion);
            }
            




        }else{
                
    ?>
    <h1>Agregar Nuevo Usuario</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Nombre Completo:</label>
        <input type="text" name="Nombre_Usuario" maxlength="60" onkeypress="return soloLetras(event);">
        <br>
        <label>Nombre de Usuario</label>
        <input type="text" name="Usuario" maxlength="15" onkeypress="validarMayusculas(event);">
        <br>
        <label>Contra</label>
        <input type="text" name="Contraseña" maxlength="8" onkeypress="return bloquearEspacio(event);">
        <br>
        <!-- <label>Confirmar Contra</label>
        <input type="text" name="confPass">
        <br> -->
        <label>Correo Electronico</label>
        <input type="text" name="Correo_electronico">
        <br>
        <input type="submit" name="enviar" value="AGREGAR">
        <a href="usuariosAdm.php">Regresar</a>
    </form>
    <?php
        }
    ?>
</body>
</html>