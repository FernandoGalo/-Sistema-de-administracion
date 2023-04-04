<?php
    include("../../conexion_BD.php");
    require_once "../../EVENT_BITACORA.php";
    
    session_start();     
    $usuario=$_SESSION['usuario'];
    $ID_Rol=$_SESSION['ID_Rol'];
    
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
	<link rel="stylesheet" href="../../css/main.css">

</head>
<body>
	<!--Seccion donde va toda la barra lateral -->
	<?php include '../sidebar.php'; ?>


    <?php
        if(isset($_POST['Enviar_Pregunta'])){        
            //aqui entra sio el usuario ha presionado el boton enviar
            $ID_Pregunta=$_POST["ID_Pregunta"];
            $pregunta=$_POST["Pregunta"];
            $Fecha_actual = date('Y-m-d');
            include("../../conexion_BD.php");
            // Los dcatos NO ingresaron a la BD
            $Pregunta = mysqli_real_escape_string($conexion, $pregunta);

            //si lo que esta en el form esta vacio
            if(empty($Pregunta)){
                echo"<p class='error'>* Debe colocar una Pregunta</p>";
            }





            //UPDATE tbl_voluntarios SET Usuario=$user WHERE Nombre_Usuario=$id;
            $sql="UPDATE tbl_preguntas SET Pregunta = '$Pregunta', Fecha_Modificacion='$Fecha_actual' WHERE ID_Pregunta='$ID_Pregunta';";
            $resultado=mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
						location.assign('PreguntasAdm.php');
						</script>";
                    
                   
                  
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('PreguntaAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        }
        else{
            //si el usuario NO ha presionado el boton enviar
            $id=$_GET['ID_Pregunta']; //recuperar el id que se envia desde el home.html
            $sql2="SELECT * FROM tbl_preguntas where ID_Pregunta='".$id."'";
            $resultado=mysqli_query($conexion,$sql2);

            $fila=mysqli_fetch_assoc($resultado);

            $ID_Pregunta=$fila['ID_Pregunta'];
            $Pregunta=$fila['Pregunta'];//recuperando los datos desde la BD
           
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
                          <h1 class="box-title">Editar Pregunta</h1>
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
                          <label>ID Pregunta(*):</label>
                            <input type="hidden" name="ID_Pregunta" id="ID_VID_Preguntaoluntario">
                            <input class="form-control" name="ID_Pregunta" id="ID_Pregunta" value="<?php echo $ID_Pregunta; ?>" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Pregunta(*):</label>
                            <input type="hidden" name="Pregunta" id="Pregunta">
                            <input onpaste="return false" type="text" class="form-control" name="Pregunta" id="Pregunta" value="<?php echo $Pregunta; ?>" maxlength="50" placeholder="Ingrese una pregunta" onkeypress="return validarEspaciosMayus_Y_Minus(event)" required>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="Enviar_Pregunta" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="PreguntasAdm.php" style="color:white; text-decoration:none;">
                          <i class="zmdi zmdi-close-circle"></i> Cancelar
                          </a>
                          </button>
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

  
  <script>
    //Validar Mayusculas, Minusculas, espacios y signo de interrogacion(¿,?)
    function validarEspaciosMayus_Y_Minus(event) {
      const patron = /[A-Za-z\s\?\¿]/;
      const tecla = String.fromCharCode(event.keyCode || event.which);
      return patron.test(tecla);
      }
  </script>


</body>
</html>