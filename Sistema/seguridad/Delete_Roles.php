<?php
include("../../conexion_BD.php");
    $ID_Rol = $_GET['ID_Rol'];

    // $sql1=$conexion->query("SELECT * FROM `tbl_ms_usuario` WHERE Usuario='$Nombre_Usuario'");

    //              while($row=mysqli_fetch_array($sql1)){
    //                 $IDusuarioDel=$row['ID_Usuario'];
    //              }


    try {

        //DELETE FROM tbl_ms_usuario WHERE Usuario = $id
    $sql = "DELETE FROM tbl_ms_roles WHERE ID_Rol = '$ID_Rol'";
    $resultado = mysqli_query($conexion,$sql);



    if($resultado){
        echo "<script languaje='JavaScript'>
                alert('Los datos se eliminaron correctamente de la Base de Datos');
                location.assign('RolesAdm.php');
                </script>";     
                require_once "../../EVENT_BITACORA.php";
                $model = new EVENT_BITACORA;
                session_start();
                $_SESSION['UsuarioBitacoraDELETE']=$Nombre_Usuario;
                $_SESSION['IDUsuarioBitacoraDELETE']=$IDusuarioDel;
                $model->RegDelete();

                            
    }else{
        if (mysqli_errno($conexion)) {
            echo "<script languaje='JavaScript'>
        alert('No puedes borrar este usuario');
        location.assign('RolesAdm.php');
        </script>";   
        } else {
            echo "<script languaje='JavaScript'>
        alert('Los datos NO se eliminaron de la BD');
        location.assign('RolesAdm.php');
        </script>"; 
        }
          
    }
    $conexion->close();


        } catch (Exception $e) {
            $mensajeError = $e->getMessage();
            // echo "<script languaje='JavaScript'>
            //     alert('Excepción capturada: $mensajeError');
            //     location.assign('usuariosAdm.php');
            // </script>";

            echo "<script languaje='JavaScript'>
            alert('Los datos NO se eliminaron de la BD por dependencias');
            location.assign('RolesAdm.php');
        </script>";
        }
    
?>