<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGREGAR</title>
</head>
<body>
    <?php
    //===================================================
    
                        /*despues de haber validad todo el documento y que se haya cumplido todo comienza esta seccion */
    //====================================================
        if(isset($_POST['enviar_F'])){


            session_start();     
            $Usuario=$_SESSION['usuario'];
            
            echo $Usuario;        
    include("../../conexion_BD.php");
    $sql1=$conexion->query("SELECT * FROM `tbl_ms_usuario` WHERE Usuario='$Usuario'");

    while($row=mysqli_fetch_array($sql1)){
        $ID_Usuario=$row['ID_Usuario'];
    }
    
            $ID_Fondo=$_POST["ID_Fondo"];
            $ID_Proyecto=$_POST["Proyecto"];
            $ID_Donador=$_POST["Donante"];
            $Fecha_Adquisicion=$_POST["FechaAdquisicion"];
            $Fecha_actual = date('Y-m-d');
            include("../../conexion_BD.php");
            $sql = "INSERT INTO tbl_fondos (ID_de_fondo, ID_Donante, ID_de_proyecto, ID_usuario, Fecha_de_adquisicion_F, Creado_Por, Fecha_Creacion, Modificado_por, Fecha_Modificacion) 
            VALUES ($ID_Fondo, $ID_Donador, $ID_Proyecto, $ID_Usuario, '$Fecha_Adquisicion', '$Usuario','$Fecha_actual','$Usuario','$Fecha_actual')";

            $resultado = mysqli_query($conexion,$sql);

            if($resultado){
                //Los datos ingresados a la BD
                echo "<script languaje='JavaScript'>
                        alert('Los datos fueron ingresados correctamente a la BD');
                            location.assign('FondosAdm.php');
                            </script>";     
                            $model = new EVENT_BITACORA;
                            session_start();
 
                            $_SESSION['IDFondoBitacora']=$ID_Fondo;
                            $model->RegaInsertFondo();  


            }else{
                // Los dcatos NO ingresaron a la BD
                echo "<script languaje='JavaScript'>
                alert('Los datos NO fueron ingresados a la BD');
                    location.assign('FondosAdm.php');
                    </script>";
            }
            mysqli_close($conexion);
            }
        
    ?>
</body>
</html>