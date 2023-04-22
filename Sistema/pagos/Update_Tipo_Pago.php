<?php
    include("../../conexion_BD.php");
    session_start();
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

    <?php
        if(isset($_POST['enviar_F2'])){   
    $ID_T_pago=$_POST["ID_T_pago"];
    $Nombre=$_POST["Nombre"];
            //si lo que esta en el form esta vacio
            $sql="UPDATE tbl_tipo_pago_r SET Nombre = '$Nombre' where ID_T_pago = $ID_T_pago";
            $resultado = mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                    location.assign('TipoPagosAdm.php');
                    </script>";

            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('TipoPagosAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        }else{
            //si el usuario NO ha presionado el boton enviar
            $id=$_GET['ID_T_pago']; //recuperar el id que se envia desde el home.html
            $sql="SELECT * FROM tbl_tipo_pago_r where ID_T_pago='".$id."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);

            $ID_T_pago=$fila['ID_T_pago'];
            $Nombre=$fila['Nombre'];
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
                          <h1 class="box-title">Editar Tipos de Pagos</h1>
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
                            <label>ID del tipo fondo(*):</label>
                            <input type="hidden" name="ID_T_pago" id="ID_T_pago">
                            <input style="text" type="text" class="form-control" name="ID_T_pago" id="ID_T_pago" maxlength="10"  value="<?php echo $ID_T_pago; ?>" readonly>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre Tipo Pago</label>
                            <input type="text" class="form-control"  name="Nombre" id="Nombre" placeholder="Ingrese el Tipo de Fondo" oninput="this.value = this.value.toUpperCase();" value="<?php echo $Nombre?>" require>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar_F2" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="TipoPagosAdm.php" style="color:white; text-decoration:none;">
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
  <script src="./js/usuario.js"></script>
  <?php include '../sidebarpro.php'; ?>
</body>
</html>