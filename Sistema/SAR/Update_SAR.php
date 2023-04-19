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


            $id_sar=$_POST['id_sar'];//id obtenido desde el formulario

            //$ID_SAR = $_POST['id_sar'];
            $RTN = $_POST['rtn'];
            $num_declaracion = $_POST['numDeclaracion'];
            $nombre_razonSocial = $_POST['razonSocial'];
            $departamento = $_POST['departamento'];
            $municipio = $_POST['municipio'];
            $barrio_colonia = $_POST['barrioColonia'];
            $calle_avenida = $_POST['calleAvenida'];
            $num_casa = $_POST['numCasa'];
            $bloque = $_POST['bloque'];
            $telefono = $_POST['telFijo'];
            $celular = $_POST['telCelular'];
            $domicilio = $_POST['domicilio'];
            $correo = $_POST['Correo_electronico'];
            $profesion_oficio = $_POST['profesionOficio'];
            $cai = $_POST['cai'];
            $fecha_limite_emision = $_POST['fechaEmision'];
            $num_inicial = $_POST['numeroInicial'];
            $num_final = $_POST['numeroFinal'];


            //si lo que esta en el form esta vacio
            if(empty($RTN)){
                echo"<p class='error'>* Debes colocar tu RTN</p>";
            }else if(empty($num_declaracion)){
                echo"<p class='error'>* Debes colocar el numero de declaracion</p>";
            }else if(empty($nombre_razonSocial)){
                echo"<p class='error'>* Debes colocar la razon social</p>";
            }else if(empty($correo)){
                echo"<p class='error'>* Debes colocar tu correo</p>";
            }else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                echo "<p class='error'> El correo es incorrecto</p>";
            }else if(empty($departamento)){
                echo "<p class='error'> Debes colocar un Departamento </p>";
            }else if(empty($municipio)){
                echo "<p class='error'> Debes colocar un municipio</p>";
            }else if(empty($barrio_colonia)){
                echo "<p class='error'> Debes colocar un barrio o colonia</p>";
            }else if(empty($calle_avenida)){
                echo "<p class='error'> Debes colocar la calle o avenida</p>";
            }else if(empty($num_casa)){
                echo "<p class='error'> Debes colocar el numero de casa</p>";
            }else if(empty($bloque)){
                echo "<p class='error'> Debes colocar el bloque</p>";
            }else if(empty($telefono)){
                echo "<p class='error'> Debes colocar un numero telefonico fijo </p>";
            }else if(empty($celular)){
                echo "<p class='error'> Debes colocar un numero telefonico celular</p>";
            }else if(empty($domicilio)){
                echo "<p class='error'> Debes colocar el domicilio</p>";
            }else if(empty($profesion_oficio)){
                echo "<p class='error'> Debes colocar la profesion u oficio</p>";
            }else if(empty($cai)){
                echo "<p class='error'> Debes colocar el codigo cai</p>";
            }else if(empty($fecha_limite_emision)){
                echo "<p class='error'> Debes colocar la fecha limite</p>";
            }else if(empty($num_inicial)){
                echo "<p class='error'> Debes colocar el numero inicial</p>";
            }else if(empty($num_final)){
                echo "<p class='error'> Debes colocar el numero final</p>";
            }else{



            //UPDATE tbl_ms_usuario SET Usuario=$user WHERE Nombre_Usuario=$id;
            // $sql="UPDATE tbl_r_sar SET RTN = $RTN, num_declaracion = $num_declaracion, nombre_razonSocial = '$nombre_razonSocial', departamento = '$departamento', municipio = '$municipio', barrio_colonia = '$barrio_colonia', calle_avenida = '$calle_avenida', num_casa = $num_casa, bloque = $bloque, telefono = $telefono, celular = $celular, domicilio = '$domicilio', correo = '$correo', profesion_oficio = '$profesion_oficio', cai = '$cai', fecha_limite_emision = '$fecha_limite_emision', num_inicial = $num_inicial, num_final = $num_final = $bloque WHERE ID_SAR='$id_sar';";


            $sql = "UPDATE tbl_r_sar SET RTN = $RTN, num_declaracion = $num_declaracion, nombre_razonSocial = '$nombre_razonSocial', departamento = '$departamento', municipio = '$municipio', barrio_colonia = '$barrio_colonia', calle_avenida = '$calle_avenida', num_casa = $num_casa, bloque = $bloque, telefono = $telefono, celular = $celular, domicilio = '$domicilio', correo = '$correo', profesion_oficio = '$profesion_oficio', cai = '$cai', fecha_limite_emision = '$fecha_limite_emision', num_inicial = $num_inicial, num_final = $num_final WHERE ID_SAR = $id_sar;";

            $resultado=mysqli_query($conexion,$sql);



            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                    location.assign('SAR_Adm.php');
                    </script>";
                    require_once "../../EVENT_BITACORA.php";
                    $model = new EVENT_BITACORA;
                     session_start();                       
                            $_SESSION['$RTNsarBitUP']= $RTN;
                            $model->RegUptSar(); 
                    
            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('SAR_Adm.php');
            </script>";
            }
            mysqli_close($conexion);
        }
        }else{
            //si el usuario NO ha presionado el boton enviar
            $id_sar=$_GET['id_sar']; //recuperar el id que se envia desde el home.html
            $sql="SELECT * FROM tbl_r_sar where ID_SAR ='".$id_sar."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);


            //$ID_SAR = $fila['ID_SAR']; //recuperando los datos desde la BD
            $RTN = $fila['RTN'];
            $num_declaracion = $fila['num_declaracion'];
            $nombre_razonSocial = $fila['nombre_razonSocial'];
            $departamento = $fila['departamento'];
            $municipio = $fila['municipio'];
            $barrio_colonia = $fila['barrio_colonia'];
            $calle_avenida = $fila['calle_avenida'];
            $num_casa = $fila['num_casa'];
            $bloque = $fila['bloque'];
            $telefono = $fila['telefono'];
            $celular = $fila['celular'];
            $domicilio = $fila['domicilio'];
            $correo = $fila['correo'];
            $profesion_oficio = $fila['profesion_oficio'];
            $cai = $fila['cai'];
            $fecha_limite_emision = $fila['fecha_limite_emision'];
            $num_inicial = $fila['num_inicial'];
            $num_final = $fila['num_final'];


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
                            <label>ID SAR:</label>
                            <input type="hidden" name="id_sar" id="id_sar">
                            <input type="number" class="form-control" name="id_sar" id="id_sar" maxlength="100" placeholder="Ingrese el ID SAR"  value="<?php echo $id_sar; ?>" readonly required>
                          </div>
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>RTN(*):</label>
                            <input type="hidden" name="rtn" id="rtn">
                            <input type="text" class="form-control" name="rtn" id="rtn" maxlength="100" placeholder="Ingrese el RTN" value="<?php echo $RTN; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Numero de declaracion(*):</label>
                            <input type="hidden" name="numDeclaracion" id="numDeclaracion">
                            <input type="text" class="form-control" name="numDeclaracion" id="numDeclaracion" maxlength="100" placeholder="Ingrese el Numero de declaracion" value="<?php echo $num_declaracion; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre o Razon Social(*):</label>
                            <input type="hidden" name="razonSocial" id="razonSocial">
                            <input type="text" class="form-control" name="razonSocial" id="razonSocial" maxlength="100" placeholder="Ingrese el nombre o razon social" value="<?php echo $nombre_razonSocial; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Departamento(*):</label>
                            <input type="hidden" name="departamento" id="departamento">
                            <input type="text" class="form-control" name="departamento" id="departamento" maxlength="100" placeholder="Ingrese el Departamento" value="<?php echo $departamento; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Municipio(*):</label>
                            <input type="hidden" name="municipio" id="municipio">
                            <input type="text" class="form-control" name="municipio" id="municipio" maxlength="100" placeholder="Ingrese el Municipio" value="<?php echo $municipio; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Barrio o Colonia(*):</label>
                            <input type="hidden" name="barrioColonia" id="barrioColonia">
                            <input type="text" class="form-control" name="barrioColonia" id="barrioColonia" maxlength="100" placeholder="Ingrese el Barrio o Colonia" value="<?php echo $barrio_colonia; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Calle o Avenida(*):</label>
                            <input type="hidden" name="calleAvenida" id="calleAvenida">
                            <input type="text" class="form-control" name="calleAvenida" id="calleAvenida" maxlength="100" placeholder="Ingrese la calle o avenida" value="<?php echo $calle_avenida; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Numero de casa(*):</label>
                            <input type="hidden" name="numCasa" id="numCasa">
                            <input type="text" class="form-control" name="numCasa" id="numCasa" maxlength="100" placeholder="Ingrese el numero de casa" value="<?php echo $num_casa; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Bloque(*):</label>
                            <input type="hidden" name="bloque" id="bloque">
                            <input type="text" class="form-control" name="bloque" id="bloque" maxlength="100" placeholder="Ingrese el bloque" value="<?php echo $bloque; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Telefono Fijo:</label>
                            <input type="hidden" name="telFijo" id="telFijo">
                            <input type="text" class="form-control" name="telFijo" id="telFijo" maxlength="100" placeholder="Ingrese el Telefono Fijo" value="<?php echo $telefono; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Celular(*):</label>
                            <input type="hidden" name="telCelular" id="telCelular">
                            <input type="text" class="form-control" name="telCelular" id="telCelular" maxlength="100" placeholder="Ingrese el Telefono Celular" value="<?php echo $celular; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Domicilio(*):</label>
                            <input type="hidden" name="domicilio" id="domicilio">
                            <input type="text" class="form-control" name="domicilio" id="domicilio" maxlength="100" placeholder="Ingrese el Domicilio" value="<?php echo $domicilio; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Correo electronico(*):</label>
                            <input type="hidden" name="Correo_electronico" id="Correo_electronico">
                            <input type="text" class="form-control" name="Correo_electronico" id="Correo_electronico" maxlength="100" placeholder="Ingrese el correo electronico" value="<?php echo $correo; ?>" onkeypress="validarCorreo(event)" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Profesion u Oficio(*):</label>
                            <input type="hidden" name="profesionOficio" id="profesionOficio">
                            <input type="text" class="form-control" name="profesionOficio" id="profesionOficio" maxlength="100" placeholder="Ingrese la profesion u Oficio" value="<?php echo $profesion_oficio; ?>"required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>CAI(*):</label>
                            <input type="hidden" name="cai" id="cai">
                            <input type="text" class="form-control" name="cai" id="cai" maxlength="100" placeholder="Ingrese el codigo CAI" value="<?php echo $cai; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Fecha Limite de Emision(*):</label>
                            <input type="hidden" name="fechaEmision" id="fechaEmision">
                            <input type="date" class="form-control" name="fechaEmision" id="fechaEmision" maxlength="100" placeholder="Ingrese la fecha de emision" value="<?php echo $fecha_limite_emision; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Numero Inicial(*):</label>
                            <input type="hidden" name="numeroInicial" id="numeroInicial">
                            <input type="text" class="form-control" name="numeroInicial" id="numeroInicial" maxlength="100" placeholder="Ingrese el Numero Inicial" value="<?php echo $num_inicial; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Numero Final(*):</label>
                            <input type="hidden" name="numeroFinal" id="numeroFinal">
                            <input type="text" class="form-control" name="numeroFinal" id="numeroFinal" maxlength="100" placeholder="Ingrese el Numero Final" value="<?php echo $num_final; ?>" required>
                          </div>

                          <input type="hidden" name="id" value="<?php echo $id_sar; ?>">

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="SAR_Adm.php" style="color:white; text-decoration:none;">
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