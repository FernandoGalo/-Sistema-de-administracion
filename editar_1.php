<?php
    include("conexion_BD.php");
    //error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR</title>
</head>
<body>
    <?php

        if(isset($_POST['enviar'])){
            // Si el usuario ha presionado el boton enviar

        }else{
            // Aqui entra si no se ha presionado el boton enviar
            //$id=$_GET['ID_Usuario'];
            //$sql="SELECT * FROM tbl_ms_usuario WHERE ID_Usuario = '".$id."'";


            $id=$_GET['Nombre_Usuario'];
            $sql="SELECT * FROM tbl_ms_usuario WHERE Nombre_Usuario = '".$id."'";
            $resultado = mysqli_query($conexion, $sql);

            $fila = mysqli_fetch_assoc($resultado);

            $usuario = $fila["Usuario"];
            $nombreUsuario = $fila["Nombre_Usuario"];
            $rol = $fila["ID_Rol"];
            $correo = $fila["Correo_electronico"];
            $password = $fila["Contraseña"];
            $fechaCreacion = $fila["Fecha_Creacion"];
            $fechaVencimiento = $fila["Fecha_Vencimiento"];

            mysqli_close($conexion);
    ?>
    <h1>Editar Tabla Usuarios</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
 
        <label>Nombre Usuario:</label>
        <input type="text" name="nombreUsuario" value="<?php echo $nombreUsuario; ?>">
        <br>

        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?php echo $usuario; ?>">
        <br>

        <label>Contraseña:</label>
        <input type="text" name="password" value="<?php echo $password; ?>">
        <br>

        <label>Correo Electronico:</label>
        <input type="email" name="correo" value="<?php echo $correo; ?>">
        <br>

        <!-- <input type="hidden" name="id" value=""> -->

        <input type="submit" name="enviar" value="ACTUALIZAR">

        <a href="index.html">Regresar</a>

    </form>
    <?php
        }
    ?>

</body>
</html>


