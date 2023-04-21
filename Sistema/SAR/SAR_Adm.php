<?php


require '../../conexion_BD.php';
/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */

require_once "../../EVENT_BITACORA.php";


session_start();     
$usuario=$_SESSION['user'];
$ID_Rol=$_SESSION['ID_Rol'];

//Parte 2
                
$R_Fecha_actual = date('Y-m-d');       /*obtiene la fecha actual*/


$sql1=$conexion->query("SELECT * FROM `tbl_ms_parametros` WHERE ID_Parametro=7");

    while($row=mysqli_fetch_array($sql1)){
    $diasV=$row['Valor'];
    }
$R_F_Vencida= date("Y-m-j",strtotime($R_Fecha_actual."+ ".$diasV." days")); /*le suma 1 mes a la fecha actual*/
//fin parte 2


?>


<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script type="text/javascript">
    function confirmar(){
      return confirm('¿Está Seguro?, se eliminará el registro');
    }
  </script>
</head>
<body>
	<!--Seccion donde va toda la barra lateral -->
	<?php include '../sidebar.php'; ?>

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
                          <h1 class="box-title">Mantenimiento SAR</h1>
                          <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Insercion=1 and ID_Rol=$ID_Rol and ID_Objeto=11 ");
if ($datos=$sql->fetch_object()) { ?>
                          <button class="btn btn-success" id="btnagregar" name="btnAgregar" onclick="mostrarform(true)"><i class="zmdi zmdi-file-text"></i> Agregar Datos</button>
                          <button class="btn btn-warning" id="generar-reporte" name="generar-reporte" onclick="window.open('../../fpdf/ReporteSAR.php?campo=' + encodeURIComponent(document.getElementById('campo').value), '_blank')" >
                         <i class="zmdi zmdi-collection-pdf"></i> Generar Reporte Proyectos
                          <div class="box-tools pull-right">
                            <?php } ?>
                        </div>
                        <br>
                    </div>
<!-- ================================================ -->
                    <!-- /.box-header -->
                    <!-- centro -->
                    <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_consultar=1 and ID_Rol=$ID_Rol and ID_Objeto=11");
