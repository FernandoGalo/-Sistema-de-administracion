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
            $nombre_Area_Trabajo=$_POST["nombre_Area_Trabajo"];
            $descripcion_A_Trabajo=$_POST["descripcion_A_Trabajo"];
            include("../../conexion_BD.php");

            $sql = "SELECT MAX(ID_Area_Trabajo) AS max_id FROM tbl_area_trabajo";
            $resultado = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_assoc($resultado);
            $ultimo_id = $row['max_id'];
            $nuevo_id = $ultimo_id + 1;

            $sql = "INSERT INTO tbl_area_trabajo (ID_Area_Trabajo, 	nombre_Area_Trabajo, descripcion_A_Trabajo) 
            VALUES ($nuevo_id,'$nombre_Area_Trabajo','$descripcion_A_Trabajo')";

            $resultado = mysqli_query($conexion,$sql);

            if($resultado){
                //Los datos ingresados a la BD
                echo "<script languaje='JavaScript'>
                        alert('Los datos fueron ingresados correctamente a la BD');
                            location.assign('area_trabajo_Adm.php');
                            </script>";     

            }else{
                // Los dcatos NO ingresaron a la BD
                echo "<script languaje='JavaScript'>
                alert('Los datos NO fueron ingresados a la BD');
                    location.assign('area_trabajo_Adm.php');
                    </script>";
            }
            mysqli_close($conexion);
            }
        
    ?>
</body>
</html>