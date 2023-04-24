<!DOCTYPE html>
<html lang="en">
<body>
    <?php
    //===================================================
    
                        /*despues de haber validad todo el documento y que se haya cumplido todo comienza esta seccion */
    //====================================================
        if(isset($_POST['enviar'])){


            session_start();     
            $Usuario=$_SESSION['usuario'];     
    include("../../conexion_BD.php");
    $sql1=$conexion->query("SELECT * FROM `tbl_ms_usuario` WHERE Usuario='$Usuario'");

    while($row=mysqli_fetch_array($sql1)){
        $ID_Usuario=$row['ID_Usuario'];
    }
            $nomb_proyec=$_POST["Nombre_proyecto"];
            $Fecha_ini=$_POST["Fechaini"];
            $Fecha_final=$_POST["Fechafinal"];
            $Fondos_proyec=$_POST["Monto_proyectados"];
            $estado=$_POST["estado"];
            $Fecha_actual = date('Y-m-d');
            
            include("../../conexion_BD.php");
            $fecha_inicio_timestamp = strtotime($Fecha_ini);
$fecha_fin_timestamp = strtotime($Fecha_final);
if ($fecha_inicio_timestamp > $fecha_fin_timestamp) {
   echo "<script languaje='JavaScript'>
                        alert('La fecha de inicio no puede ser mayor que la fecha de finalización. Por favor ingrese las fechas nuevamente');
                            location.assign('proyectosAdm.php');
                            </script>";
    exit();
}
            $sql = "INSERT INTO tbl_proyectos ( ID_usuario ,Nombre_del_proyecto ,Fecha_de_inicio_P ,Fecha_final_P ,Fondos_proyecto , Estado_Proyecto , Creado_Por, Fecha_Creacion) 
            VALUES ('$ID_Usuario', '$nomb_proyec' , '$Fecha_ini' ,'$Fecha_final' ,$Fondos_proyec, '$estado' , '$Usuario','$Fecha_actual')";

            $resultado = mysqli_query($conexion,$sql);

            if($resultado){
                //Los datos ingresados a la BD
                echo "<script languaje='JavaScript'>
                        alert('Los datos fueron ingresados correctamente a la BD');
                            location.assign('proyectosAdm.php');
                            </script>";     
                            require_once "../../EVENT_BITACORA.php";
                            $model = new EVENT_BITACORA;
                            session_start();
                            $_SESSION['projectBitacora']=$nomb_proyec;
                            $model->InsertProj();  

            }else{
                // Los dcatos NO ingresaron a la BD
                echo "<script languaje='JavaScript'>
                alert('Los datos NO fueron ingresados a la BD');
                    location.assign('proyectosAdm.php');
                    </script>";
            }
            mysqli_close($conexion);
            }
        
    ?>
</body>
</html>