if ($datos=$sql->fetch_object()) { ?>
<div class="panel-body" id="listadoregistros">
<main>
        <div class="container py-4 text-center">

            <div class="row g-4">

                <div class="col-auto">
                    <label for="num_registros" class="col-form-label">Mostrar: </label>
                </div>

                <div class="col-auto">
                    <select name="num_registros" id="num_registros" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="col-auto">
                    <label for="num_registros" class="col-form-label">registros </label>
                </div>

                <div class="col-5"></div>

                <div class="col-auto">
                    <label for="campo" class="col-form-label">Buscar: </label>
                </div>

                <div class="col-auto">
                    <input type="text" name="campo" id="campo" class="form-control">
                </div>
            </div>
  <script>
  document.getElementById("campo").addEventListener("keyup", function(event) {
    // Obtener el valor del input
    var campo = document.getElementById("campo").value;

    // Actualizar el valor del botón
    var btn = document.getElementById("generar-reporte");
    btn.onclick = function() {
      window.open('../../fpdf/ReporteSAR.php?campo=' + encodeURIComponent(campo), '_blank');
    };
  });
  </script>
            <div class="row py-4">
                <div class="col">
                <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <th class="sort asc">ID SAR</th>
                            <th class="sort asc">RTN</th>
                            <th class="sort asc">Numero de Declaracion</th>
                            <th class="sort asc">Nombre o Razon Social</th>
                            <th class="sort asc">Departamento</th>
                            <th class="sort asc">Municipio</th>
                            <th class="sort asc">Barrio o Colonia</th>
                            <th class="sort asc">Calle o avenida</th>
                            <th class="sort asc">Numero de Casa</th>
                            <th class="sort asc">Bloque</th>
                            <th class="sort asc">Tel. Fijo</th>
                            <th class="sort asc">Tel. Celular</th>
                            <th class="sort asc">Domicilio</th>
                            <th class="sort asc">Correo</th>
                            <th class="sort asc">Profesion u Oficio</th>
                            <th class="sort asc">CAI</th>
                            <th class="sort asc">Fecha Limite de Emision</th>
                            <th class="sort asc">Numero Inicial</th>
                            <th class="sort asc">Numero Final</th>
                            <th class="sort asc">Acciones</th>
                            <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Actualizacion=1 and ID_Rol=$ID_Rol and ID_Objeto=11");
if ($datos=$sql->fetch_object()) { ?>
                            <th></th>
                            <?php } ?>
                            <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Eliminacion=1 and ID_Rol=$ID_Rol and ID_Objeto=11");
if ($datos=$sql->fetch_object()) { ?>
                            <th></th>
                            <?php } ?>
                        </thead>
                        <!-- El id del cuerpo de la tabla. -->
                        <tbody id="content">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label id="lbl-total"></label>
                </div>

                <div class="col-6" id="nav-paginacion"></div>

                <input type="hidden" id="pagina" value="1">
                <input type="hidden" id="orderCol" value="0">
                <input type="hidden" id="orderType" value="asc">
            </div>
        </div>
    </main>
</div>
    <script>
        /* Llamando a la función getData() */
        getData()

        /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
        document.getElementById("campo").addEventListener("keyup", function() {
            getData()
        }, false)
        document.getElementById("num_registros").addEventListener("change", function() {
            getData()
        }, false)


        /* Peticion AJAX */
        function getData() {
            let input = document.getElementById("campo").value
            let num_registros = document.getElementById("num_registros").value
            let content = document.getElementById("content")
            let pagina = document.getElementById("pagina").value
            let orderCol = document.getElementById("orderCol").value
            let orderType = document.getElementById("orderType").value

            if (pagina == null) {
                pagina = 1
            }
            let url = "Gestion_tbl_SAR.php"
            let formaData = new FormData()
            formaData.append('campo', input)
            formaData.append('registros', num_registros)
            formaData.append('pagina', pagina)
            formaData.append('orderCol', orderCol)
            formaData.append('orderType', orderType)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data.data
                    document.getElementById("lbl-total").innerHTML = 'Mostrando ' + data.totalFiltro +
                        ' de ' + data.totalRegistros + ' registros'
                    document.getElementById("nav-paginacion").innerHTML = data.paginacion
                }).catch(err => console.log(err))
        }

        function nextPage(pagina){
            document.getElementById('pagina').value = pagina
            getData()
        }

        let columns = document.getElementsByClassName("sort")
        let tamanio = columns.length
        for(let i = 0; i < tamanio; i++){
            columns[i].addEventListener("click", ordenar)
        }

        function ordenar(e){
            let elemento = e.target

            document.getElementById('orderCol').value = elemento.cellIndex

            if(elemento.classList.contains("asc")){
                document.getElementById("orderType").value = "asc"
                elemento.classList.remove("asc")
                elemento.classList.add("desc")
            } else {
                document.getElementById("orderType").value = "desc"
                elemento.classList.remove("desc")
                elemento.classList.add("asc")
            }

            getData()
        }

    </script>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                    <?php } ?>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" action="Insert_SAR.php" method="POST">
                        <div class="container">
                          <div class="row">

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>RTN(*):</label>
                            <input type="hidden" name="rtn" id="rtn">
                            <input type="text" class="form-control" name="rtn" id="rtn" maxlength="100" placeholder="Ingrese el RTN" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Numero de declaracion(*):</label>
                            <input type="hidden" name="numDeclaracion" id="numDeclaracion">
                            <input type="text" class="form-control" name="numDeclaracion" id="numDeclaracion" maxlength="100" placeholder="Ingrese el Numero de declaracion" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre o Razon Social(*):</label>
                            <input type="hidden" name="razonSocial" id="razonSocial">
                            <input type="text" class="form-control" name="razonSocial" id="razonSocial" maxlength="100" placeholder="Ingrese el nombre o razon social" required>
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
                            <input type="text" class="form-control" name="barrioColonia" id="barrioColonia" maxlength="100" placeholder="Ingrese el Barrio o Colonia" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Calle o Avenida(*):</label>
                            <input type="hidden" name="calleAvenida" id="calleAvenida">
                            <input type="text" class="form-control" name="calleAvenida" id="calleAvenida" maxlength="100" placeholder="Ingrese la calle o avenida" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Numero de casa(*):</label>
                            <input type="hidden" name="numCasa" id="numCasa">
                            <input type="text" class="form-control" name="numCasa" id="numCasa" maxlength="100" placeholder="Ingrese el numero de casa" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Bloque(*):</label>
                            <input type="hidden" name="bloque" id="bloque">
                            <input type="text" class="form-control" name="bloque" id="bloque" maxlength="100" placeholder="Ingrese el bloque" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Telefono Fijo:</label>
                            <input type="hidden" name="telFijo" id="telFijo">
                            <input type="text" class="form-control" name="telFijo" id="telFijo" maxlength="8" placeholder="Ingrese el Telefono Fijo" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Celular(*):</label>
                            <input type="hidden" name="telCelular" id="telCelular">
                            <input type="text" class="form-control" name="telCelular" id="telCelular" maxlength="8" placeholder="Ingrese el Telefono Celular" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Domicilio(*):</label>
                            <input type="hidden" name="domicilio" id="domicilio">
                            <input type="text" class="form-control" name="domicilio" id="domicilio" maxlength="100" placeholder="Ingrese el Domicilio" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Correo electronico(*):</label>
                            <input type="hidden" name="Correo_electronico" id="Correo_electronico">
                            <input type="text" class="form-control" name="Correo_electronico" id="Correo_electronico" maxlength="100" placeholder="Ingrese el correo electronico" onkeypress="validarCorreo(event)" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Profesion u Oficio(*):</label>
                            <input type="hidden" name="profesionOficio" id="profesionOficio">
                            <input type="text" class="form-control" name="profesionOficio" id="profesionOficio" maxlength="100" placeholder="Ingrese la profesion u Oficio" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>CAI(*):</label>
                            <input type="hidden" name="cai" id="cai">
                            <input type="text" class="form-control" name="cai" id="cai" maxlength="100" placeholder="Ingrese el codigo CAI" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Fecha Limite de Emision(*):</label>
                            <input type="hidden" name="fechaEmision" id="fechaEmision">
                            <input type="date" class="form-control" name="fechaEmision" id="fechaEmision" maxlength="100" placeholder="Ingrese la fecha de emision" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Numero Inicial(*):</label>
                            <input type="hidden" name="numeroInicial" id="numeroInicial">
                            <input type="text" class="form-control" name="numeroInicial" id="numeroInicial" maxlength="100" placeholder="Ingrese el Numero Inicial" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Numero Final(*):</label>
                            <input type="hidden" name="numeroFinal" id="numeroFinal">
                            <input type="text" class="form-control" name="numeroFinal" id="numeroFinal" maxlength="100" placeholder="Ingrese el Numero Final" required>
                          </div>


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="zmdi zmdi-close-circle"></i> Cancelar</button>
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


	
	<!--script en java para los efectos-->
  
 	<script src="../../js/jquery-3.1.1.min.js"></script>
  <script src="../../js/events.js"></script>
	<script src="../../js/main.js"></script>
  <script src="../../js/usuario.js"></script>
  <script src="../../js/Buscador.js"></script>


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
