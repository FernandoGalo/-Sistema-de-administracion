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
            $id_sar=$_GET['ID_SAR']; //recuperar el id que se envia desde el home.html
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

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Departamento(*):</label>
                              <select class="form-control" name="departamento" id="departamento" onchange="cargarOpciones()">
                                <option value="">Selecione un departamento</option>
                                <option value="Atlántida">Atlántida</option>
                                <option value="Colón">Colón</option>
                                <option value="Comayagua">Comayagua</option>
                                <option value="Copán">Copán</option>
                                <option value="Cortés">Cortés</option>
                                <option value="Choluteca">Choluteca</option>
                                <option value="El Paraíso">El Paraíso</option>
                                <option value="Francisco Morazán">Francisco Morazán</option>
                                <option value="Gracias a Dios">Gracias a Dios</option>
                                <option value="Intibucá">Intibucá</option>
                                <option value="Islas de la Bahía">Islas de la Bahía</option>
                                <option value="La Paz">La Paz</option>
                                <option value="Lempira">Lempira</option>
                                <option value="Ocotepeque">Ocotepeque</option>
                                <option value="Olancho">Olancho</option>
                                <option value="Santa Bárbara">Santa Bárbara</option>
                                <option value="Valle">Valle</option>
                                <option value="Yoro">Yoro</option>
                              </select>
                          </div>
                             
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Municipio:</label>
                            <select class="form-control" name="municipio" id="municipio"></select>
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
                            <input type="text" class="form-control" name="telFijo" id="telFijo" maxlength="8" placeholder="Ingrese el Telefono Fijo" value="<?php echo $telefono; ?>" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Celular(*):</label>
                            <input type="hidden" name="telCelular" id="telCelular">
                            <input type="text" class="form-control" name="telCelular" id="telCelular" maxlength="8" placeholder="Ingrese el Telefono Celular" value="<?php echo $celular; ?>" required>
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
                            <label>Fecha Limite de Emision(ACTUAL):</label>
                            <input type="hidden" name="fechaEmision" id="fechaEmision">
                            <input type="input" class="form-control" name="fechaEmision" id="fechaEmision" maxlength="100" placeholder="Ingrese la fecha de emision" value="<?php echo $fecha_limite_emision; ?>" readonly required>
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

