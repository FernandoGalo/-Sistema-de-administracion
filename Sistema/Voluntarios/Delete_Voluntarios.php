<?php
include("../../conexion_BD.php");
    $ID_Voluntario = $_GET['ID_Voluntario'];
    try {

        //DELETE FROM tbl_ms_usuario WHERE Usuario = $id
    $sql = "DELETE FROM tbl_voluntarios where ID_Voluntario = '$ID_Voluntario'";
    $resultado = mysqli_query($conexion,$sql);



    if($resultado){
        echo "<script languaje='JavaScript'>
                alert('Los datos se eliminaron correctamente de la Base de Datos');
                location.assign('VoluntariosAdm.php');
                </script>";     
                require_once "../../EVENT_BITACORA.php";
                $model = new EVENT_BITACORA;
                session_start();
                $_SESSION['idVolBitacoraDELETE']=$ID_Voluntario;
                $model->DeleteVol();
        
    }else{
        if (mysqli_errno($conexion)) {
            echo "<script languaje='JavaScript'>
        alert('No puedes borrar este usuario');
        location.assign('VoluntariosAdm.php');
        </script>";   
        } else {
            echo "<script languaje='JavaScript'>
        alert('Los datos NO se eliminaron de la BD');
        location.assign('VoluntariosAdm.php');
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
            location.assign('VoluntariosAdm.php');
        </script>";
        }
    
?>