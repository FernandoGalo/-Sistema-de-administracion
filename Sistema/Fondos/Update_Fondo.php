<?php
    include("../../conexion_BD.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">

</head>
<body>
    <?php
        if(isset($_POST['enviar_F2'])){
            //aqui entra sio el usuario ha presionado el boton enviar
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
            //si lo que esta en el form esta vacio

            //UPDATE tbl_ms_usuario SET Usuario=$user WHERE Nombre_Usuario=$id;
            $sql="UPDATE tbl_fondos SET ID_Donante = $ID_Donador, ID_de_proyecto = $ID_Proyecto, ID_usuario = $ID_Usuario, Fecha_de_adquisicion_F  ='$Fecha_Adquisicion', Modificado_por= '$Usuario', Fecha_Modificacion = '$Fecha_actual' where ID_de_fondo = $ID_Fondo;";
            $resultado=mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                    location.assign('FondosAdm.php');
                    </script>";

            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('FondosAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        }else{
            //si el usuario NO ha presionado el boton enviar
            $id=$_GET['ID_de_fondo']; //recuperar el id que se envia desde el home.html
            $sql="SELECT * FROM tbl_fondos where ID_de_fondo='".$id."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);

            $ID_Fondo=$fila['ID_de_fondo'];
            $ID_Donador=$fila['ID_Donante'];
            $ID_Proyecto=$fila['ID_de_proyecto'];
            $ID_Usuario=$fila['ID_usuario'];
            $Fecha_Adquisicion=$fila['Fecha_de_adquisicion_F'];
            mysqli_close($conexion);
            
    ?>
    	<!-- Pagina de contenido-->
	<section class="full-box dashboard-contentPage" style="overflow-y: auto;">
	<<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>ID del fondo(*):</label>
                            <input type="hidden" name="ID_Fondo" id="ID_Fondo">
                            <input style="text" type="text" class="form-control" name="ID_Fondo" id="ID_Fondo" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  placeholder="<?php echo $id?>" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <?php require '../../conexion_BD.php';?>
                            <label>Donante(*):</label>

                            <?php
                           $sql=$conexion->query("SELECT * FROM tbl_donantes");
                          ?>
                            <select class="controls" type="text" name="Donante" id="Donante" required ><br>
                           <?php
                            while($row1=mysqli_fetch_array($sql)){
                            ?>
                             <option value="<?php echo $row1['ID_Donante'];?>"><?php echo $row1['Nombre_D'];?></option>
                            <?php
                             }
                            ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Proyecto(*):</label>
                            <?php
                           $sql2=$conexion->query("SELECT * FROM tbl_proyectos");
                          ?>
                            <select class="controls" type="text" name="Proyecto" id="Proyecto" required ><br>
                           <?php
                            while($row1=mysqli_fetch_array($sql2)){
                            ?>
                             <option value="<?php echo $row1['ID_proyecto'];?>"><?php echo $row1['Nombre_del_proyecto'];?></option>
                            <?php
                             }
                            ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Usuario</label>
                            <?php session_start();     
                            $usuario=$_SESSION['usuario'];?>
                            <input type="text" class="form-control"  name="Usuario" id="Usuario" maxlength="100" placeholder="<?php echo $usuario?>" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Fecha de Adquisicion:</label>
                            <input type="date" class="form-control" name="FechaAdquisicion" id="FechaAdquisicion" maxlength="100" placeholder="$Fecha_Adquisicion">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar_F2" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="zmdi zmdi-close-circle"></i> Cancelar</button>
                          </div>
                          </div>
                          </div>
	</section>
                        

    <?php
        }
    ?>



	<!--script en java para los efectos-->
	<script src="./js/jquery-3.1.1.min.js"></script>
  <script src="./js/events.js"></script>
	<script src="./js/main.js"></script>
  <script src="./js/usuario.js"></script>

</body>
</html>