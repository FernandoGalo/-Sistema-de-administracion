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
    $Fecha_actual = date('Y-m-d');

            $ID_Voluntario=$_POST["ID_Voluntario"];
            $ID_proyecto=$_POST["ID_proyecto"];
            $ID_Area_Trabajo=$_POST["ID_Area_Trabajo"];
            $Fecha_Vinculacion_P=$_POST["Fecha_Vinculacion_P"];
            include("../../conexion_BD.php");


            $sql = "INSERT INTO tbl_voluntarios_proyectos (ID_Vinculacion_Proy, ID_Voluntario, ID_proyecto, ID_Area_Trabajo, Fecha_Vinculacion_P, Creado_Por, Fecha_Creacion, Modificado_por, Fecha_Modificacion	
            ) 
            VALUES (NULL,'$ID_Voluntario','$ID_proyecto','$ID_Area_Trabajo','$Fecha_Vinculacion_P', '$Usuario','$Fecha_actual','$Usuario','$Fecha_actual')";

            $resultado = mysqli_query($conexion,$sql);

            if($resultado){
                //Los datos ingresados a la BD
                echo "<script languaje='JavaScript'>
                        alert('Los datos fueron ingresados correctamente a la BD');
                            location.assign('voluntarios_proyectos_Adm.php');
                            </script>";     

            }else{
                // Los dcatos NO ingresaron a la BD
                echo "<script languaje='JavaScript'>
                alert('Los datos NO fueron ingresados a la BD');
                    location.assign('voluntarios_proyectos_Adm.php');
                    </script>";
            }
            mysqli_close($conexion);
            }
        
    ?>
</body>
</html>