<?php
include("../../conexion_BD.php");
$ID_Pago = $_GET['ID_de_pago'];

    
    try {

    $sql = "DELETE FROM tbl_pagos_realizados where ID_de_pago = '$ID_Pago'";
    $resultado = mysqli_query($conexion,$sql);



    if($resultado){
        echo "<script languaje='JavaScript'>
                alert('Los datos se eliminaron correctamente de la Base de Datos');
                location.assign('PagosAdm.php');
                </script>";     
               require_once "../../EVENT_BITACORA.php";
               $model = new EVENT_BITACORA;
               session_start();
               $_SESSION['idPagoBitdel']=$ID_Pago;
               $model->DeletePago();

        
    }else{
        if (mysqli_errno($conexion)) {
            echo "<script languaje='JavaScript'>
        alert('No puedes borrar este pago');
        location.assign('PagosAdm.php');
        </script>";   
        } else {
            echo "<script languaje='JavaScript'>
        alert('Los datos NO se eliminaron de la BD');
        location.assign('PagosAdm.php');
        </script>"; 
        }
          
    }
    $conexion->close();


        } catch (Exception $e) {
            $mensajeError = $e->getMessage();


            echo "<script languaje='JavaScript'>
            alert('Los datos NO se eliminaron de la BD por dependencias');
            location.assign('PagosAdm.php');
        </script>";
        }
    
?>