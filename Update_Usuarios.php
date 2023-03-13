<?php
    include("conexion_BD.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        if(isset($_POST['enviar'])){
            //aqui entra sio el usuario ha presionado el boton enviar
            $id=$_POST['IDusuario'];
            $userName=$_POST['nombreUsuario'];
            $user=$_POST['usuario'];//Obtenidos desde el formulario
            $contra=$_POST['password'];
            $email=$_POST['correo'];



            //si lo que esta en el form esta vacio
            if(empty($userName)){
                echo"<p class='error'>* Debes colocar tu nombre completo</p>";
            }else if(empty($user)){
                echo"<p class='error'>* Debes colocar tu usuario</p>";
            }else if(empty($contra)){
                echo"<p class='error'>* Debes colocar tu password</p>";
            }else if(empty($email)){
                echo"<p class='error'>* Debes colocar tu correo</p>";
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<p class='error'> El correo es incorrecto</p>";
            }else{





            //UPDATE tbl_ms_usuario SET Usuario=$user WHERE Nombre_Usuario=$id;
            $sql="UPDATE tbl_ms_usuario SET Nombre_Usuario = '$userName', Usuario ='$user', Contraseña = '$contra', Correo_electronico = '$email' WHERE ID_Usuario='$id';";
            $resultado=mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                    location.assign('usuariosAdm.php');
                    </script>";
            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('usuariosAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        }
        }else{
            //si el usuario NO ha presionado el boton enviar
            $id=$_GET['ID_Usuario']; //recuperar el id que se envia desde el home.html
            $sql="SELECT * FROM tbl_ms_usuario where ID_Usuario='".$id."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);

            $idUser=$fila['ID_Usuario'];
            $nombreUsuario=$fila['Nombre_Usuario'];
            $usuario=$fila['Usuario'];//recuperando los datos desde la BD
            $pass=$fila['Contraseña'];
            $correo=$fila['Correo_electronico'];

            mysqli_close($conexion);

    ?>

    <h1>Editar Usuario</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
 
        <label>ID Usuario:</label>
        <input type="text" name="IDusuario" value="<?php echo $idUser; ?>">
        <br>

        <label>Nombre Usuario:</label>
        <input type="text" name="nombreUsuario" maxlength="60" onkeypress="return soloLetras(event);" value="<?php echo $nombreUsuario; ?>">
        <br>

        <label>Usuario:</label>
        <input type="text" name="usuario" maxlength="15" onkeypress="validarMayusculas(event);" value="<?php echo $usuario; ?>">
        <br>

        <label>Contraseña:</label>
        <input type="text" name="password" maxlength="8" onkeypress="return bloquearEspacio(event);" value="<?php echo $pass; ?>">
        <br>

        <label>Correo Electronico:</label>
        <input type="email" name="correo" value="<?php echo $correo; ?>">
        <br>

        <input type="hidden" name="Nombre_Usuario" value="<?php echo $id; ?>"><!-- Para que el Nombre_Usuario no quede fuera de la jugada, creamos un input de tipo escondido para poder almacenar el nombre usuario que estamos manipulando-->

        <input type="submit" name="enviar" value="ACTUALIZAR">
        <a href="usuariosAdm.php">Regresar</a>

    </form>
    <?php
        }
    ?>
</body>
</html>