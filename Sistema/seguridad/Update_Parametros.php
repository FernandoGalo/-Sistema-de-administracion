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
        if(isset($_POST['Enviar_P'])){        
            //aqui entra sio el usuario ha presionado el boton enviar
            $ID_Parametro=$_POST['ID_Parametro'];
            $Parametro=$_POST['Parametro'];
            $Valor=$_POST['Valor'];
            $Fecha_actual = date('Y-m-d');

            //si lo que esta en el form esta vacio
            if(empty($Valor)){
                echo"<p class='error'>* Debe colocar un valor</p>";
            }





            //UPDATE tbl_voluntarios SET Usuario=$user WHERE Nombre_Usuario=$id;
            $sql="UPDATE tbl_ms_parametros SET Valor = '$Valor', ID_Usuario='$ID_Rol', Fecha_Modificacion='$Fecha_actual' WHERE ID_Parametro='$ID_Parametro';";
            $resultado=mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
						location.assign('ParametrosAdm.php');
						</script>";
            require_once "../../EVENT_BITACORA.php";
            $model = new EVENT_BITACORA;
             session_start();                       
                    $_SESSION['paraBitUP']=$Parametro;
                    $_SESSION['IDUsuarioBitUP']=$id;
                    $model->RegUptpara();
                    

            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('ParametrosAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        }
        else{
            //si el usuario NO ha presionado el boton enviar
            $id=$_GET['ID_Parametro']; //recuperar el id que se envia desde el home.html
            $sql2="SELECT * FROM tbl_ms_parametros where ID_Parametro='".$id."'";
            $resultado=mysqli_query($conexion,$sql2);

            $fila=mysqli_fetch_assoc($resultado);

            $ID_Parametro=$fila['ID_Parametro'];
            $Parametro=$fila['Descripcion_P'];
            $Valor=$fila['Valor'];//recuperando los datos desde la BD
           
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
                          <h1 class="box-title">Editar Parametro</h1>
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
                            <label>ID Parametros (*):</label>
                            <input type="hidden" name="ID_Parametro" id="ID_Parametro">
                            <input type="text" class="form-control" name="ID_Parametro" id="ID_Parametro" maxlength="10" value="<?php echo $ID_Parametro; ?>" readonly>
                          </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                              <label>Parametros (*):</label>
                              <input type="hidden" name="Parametro" id="Parametro">
                              <input style="text-transform:uppercase" type="text" class="form-control" name="Parametro" id="Parametro" maxlength="30" value="<?php echo $Parametro; ?>" readonly>
                            </div>

                            <?php 
                            //Permitir solo ingresar numeros
                          if ($ID_Parametro==1 or $ID_Parametro==2 or $ID_Parametro==4 or $ID_Parametro==7 or $ID_Parametro==9 or $ID_Parametro==10) { ?>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                              <label>Valor (*):</label>
                              <input type="hidden" name="Valor" id="Valor">
                              <input onpaste="return false" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text" class="form-control" name="Valor" id="Valor" maxlength="3" placeholder="Ingrese el valor" value="<?php echo $Valor; ?>" onkeypress="return bloquearEspacio(event);" required>
                            </div>
                          <?php }?>

                          <?php
                          //Permitir ingresar, caraceres, letras mayusculas y munisculas
                                if($ID_Parametro==3 or $ID_Parametro==6 ){ ?>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label>Valor (*):</label>
                                        <input type="hidden" name="Valor" id="Valor">
                                        <input onpaste="return false" type="text" class="form-control" name="Valor" id="Valor" maxlength="40" placeholder="Ingrese el valor" value="<?php echo $Valor; ?>" onkeypress="return bloquearEspacio(event);" onkeypress="return validateInput(event);"required>
                                      </div>
                          <?php }     ?>

                          <?php
                          //Permitir ingresar, caraceres, letras mayusculas y munisculas
                                if($ID_Parametro==5 or $ID_Parametro==8 ){ ?>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <label>Valor (*):</label>
                                        <input type="hidden" name="Valor" id="Valor">
                                        <input onpaste="return false" type="text" class="form-control" name="Valor" id="Valor" maxlength="40" placeholder="Ingrese el valor" value="<?php echo $Valor; ?>" onkeypress="return EspaciosMayus_Y_Minus(event)" required>
                                      </div>
                          <?php }     ?>



                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="Enviar_P" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="ParametrosAdm.php" style="color:white; text-decoration:none;">
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
    function validateInput(event) {
      const patron =  /^[a-zA-Z0-9\.\-_]+$/;
      const tecla = String.fromCharCode(event.keyCode || event.which);
      return patron.test(tecla);
      }

</script>

<script>
    //Validar Mayusculas, Minusculas, espacios
    function EspaciosMayus_Y_Minus(event) {
      const patron = /[A-Za-z\s]/;
      const tecla = String.fromCharCode(event.keyCode || event.which);
      return patron.test(tecla);
      }
  </script>

</body>
</html>