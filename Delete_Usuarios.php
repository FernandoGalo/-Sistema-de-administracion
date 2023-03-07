<?php 
    include("conexion_BD.php");
    $Nombre_Usuario = $_GET['Nombre_Usuario'];

    //DELETE FROM tbl_ms_usuario WHERE Usuario = $id
    $sql = "DELETE FROM tbl_ms_usuario WHERE Nombre_Usuario = '$Nombre_Usuario'";
    $resultado = mysqli_query($conexion,$sql);

    if($resultado){
        echo "<script languaje='JavaScript'>
                alert('Los datos se eliminaron correctamente de la Base de Datos');
                location.assign('usuariosAdm.php');
                </script>
         ";      
    }else{
        echo "<script languaje='JavaScript'>
        alert('Los datos NO se eliminaron de la BD');
        location.assign('usuariosAdm.php');
        </script>";   
    }
?>