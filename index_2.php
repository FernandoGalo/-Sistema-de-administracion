<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>
<body>
    <?php
        include("conexion_BD.php");
        //SELECT * FROM tbl_ms_usuario;
        $sql = "SELECT * FROM tbl_ms_usuario";
        $resultado = mysqli_query($conexion, $sql);
    ?>

    <h1>Lista de Usuarios</h1>
    <a href="agregar.php">Nuevo Alumno</a>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Rol de usuario</th>
                <th>Correo Electrónico</th>
                <th>Contraseña</th>
                <th>Fecha de creación</th>
                <th>Fecha de vencimiento</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($filas = mysqli_fetch_assoc($resultado)){
            ?>
            <tr>
            <td><?php echo $filas['Usuario']?></td> 
                    <td><?php echo $filas['Nombre_Usuario']?></td>
                    <td><?php echo $filas['ID_Rol']?></td>
                    <td><?php echo $filas['Correo_electronico']?></td>
                    <td><?php echo $filas['Contraseña']?></td>
                    <td><?php echo $filas['Fecha_Creacion']?></td>
                    <td><?php echo $filas['Fecha_Vencimiento']?></td>
                    <td>
                        <?php echo "<a href='editar_1.php?id=".$filas['ID_Usuario']."'>EDITAR</a>"; ?>
                        -
                        <?php echo "<a href=''>ELIMINAR</a>"; ?>
                    </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

</body>
</html>