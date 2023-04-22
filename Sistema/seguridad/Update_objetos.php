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
        if(isset($_POST['enviar'])){


            //$id_sar=$_POST['id_sar'];//id obtenido desde el formulario

            //$ID_SAR = $_POST['id_sar'];
            $idObje = $_POST['idObj'];
            $objeto = $_POST['objeto'];
            $descripcion = $_POST['descripcion'];
            $tipoObj = $_POST['tipoObj'];


            //si lo que esta en el form esta vacio
            // if(empty($RTN)){
            //     echo"<p class='error'>* Debes colocar tu RTN</p>";
            // }else if(empty($num_declaracion)){
            //     echo"<p class='error'>* Debes colocar el numero de declaracion</p>";
            // }else if(empty($nombre_razonSocial)){
            //     echo"<p class='error'>* Debes colocar la razon social</p>";
            // }else if(empty($correo)){
            //     echo"<p class='error'>* Debes colocar tu correo</p>";
            // }else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            //     echo "<p class='error'> El correo es incorrecto</p>";
            // }else if(empty($departamento)){
            //     echo "<p class='error'> Debes colocar un Departamento </p>";
            // }else if(empty($municipio)){
            //     echo "<p class='error'> Debes colocar un municipio</p>";
            // }else if(empty($barrio_colonia)){
            //     echo "<p class='error'> Debes colocar un barrio o colonia</p>";
            // }else if(empty($calle_avenida)){
            //     echo "<p class='error'> Debes colocar la calle o avenida</p>";
            // }else if(empty($num_casa)){
            //     echo "<p class='error'> Debes colocar el numero de casa</p>";
            // }else if(empty($bloque)){
            //     echo "<p class='error'> Debes colocar el bloque</p>";
            // }else if(empty($telefono)){
            //     echo "<p class='error'> Debes colocar un numero telefonico fijo </p>";
            // }else if(empty($celular)){
            //     echo "<p class='error'> Debes colocar un numero telefonico celular</p>";
            // }else if(empty($domicilio)){
            //     echo "<p class='error'> Debes colocar el domicilio</p>";
            // }else if(empty($profesion_oficio)){
            //     echo "<p class='error'> Debes colocar la profesion u oficio</p>";
            // }else if(empty($cai)){
            //     echo "<p class='error'> Debes colocar el codigo cai</p>";
            // }else if(empty($fecha_limite_emision)){
            //     echo "<p class='error'> Debes colocar la fecha limite</p>";
            // }else if(empty($num_inicial)){
            //     echo "<p class='error'> Debes colocar el numero inicial</p>";
            // }else if(empty($num_final)){
            //     echo "<p class='error'> Debes colocar el numero final</p>";
            // }else{


            $sql = "UPDATE tbl_objetos SET Objeto = '$objeto', Descripcion = '$descripcion', Tipo_Objeto = '$tipoObj' WHERE ID_Objeto = $idObje;";

            $resultado=mysqli_query($conexion,$sql);



            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                    location.assign('ObjetosAdm.php');
                    </script>";
                    require_once "../../EVENT_BITACORA.php";
                    $model = new EVENT_BITACORA;
                     session_start();                       
                            $_SESSION['$RTNsarBitUP']= $RTN;
                            $model->RegUptSar(); 
                    
            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('ObjetosAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        
        }else{
            //si el usuario NO ha presionado el boton enviar
            $id_objeto=$_GET['ID_Objeto']; //recuperar el id que se envia desde el home.html
            $sql="SELECT * FROM tbl_objetos where ID_Objeto = $id_objeto";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);

            $IDobj = $fila['ID_Objeto'];
            $objeto = $fila['Objeto'];
            $descripcion = $fila['Descripcion'];
            $tipo_objeto = $fila['Tipo_Objeto'];

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
                          <h1 class="box-title">Editar datos</h1>
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
                            <label>OBJETO(*):</label>
                            <input type="hidden" name="objeto" id="objeto">
                            <input type="text" class="form-control" name="objeto" id="objeto" maxlength="100" placeholder="Ingrese el Numero de declaracion" value="<?php echo $objeto?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>DESCRIPCION(*):</label>
                            <input type="hidden" name="descripcion" id="descripcion">
                            <input style="text-transform:uppercase" type="text" class="form-control" name="descripcion" id="descripcion" maxlength="100" placeholder="Ingrese el nombre o razon social" value="<?php echo $descripcion ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>TIPO DE OBJETO(*):</label>
                            <input type="hidden" name="tipoObj" id="tipoObj">
                            <input style="text-transform:uppercase" type="text" class="form-control" name="tipoObj" id="tipoObj" maxlength="100" placeholder="Ingrese el Barrio o Colonia" value="<?php echo $tipo_objeto?>" required>
                          </div>

                          <input type="hidden" name="id" value="<?php echo $id_sar; ?>">

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="ObjetosAdm.php" style="color:white; text-decoration:none;">
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

</body>
</html>