<script>
  function cargarOpciones() {
  var departamento = document.getElementById("departamento");
  var municipio = document.getElementById("municipio");
  
  // Vaciar el segundo combobox
  municipio.innerHTML = "";
  
  // Agregar opciones según la opción seleccionada en el primer combobox
  if (departamento.value === "Atlántida") {
    municipio.add(new Option("La Ceiba", "La Ceiba"));
    municipio.add(new Option("El Porvenir", "El Porvenir"));
    municipio.add(new Option("Tela", "Tela"));
    municipio.add(new Option("Jutiapa", "Jutiapa"));
    municipio.add(new Option("La Masica", "La Masica"));
    municipio.add(new Option("San Francisco", "San Francisco"));
    municipio.add(new Option("Arizona", "Arizona"));
    municipio.add(new Option("Esparta", "Esparta"));
  } else if (departamento.value === "Colón") {
    municipio.add(new Option("Trujillo", "Trujillo"));
    municipio.add(new Option("Balfate", "Balfate"));
    municipio.add(new Option("Iriona", "Iriona"));
    municipio.add(new Option("Limón", "Limón"));
    municipio.add(new Option("Sabá", "Sabá"));
    municipio.add(new Option("Santa Fe", "Santa Fe"));
    municipio.add(new Option("Santa Rosa de Aguán", "Santa Rosa de Aguán"));
    municipio.add(new Option("Sonaguera", "Sonaguera"));
    municipio.add(new Option("Tocoa", "Tocoa"));
    municipio.add(new Option("Bonito Oriental", "Bonito Oriental"));
  } else if (departamento.value === "Comayagua") {
    municipio.add(new Option("Comayagua", "Comayagua"));
    municipio.add(new Option("Ajuterique", "Ajuterique"));
    municipio.add(new Option("El Rosario", "El Rosario"));
    municipio.add(new Option("Esquías", "Esquías"));
    municipio.add(new Option("Humuya", "Humuya"));
    municipio.add(new Option("La Libertad", "La Libertad"));
    municipio.add(new Option("Lamaní", "Lamaní"));
    municipio.add(new Option("La Trinidad", "La Trinidad"));
    municipio.add(new Option("Lejamaní", "Lejamaní"));
    municipio.add(new Option("Meámbar", "Meámbar"));
    municipio.add(new Option("Minas de Oro", "Minas de Oro"));
    municipio.add(new Option("Ojos de Agua", "Ojos de Agua"));
    municipio.add(new Option("San Jerónimo", "San Jerónimo"));
    municipio.add(new Option("San José de Comayagua", "San José de Comayagua"));
    municipio.add(new Option("San José del Potrero", "San José del Potrero"));
    municipio.add(new Option("San Luis", "San Luis"));
    municipio.add(new Option("San Sebastián", "San Sebastián"));
    municipio.add(new Option("Siguatepeque", "Siguatepeque"));
    municipio.add(new Option("Villa de San Antonio", "Villa de San Antonio"));
    municipio.add(new Option("Las Lajas", "Las Lajas"));
    municipio.add(new Option("Taulabé", "Taulabé"));
  } else if (departamento.value === "Copán") {
    municipio.add(new Option("Santa Rosa de Copán", "Santa Rosa de Copán"));
    municipio.add(new Option("Cabañas", "Cabañas"));
    municipio.add(new Option("Concepción", "Concepción"));
    municipio.add(new Option("Copán Ruinas", "Copán Ruinas"));
    municipio.add(new Option("Corquín", "Corquín"));
    municipio.add(new Option("Cucuyagua", "Cucuyagua"));
    municipio.add(new Option("Dolores", "Dolores"));
    municipio.add(new Option("Dulce Nombre", "Dulce Nombre"));
    municipio.add(new Option("El Paraíso", "El Paraíso"));
    municipio.add(new Option("Florida", "Florida"));
    municipio.add(new Option("La Jigua", "La Jigua"));
    municipio.add(new Option("La Unión", "La Unión"));
    municipio.add(new Option("Nueva Arcadia", "Nueva Arcadia"));
    municipio.add(new Option("San Agustín", "San Agustín"));
    municipio.add(new Option("San Antonio", "San Antonio"));
    municipio.add(new Option("San Jerónimo", "San Jerónimo"));
    municipio.add(new Option("San José", "San José"));
    municipio.add(new Option("San Juan de Opoa", "San Juan de Opoa"));
    municipio.add(new Option("San Nicolás", "San Nicolás"));
    municipio.add(new Option("San Pedro", "San Pedro"));
    municipio.add(new Option("Santa Rita", "Santa Rita"));
    municipio.add(new Option("Trinidad de Copán", "Trinidad de Copán"));
    municipio.add(new Option("Veracruz", "Veracruz"));
  }else if (departamento.value === "Cortés") {
    municipio.add(new Option("San Pedro Sula", "San Pedro Sula"));
    municipio.add(new Option("Choloma", "Choloma"));
    municipio.add(new Option("Omoa", "Omoa"));
    municipio.add(new Option("Pimienta", "Pimienta"));
    municipio.add(new Option("Potrerillos", "Potrerillos"));
    municipio.add(new Option("Puerto Cortés", "Puerto Cortés"));
    municipio.add(new Option("San Antonio de Cortés", "San Antonio de Cortés"));
    municipio.add(new Option("San Francisco de Yojoa", "San Francisco de Yojoa"));
    municipio.add(new Option("San Manuel", "San Manuel"));
    municipio.add(new Option("Santa Cruz de Yojoa", "Santa Cruz de Yojoa"));
    municipio.add(new Option("Villanueva", "Villanueva"));
    municipio.add(new Option("La Lima", "La Lima"));
  }else if (departamento.value === "Choluteca") {
    municipio.add(new Option("Choluteca", "Choluteca"));
    municipio.add(new Option("Apacilagua", "Apacilagua"));
    municipio.add(new Option("Concepción de María", "Concepción de María"));
    municipio.add(new Option("Duyure", "Duyure"));
    municipio.add(new Option("El Corpus", "El Corpus"));
    municipio.add(new Option("El Triunfo", "El Triunfo"));
    municipio.add(new Option("Marcovia", "Marcovia"));
    municipio.add(new Option("Morolica", "Morolica"));
    municipio.add(new Option("Namasigüe", "Namasigüe"));
    municipio.add(new Option("Orocuina", "Orocuina"));
    municipio.add(new Option("Pespire", "Pespire"));
    municipio.add(new Option("San Antonio de Flores", "San Antonio de Flores"));
    municipio.add(new Option("San Isidro", "San Isidro"));
    municipio.add(new Option("San José", "San José"));
    municipio.add(new Option("San Marcos de Colón", "San Marcos de Colón"));
    municipio.add(new Option("Santa Ana de Yusguare", "Santa Ana de Yusguare"));
  }else if (departamento.value === "El Paraíso") {
    municipio.add(new Option("Yuscarán", "Yuscarán"));
    municipio.add(new Option("Alauca", "Alauca"));
    municipio.add(new Option("Danlí", "Danlí"));
    municipio.add(new Option("El Paraíso", "El Paraíso"));
    municipio.add(new Option("Güinope", "Güinope"));
    municipio.add(new Option("Jacaleapa", "Jacaleapa"));
    municipio.add(new Option("Liure", "Liure"));
    municipio.add(new Option("Morocelí", "Morocelí"));
    municipio.add(new Option("Oropolí", "Oropolí"));
    municipio.add(new Option("Potrerillos", "Potrerillos"));
    municipio.add(new Option("San Antonio de Flores", "San Antonio de Flores"));
    municipio.add(new Option("San Lucas", "San Lucas"));
    municipio.add(new Option("San Matías", "San Matías"));
    municipio.add(new Option("Soledad", "Soledad"));
    municipio.add(new Option("Teupasenti", "Teupasenti"));
    municipio.add(new Option("Texiguat", "Texiguat"));
    municipio.add(new Option("Vado Ancho", "Vado Ancho"));
    municipio.add(new Option("Yauyupe", "Yauyupe"));
    municipio.add(new Option("Trojes", "Trojes"));
  }else if (departamento.value === "Francisco Morazán") {
    municipio.add(new Option("Distrito Central", "Distrito Central"));
    municipio.add(new Option("Alubarén", "Alubarén"));
    municipio.add(new Option("Cedros", "Cedros"));
    municipio.add(new Option("Curarén", "Curarén"));
    municipio.add(new Option("El Porvenir", "El Porvenir"));
    municipio.add(new Option("Guaimaca", "Guaimaca"));
    municipio.add(new Option("La Libertad", "La Libertad"));
    municipio.add(new Option("La Venta", "La Venta"));
    municipio.add(new Option("Lepaterique", "Lepaterique"));
    municipio.add(new Option("Maraita", "Maraita"));
    municipio.add(new Option("Marale", "Marale"));
    municipio.add(new Option("Nueva Armenia", "Nueva Armenia"));
    municipio.add(new Option("Ojojona", "Ojojona"));
    municipio.add(new Option("Orica", "Orica"));
    municipio.add(new Option("Reitoca", "Reitoca"));
    municipio.add(new Option("Sabanagrande", "Sabanagrande"));
    municipio.add(new Option("San Antonio de Oriente", "San Antonio de Oriente"));
    municipio.add(new Option("San Buenaventura", "San Buenaventura"));
    municipio.add(new Option("San Ignacio", "San Ignacio"));
    municipio.add(new Option("San Juan de Flores", "San Juan de Flores"));
    municipio.add(new Option("San Miguelito", "San Miguelito"));
    municipio.add(new Option("Santa Ana", "Santa Ana"));
    municipio.add(new Option("Santa Lucía", "Santa Lucía"));
    municipio.add(new Option("Talanga", "Talanga"));
    municipio.add(new Option("Tatumbla", "Tatumbla"));
    municipio.add(new Option("Valle de Ángeles", "Valle de Ángeles"));
    municipio.add(new Option("Villa de San Francisco", "Villa de San Francisco"));
    municipio.add(new Option("Vallecillo", "Vallecillo"));
  }else if (departamento.value === "Gracias a Dios") {
    municipio.add(new Option("Puerto Lempira", "Puerto Lempira"));
    municipio.add(new Option("Brus Laguna", "Brus Laguna"));
    municipio.add(new Option("Ahuas", "Ahuas"));
    municipio.add(new Option("Juan Francisco Bulnes", "Juan Francisco Bulnes"));
    municipio.add(new Option("Villeda Morales", "Villeda Morales"));
    municipio.add(new Option("Wampusirpe", "Wampusirpe"));
  }else if (departamento.value === "Intibucá") {
    municipio.add(new Option("La Esperanza", "La Esperanza"));
    municipio.add(new Option("Camasca", "Camasca"));
    municipio.add(new Option("Colomoncagua", "Colomoncagua"));
    municipio.add(new Option("Concepción", "Concepción"));
    municipio.add(new Option("Dolores", "Dolores"));
    municipio.add(new Option("Intibucá", "Intibucá"));
    municipio.add(new Option("Jesús de Otoro", "Jesús de Otoro"));
    municipio.add(new Option("Magdalena", "Magdalena"));
    municipio.add(new Option("Masaguara", "Masaguara"));
    municipio.add(new Option("San Antonio", "San Antonio"));
    municipio.add(new Option("San Isidro", "San Isidro"));
    municipio.add(new Option("San Juan", "San Juan"));
    municipio.add(new Option("San Marcos de la Sierra", "San Marcos de la Sierra"));
    municipio.add(new Option("San Miguelito", "San Miguelito"));
    municipio.add(new Option("Santa Lucía", "Santa Lucía"));
    municipio.add(new Option("Yamaranguila", "Yamaranguila"));
    municipio.add(new Option("San Francisco de Opalaca", "San Francisco de Opalaca"));
  }else if (departamento.value === "Islas de la Bahía") {
    municipio.add(new Option("Roatán", "Roatán"));
    municipio.add(new Option("Guanaja", "Guanaja"));
    municipio.add(new Option("José Santos Guardiola", "José Santos Guardiola"));
    municipio.add(new Option("Utila", "Utila"));
  }else if (departamento.value === "La Paz") {
    municipio.add(new Option("La Paz", "La Paz"));
    municipio.add(new Option("Aguanqueterique", "Aguanqueterique"));
    municipio.add(new Option("Cabañas", "Cabañas"));
    municipio.add(new Option("Cane", "Cane"));
    municipio.add(new Option("Chinacla", "Chinacla"));
    municipio.add(new Option("Guajiquiro", "Guajiquiro"));
    municipio.add(new Option("Lauterique", "Lauterique"));
    municipio.add(new Option("Marcala", "Marcala"));
    municipio.add(new Option("Mercedes de Oriente", "Mercedes de Oriente"));
    municipio.add(new Option("Opatoro", "Opatoro"));
    municipio.add(new Option("San Antonio del Norte", "San Antonio del Norte"));
    municipio.add(new Option("San José", "San José"));
    municipio.add(new Option("San Juan", "San Juan"));
    municipio.add(new Option("San Pedro de Tutule", "San Pedro de Tutule"));
    municipio.add(new Option("Santa Ana", "Santa Ana"));
    municipio.add(new Option("Santa Elena", "Santa Elena"));
    municipio.add(new Option("Santa María", "Santa María"));
    municipio.add(new Option("Santiago de Puringla", "Santiago de Puringla"));
    municipio.add(new Option("Yarula", "Yarula"));
  }else if (departamento.value === "Lempira") {
    municipio.add(new Option("Gracias", "Gracias"));
    municipio.add(new Option("Belén", "Belén"));
    municipio.add(new Option("Candelaria", "Candelaria"));
    municipio.add(new Option("Cololaca", "Cololaca"));
    municipio.add(new Option("Erandique", "Erandique"));
    municipio.add(new Option("Gualcince", "Gualcince"));
    municipio.add(new Option("Guarita", "Guarita"));
    municipio.add(new Option("La Campa", "La Campa"));
    municipio.add(new Option("La Iguala", "La Iguala"));
    municipio.add(new Option("Las Flores", "Las Flores"));
    municipio.add(new Option("La Unión", "La Unión"));
    municipio.add(new Option("La Virtud", "La Virtud"));
    municipio.add(new Option("Lepaera", "Lepaera"));
    municipio.add(new Option("Mapulaca", "Mapulaca"));
    municipio.add(new Option("Piraera", "Piraera"));
    municipio.add(new Option("San Andrés", "San Andrés"));
    municipio.add(new Option("San Francisco", "San Francisco"));
    municipio.add(new Option("San Juan Guarita", "San Juan Guarita"));
    municipio.add(new Option("San Manuel Colohete", "San Manuel Colohete"));
    municipio.add(new Option("San Rafael", "San Rafael"));
    municipio.add(new Option("San Sebastián", "San Sebastián"));
    municipio.add(new Option("Santa Cruz", "Santa Cruz"));
    municipio.add(new Option("Talgua", "Talgua"));
    municipio.add(new Option("Tambla", "Tambla"));
    municipio.add(new Option("Tomalá", "Tomalá"));
    municipio.add(new Option("Valladolid", "Valladolid"));
    municipio.add(new Option("Virginia", "Virginia"));
    municipio.add(new Option("San Marcos de Caiquín", "San Marcos de Caiquín"));
  }else if (departamento.value === "Ocotepeque") {
    municipio.add(new Option("Ocotepeque", "Ocotepeque"));
    municipio.add(new Option("Belén Gualcho", "Belén Gualcho"));
    municipio.add(new Option("Concepción", "Concepción"));
    municipio.add(new Option("Dolores Merendón", "Dolores Merendón"));
    municipio.add(new Option("Fraternidad", "Fraternidad"));
    municipio.add(new Option("La Encarnación", "La Encarnación"));
    municipio.add(new Option("La Labor", "La Labor"));
    municipio.add(new Option("Lucerna", "Lucerna"));
    municipio.add(new Option("Mercedes", "Mercedes"));
    municipio.add(new Option("San Fernando", "San Fernando"));
    municipio.add(new Option("San Francisco del Valle", "San Francisco del Valle"));
    municipio.add(new Option("San Jorge", "San Jorge"));
    municipio.add(new Option("San Marcos", "San Marcos"));
    municipio.add(new Option("Santa Fe", "Santa Fe"));
    municipio.add(new Option("Sensenti", "Sensenti"));
    municipio.add(new Option("Sinuapa", "Sinuapa"));
  }else if (departamento.value === "Olancho") {
    municipio.add(new Option("Juticalpa", "Juticalpa"));
    municipio.add(new Option("Campamento", "Campamento"));
    municipio.add(new Option("Catacamas", "Catacamas"));
    municipio.add(new Option("Concordia", "Concordia"));
    municipio.add(new Option("Dulce Nombre de Culmí", "Dulce Nombre de Culmí"));
    municipio.add(new Option("El Rosario", "El Rosario"));
    municipio.add(new Option("Esquipulas del Norte", "Esquipulas del Norte"));
    municipio.add(new Option("Gualaco", "Gualaco"));
    municipio.add(new Option("Guarizama", "Guarizama"));
    municipio.add(new Option("Guata", "Guata"));
    municipio.add(new Option("Guayape", "Guayape"));
    municipio.add(new Option("Jano", "Jano"));
    municipio.add(new Option("La Unión", "La Unión"));
    municipio.add(new Option("Mangulile", "Mangulile"));
    municipio.add(new Option("Manto", "Manto"));
    municipio.add(new Option("Salamá", "Salamá"));
    municipio.add(new Option("San Esteban", "San Esteban"));
    municipio.add(new Option("San Francisco de Becerra", "San Francisco de Becerra"));
    municipio.add(new Option("San Francisco de la Paz", "San Francisco de la Paz"));
    municipio.add(new Option("Santa María del Real", "Santa María del Real"));
    municipio.add(new Option("Silca", "Silca"));
    municipio.add(new Option("Yocón", "Yocón"));
    municipio.add(new Option("Patuca", "Patuca"));
  }else if (departamento.value === "Santa Bárbara") {
    municipio.add(new Option("Santa Bárbara", "Santa Bárbara"));
    municipio.add(new Option("Arada", "Arada"));
    municipio.add(new Option("Atima", "Atima"));
    municipio.add(new Option("Azacualpa", "Azacualpa"));
    municipio.add(new Option("Ceguaca", "Ceguaca"));
    municipio.add(new Option("Concepción del Norte", "Concepción del Norte"));
    municipio.add(new Option("Concepción del Sur", "Concepción del Sur"));
    municipio.add(new Option("Chinda", "Chinda"));
    municipio.add(new Option("El Níspero", "El Níspero"));
    municipio.add(new Option("Gualala", "Gualala"));
    municipio.add(new Option("Ilama", "Ilama"));
    municipio.add(new Option("Las Vegas", "Las Vegas"));
    municipio.add(new Option("Macuelizo", "Macuelizo"));
    municipio.add(new Option("Naranjito", "Naranjito"));
    municipio.add(new Option("Nuevo Celilac", "Nuevo Celilac"));
    municipio.add(new Option("Nueva Frontera", "Nueva Frontera"));
    municipio.add(new Option("Petoa", "Petoa"));
    municipio.add(new Option("Protección", "Protección"));
    municipio.add(new Option("Quimistán", "Quimistán"));
    municipio.add(new Option("San Francisco de Ojuera", "San Francisco de Ojuera"));
    municipio.add(new Option("San José de las Colinas", "San José de las Colinas"));
    municipio.add(new Option("San Luis", "San Luis"));
    municipio.add(new Option("San Marcos", "San Marcos"));
    municipio.add(new Option("San Nicolás", "San Nicolás"));
    municipio.add(new Option("San Pedro Zacapa", "San Pedro Zacapa"));
    municipio.add(new Option("San Vicente Centenario", "San Vicente Centenario"));
    municipio.add(new Option("Santa Rita", "Santa Rita"));
    municipio.add(new Option("Trinidad", "Trinidad"));
  }else if (departamento.value === "Valle") {
    municipio.add(new Option("Nacaome", "Nacaome"));
    municipio.add(new Option("Alianza", "Alianza"));
    municipio.add(new Option("Amapala", "Amapala"));
    municipio.add(new Option("Aramecina", "Aramecina"));
    municipio.add(new Option("Caridad", "Caridad"));
    municipio.add(new Option("Goascorán", "Goascorán"));
    municipio.add(new Option("Langue", "Langue"));
    municipio.add(new Option("San Francisco de Coray", "San Francisco de Coray"));
    municipio.add(new Option("San Lorenzo", "San Lorenzo"));
  }else if (departamento.value === "Yoro") {
    municipio.add(new Option("Yoro", "Yoro"));
    municipio.add(new Option("Arenal", "Arenal"));
    municipio.add(new Option("El Negrito", "El Negrito"));
    municipio.add(new Option("El Progreso", "El Progreso"));
    municipio.add(new Option("Jocón", "Jocón"));
    municipio.add(new Option("Morazán", "Morazán"));
    municipio.add(new Option("Olanchito", "Olanchito"));
    municipio.add(new Option("Santa Rita", "Santa Rita"));
    municipio.add(new Option("Sulaco", "Sulaco"));
    municipio.add(new Option("Victoria", "Victoria"));
    municipio.add(new Option("Yorito", "Yorito"));
  }

} 
</script>