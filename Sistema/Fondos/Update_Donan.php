<?php 
//Controladores importantes
 require '../../conexion_BD.php'; 
 require_once "../../EVENT_BITACORA.php";
 session_start();     
 $usuario=$_SESSION['user'];
 $ID_Rol=$_SESSION['ID_Rol'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">

</head>
<body>
	<!--Seccion donde va toda la barra lateral -->
	<?php include '../sidebar.php'; ?>

    <?php
    
        if(isset($_POST['enviar'])){
            //aqui entra sio el usuario ha presionado el boton enviar
            $ID_donante=$_POST['ID_donante'];
            $Nombre_donan=$_POST['Nombre_Donante'];
            $Telef=$_POST['Telef'];//Obtenidos desde el formulario
            $Direcc= $_POST['Direccion'];
            $email=$_POST['Correo_electronico'];
            $R_Fecha_actual = date('Y-m-d'); 



            //si lo que esta en el form esta vacio
            if(empty($Nombre_donan)){
                echo"<p class='error'>* Debes colocar tu nombre completo</p>";
            }else if(empty($Telef)){
                echo"<p class='error'>* Debes colocar tu usuario</p>";
            }else if(empty($Direcc)){
                echo"<p class='error'>* Debes colocar tu password</p>";
            }else if(empty($email)){
                echo"<p class='error'>* Debes colocar tu correo</p>";
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<p class='error'> El correo es incorrecto</p>";
            }else{

            //UPDATE tbl_ms_usuario SET Usuario=$user WHERE Nombre_Usuario=$id;
            $sql="UPDATE tbl_donantes SET Nombre_D = '$Nombre_donan', Tel_cel_D = '$Telef', Direccion_D = '$Direcc' , Correo_D = '$email', Fecha_Modificacion = '$R_Fecha_actual' WHERE ID_Donante='$ID_donante';";
            $resultado=mysqli_query($conexion,$sql);
            //Modificado_por = '$Usuario'//

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                    location.assign('DonacAdm.php');
                    </script>";
                    require_once "../../EVENT_BITACORA.php";
                    $model = new EVENT_BITACORA;
                    session_start();

                    $_SESSION['donanteBitacoraUP']=$Nombre_donan;
                    $model->RegUptdon();
            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('DonacAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        }
        }else{
            //si el usuario NO ha presionado el boton enviar/
            $id=$_GET['ID_Donante']; //recuperar el id que se envia desde el home.html
            $sql="SELECT * FROM tbl_donantes where ID_Donante='".$id."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);

            $IdDonan=$fila['ID_Donante'];
            $Nombre_donan=$fila['Nombre_D'];
            $Tel_Cel=$fila['Tel_cel_D'];
            $Direcc=$fila['Direccion_D'];//recuperando los datos desde la BD
            $correo=$fila['Correo_D'];

            mysqli_close($conexion);

    ?>
    	<!-- Pagina de contenido-->
	<section class="full-box dashboard-contentPage" style="overflow-y: auto;">
		<!-- Barra superior -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
			</ul>
		</nav>
		<!-- Muestra el contenido de la pagina -->
		<div class="container-fluid">
        <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Editar Donantes</h1>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>ID_Usuario(*):</label>
                            <input type="hidden" name="ID_donante" id="ID_donante">
                            <input type="text" class="form-control" name="ID_donante" id="ID_donante" maxlength="100" value="<?php echo $IdDonan; ?>" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre Donante(*):</label>
                            <input type="hidden" name="Nombre_Donante" id="Nombre_Donante">
                            <input type="text" value="<?php echo $Nombre_donan; ?>" class="form-control" name="Nombre_Donante" id="Nombre_Donante" maxlength="100" placeholder="Ingrese el nombre del donante" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Telefono(*):</label>
                            <input type="hidden" name="Telef" id="Telef">
                            <input type="text" value="<?php echo $Tel_Cel; ?>" class="form-control" name="Telef" id="Telef" pattern="[0-9()+-]{8,20}" maxlength="20" placeholder="Ingrese el número de teléfono" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Direccion(*):</label>
                            <input type="hidden" name="Direccion" id="Direccion">
                            <input type="text" class="form-control" name="Direccion" id="Direccion" maxlength="100" placeholder="Ingrese la dirrecion del donante" value="<?php echo $Direcc; ?>" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Correo electronico(*):</label>
                            <input type="hidden" name="Correo_electronico" id="Correo_electronico">
                            <input type="text" class="form-control" name="Correo_electronico" id="Correo_electronico" maxlength="100" placeholder="Ingrese el correo electronico" onkeypress="validarCorreo(event)" value="<?php echo $correo; ?>"  required>
                          </div>
                          <button class="btn btn-primary" type="submit" name="enviar" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="usuariosAdm.php" style="color:white; text-decoration:none;">
                          <i class="zmdi zmdi-close-circle"></i> Cancelar
                          </a>
                        </div>
                          </div>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
		</div>
	</section>
                        

    <?php
        }
    ?>



	<!--script en java para los efectos-->
	<script src="../../js/jquery-3.1.1.min.js"></script>
  <script src="../../js/events.js"></script>
	<script src="../../js/main.js"></script>
  <script src="../../js/usuario.js"></script>

</body>
</html>