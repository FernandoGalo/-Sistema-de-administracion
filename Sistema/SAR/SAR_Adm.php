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
    <script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    // Nombre del archivo
    filename = filename?filename+'.xls':'Reporte de tabla.xls';

    // Crear descarga
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Crear enlace para descargar
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Establecer nombre de archivo
        downloadLink.download = filename;

        // Descargar archivo
        downloadLink.click();
    }
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
                          <button class="btn btn-success" id="Excel_Btn" onclick="exportTableToExcel('tbllistado')"><i class="zmdi zmdi-archive"></i> Exportar a Excel</button>
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
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-hover">
                        
                        <!-- Buscar -->
                        <form action="" method="post">
                            <label for="campo">Buscar:</label>
                            <input type="text" id="buscador" onkeyup="buscarTabla()" placeholder="Buscar...">
                        </form>
                        <!-- PARA GENERAR LOS REPORTES ====================== -->
                        <div class="text-right mb-2">
                          <a href="../../fpdf/ReporteSAR.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf">Generar Reporte SAR</i></a>
                        </div>
                        <!-- Fin Generar Reporte -->
                        <thead>
                            <th>ID SAR</th>
                            <th>RTN</th>
                            <th>Numero de Declaracion</th>
                            <th>Nombre o Razon Social</th>
                            <th>Departamento</th>
                            <th>Municipio</th>
                            <th>Barrio o Colonia</th>
                            <th>Calle o Avenida</th>
                            <th>Numero de Casa</th>
                            <th>Bloque</th>
                            <th>Tel. Fijo</th>
                            <th>Tel. Celular</th>
                            <th>Domicilio</th>
                            <th>Correo</th>
                            <th>Profesion u oficio</th>
                            <th>CAI</th>
                            <th>Fecha Limite de Emision</th>
                            <th>Numero Inicial</th>
                            <th> Numero final</th>
                            <th>Acciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
                          $sql="SELECT ID_SAR, RTN, num_declaracion, nombre_razonSocial, departamento, municipio, barrio_colonia, calle_avenida, num_casa, bloque, telefono, celular, domicilio, correo, profesion_oficio, cai, fecha_limite_emision, num_inicial, num_final
                          FROM tbl_r_sar";
                          $result=mysqli_query($conexion,$sql);

                           while($mostrar=mysqli_fetch_array($result)){
                           ?>

                            <tr>
                              <td><?php echo $mostrar['ID_SAR']?></td> 
                              <td><?php echo $mostrar['RTN']?></td> 
                              <td><?php echo $mostrar['num_declaracion']?></td>
                              <td><?php echo $mostrar['nombre_razonSocial']?></td>
                              <td><?php echo $mostrar['departamento']?></td>
                              <td><?php echo $mostrar['municipio']?></td>
                              <td><?php echo $mostrar['barrio_colonia']?></td>
                              <td><?php echo $mostrar['calle_avenida']?></td>
                              <td><?php echo $mostrar['num_casa']?></td>
                              <td><?php echo $mostrar['bloque']?></td>
                              <td><?php echo $mostrar['telefono']?></td>
                              <td><?php echo $mostrar['celular']?></td>
                              <td><?php echo $mostrar['domicilio']?></td>
                              <td><?php echo $mostrar['correo']?></td>
                              <td><?php echo $mostrar['profesion_oficio']?></td>
                              <td><?php echo $mostrar['cai']?></td>
                              <td><?php echo $mostrar['fecha_limite_emision']?></td>
                              <td><?php echo $mostrar['num_inicial']?></td>
                              <td><?php echo $mostrar['num_final']?></td>
                              <td>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Actualizacion=1 and ID_Rol=$ID_Rol and ID_Objeto=11");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Update_SAR.php?id_sar=<?php echo $mostrar['ID_SAR']; ?>' class='boton-editar'>
                              <i class='zmdi zmdi-edit'></i>
                               <?php } ?>
                              </a>
                              <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Eliminacion=1 and ID_Rol=$ID_Rol and ID_Objeto=11");
if ($datos=$sql->fetch_object()) { ?>
                              <a href='Delete_SAR.php?ID_SAR=<?php echo $mostrar['ID_SAR']; ?>' onclick='return confirmar()' class='boton-eliminar'>
                              <i class='zmdi zmdi-delete'></i>
                              <?php } ?>
                              </a>
                            </td>
                             </tr>
                            <?php
                             }
                             ?>     
                          </tfoot>
                        </table>
                    </div>


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

  // Actualizar el valor del enlace
  var link = document.getElementById("generar-reporte");
  link.setAttribute("href", "../../fpdf/ReporteSAR.php?campo=" + encodeURIComponent(campo));
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
                            <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Actualizacion=1 and ID_Rol=$ID_Rol and ID_Objeto=9");
if ($datos=$sql->fetch_object()) { ?>
                            <th></th>
                            <?php } ?>
                            <?php $sql=$conexion->query("SELECT * FROM tbl_permisos where Permiso_Eliminacion=1 and ID_Rol=$ID_Rol and ID_Objeto=9");
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
                                <option value="ATLÁNTIDA">ATLÁNTIDA</option>
                                <option value="COLÓN">COLÓN</option>
                                <option value="COMAYAGUA">COMAYAGUA</option>
                                <option value="COPÁN">COPÁN</option>
                                <option value="CORTÉS">CORTÉS</option>
                                <option value="CHOLUTECA">CHOLUTECA</option>
                                <option value="EL PARAÍSO">EL PARAÍSO</option>
                                <option value="FRANCISCO MORAZÁN">FRANCISCO MORAZÁN</option>
                                <option value="GRACIAS A DIOS">GRACIAS A DIOS</option>
                                <option value="INTIBUCÁ">INTIBUCÁ</option>
                                <option value="ISLAS DE LA BAHÍA">ISLAS DE LA BAHÍA</option>
                                <option value="LA PAZ">LA PAZ</option>
                                <option value="LEMPIRA">LEMPIRA</option>
                                <option value="OCOTEPEQUE">OCOTEPEQUE</option>
                                <option value="OLANCHO">OLANCHO</option>
                                <option value="SANTA BÁRBARA">SANTA BÁRBARA</option>
                                <option value="VALLE">VALLE</option>
                                <option value="YORO">YORO</option>
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
  if (departamento.value === "ATLÁNTIDA") {
    municipio.add(new option("LA CEIBA", "LA CEIBA"));
    municipio.add(new option("EL PORVENIR", "EL PORVENIR"));
    municipio.add(new option("TELA", "TELA"));
    municipio.add(new option("JUTIAPA", "JUTIAPA"));
    municipio.add(new option("LA MASICA", "LA MASICA"));
    municipio.add(new option("SAN FRANCISCO", "SAN FRANCISCO"));
    municipio.add(new option("ARIZONA", "ARIZONA"));
    municipio.add(new option("ESPARTA", "ESPARTA"));
  } else if (departamento.value === "COLÓN") {
    municipio.add(new option("TRUJILLO", "Trujillo"));
    municipio.add(new option("BALFATE", "Balfate"));
    municipio.add(new option("IRIONA", "Iriona"));
    municipio.add(new option("LIMÓN", "Limón"));
    municipio.add(new option("SABÁ", "Sabá"));
    municipio.add(new option("SANTA FE", "Santa Fe"));
    municipio.add(new option("SANTA ROSA DE AGUÁN", "Santa Rosa de Aguán"));
    municipio.add(new option("SONAGUERA", "Sonaguera"));
    municipio.add(new option("TOCOA", "Tocoa"));
    municipio.add(new option("BONITO ORIENTAL", "Bonito Oriental"));
  } else if (departamento.value === "COMAYAGUA") {
    municipio.add(new option("COMAYAGUA", "COMAYAGUA"));
    municipio.add(new option("AJUTERIQUE", "AJUTERIQUE"));
    municipio.add(new option("EL ROSARIO", "EL ROSARIO"));
    municipio.add(new option("ESQUÍAS", "ESQUÍAS"));
    municipio.add(new option("HUMUYA", "HUMUYA"));
    municipio.add(new option("LA LIBERTAD", "LA LIBERTAD"));
    municipio.add(new option("LAMANÍ", "LAMANÍ"));
    municipio.add(new option("LA TRINIDAD", "LA TRINIDAD"));
    municipio.add(new option("LEJAMANÍ", "LEJAMANÍ"));
    municipio.add(new option("MEÁMBAR", "MEÁMBAR"));
    municipio.add(new option("MINAS DE ORO", "MINAS DE ORO"));
    municipio.add(new option("OJOS DE AGUA", "OJOS DE AGUA"));
    municipio.add(new option("SAN JERÓNIMO", "SAN JERÓNIMO"));
    municipio.add(new option("SAN JOSÉ DE COMAYAGUA", "SAN JOSÉ DE COMAYAGUA"));
    municipio.add(new option("SAN JOSÉ DEL POTRERO", "SAN JOSÉ DEL POTRERO"));
    municipio.add(new option("SAN LUIS", "SAN LUIS"));
    municipio.add(new option("SAN SEBASTIÁN", "SAN SEBASTIÁN"));
    municipio.add(new option("SIGUATEPEQUE", "SIGUATEPEQUE"));
    municipio.add(new option("VILLA DE SAN ANTONIO", "VILLA DE SAN ANTONIO"));
    municipio.add(new option("LAS LAJAS", "LAS LAJAS"));
    municipio.add(new option("TAULABÉ", "TAULABÉ"));
  } else if (departamento.value === "COPÁN") {
    municipio.add(new option("SANTA ROSA DE COPÁN", "SANTA ROSA DE COPÁN"));
    municipio.add(new option("CABAÑAS", "CABAÑAS"));
    municipio.add(new option("CONCEPCIÓN", "CONCEPCIÓN"));
    municipio.add(new option("COPÁN RUINAS", "COPÁN RUINAS"));
    municipio.add(new option("CORQUÍN", "CORQUÍN"));
    municipio.add(new option("CUCUYAGUA", "CUCUYAGUA"));
    municipio.add(new option("DOLORES", "DOLORES"));
    municipio.add(new option("DULCE NOMBRE", "DULCE NOMBRE"));
    municipio.add(new option("EL PARAÍSO", "EL PARAÍSO"));
    municipio.add(new option("FLORIDA", "FLORIDA"));
    municipio.add(new option("LA JIGUA", "LA JIGUA"));
    municipio.add(new option("LA UNIÓN", "LA UNIÓN"));
    municipio.add(new option("NUEVA ARCADIA", "NUEVA ARCADIA"));
    municipio.add(new option("SAN AGUSTÍN", "SAN AGUSTÍN"));
    municipio.add(new option("SAN ANTONIO", "SAN ANTONIO"));
    municipio.add(new option("SAN JERÓNIMO", "SAN JERÓNIMO"));
    municipio.add(new option("SAN JOSÉ", "SAN JOSÉ"));
    municipio.add(new option("SAN JUAN DE OPOA", "SAN JUAN DE OPOA"));
    municipio.add(new option("SAN NICOLÁS", "SAN NICOLÁS"));
    municipio.add(new option("SAN PEDRO", "SAN PEDRO"));
    municipio.add(new option("SANTA RITA", "SANTA RITA"));
    municipio.add(new option("TRINIDAD DE COPÁN", "TRINIDAD DE COPÁN"));
    municipio.add(new option("VERACRUZ", "VERACRUZ"));
  }else if (departamento.value === "CORTÉS") {
    municipio.add(new option("SAN PEDRO SULA", "SAN PEDRO SULA"));
    municipio.add(new option("CHOLOMA", "CHOLOMA"));
    municipio.add(new option("OMOA", "OMOA"));
    municipio.add(new option("PIMIENTA", "PIMIENTA"));
    municipio.add(new option("POTRERILLOS", "POTRERILLOS"));
    municipio.add(new option("PUERTO CORTÉS", "PUERTO CORTÉS"));
    municipio.add(new option("SAN ANTONIO DE CORTÉS", "SAN ANTONIO DE CORTÉS"));
    municipio.add(new option("SAN FRANCISCO DE YOJOA", "SAN FRANCISCO DE YOJOA"));
    municipio.add(new option("SAN MANUEL", "SAN MANUEL"));
    municipio.add(new option("SANTA CRUZ DE YOJOA", "SANTA CRUZ DE YOJOA"));
    municipio.add(new option("VILLANUEVA", "VILLANUEVA"));
    municipio.add(new option("LA LIMA", "LA LIMA"));
  }else if (departamento.value === "CHOLUTECA") {
    municipio.add(new option("CHOLUTECA", "CHOLUTECA"));
    municipio.add(new option("APACILAGUA", "APACILAGUA"));
    municipio.add(new option("CONCEPCIÓN DE MARÍA", "CONCEPCIÓN DE MARÍA"));
    municipio.add(new option("DUYURE", "DUYURE"));
    municipio.add(new option("EL CORPUS", "EL CORPUS"));
    municipio.add(new option("EL TRIUNFO", "EL TRIUNFO"));
    municipio.add(new option("MARCOVIA", "MARCOVIA"));
    municipio.add(new option("MOROLICA", "MOROLICA"));
    municipio.add(new option("NAMASIGÜE", "NAMASIGÜE"));
    municipio.add(new option("OROCUINA", "OROCUINA"));
    municipio.add(new option("PESPIRE", "PESPIRE"));
    municipio.add(new option("SAN ANTONIO DE FLORES", "SAN ANTONIO DE FLORES"));
    municipio.add(new option("SAN ISIDRO", "SAN ISIDRO"));
    municipio.add(new option("SAN JOSÉ", "SAN JOSÉ"));
    municipio.add(new option("SAN MARCOS DE COLÓN", "SAN MARCOS DE COLÓN"));
    municipio.add(new option("SANTA ANA DE YUSGUARE", "SANTA ANA DE YUSGUARE"));
  }else if (departamento.value === "EL PARAÍSO") {
    municipio.add(new option("YUSCARÁN", "YUSCARÁN"));
    municipio.add(new option("ALAUCA", "ALAUCA"));
    municipio.add(new option("DANLÍ", "DANLÍ"));
    municipio.add(new option("EL PARAÍSO", "EL PARAÍSO"));
    municipio.add(new option("GÜINOPE", "GÜINOPE"));
    municipio.add(new option("JACALEAPA", "JACALEAPA"));
    municipio.add(new option("LIURE", "LIURE"));
    municipio.add(new option("MOROCELÍ", "MOROCELÍ"));
    municipio.add(new option("OROPOLÍ", "OROPOLÍ"));
    municipio.add(new option("POTRERILLOS", "POTRERILLOS"));
    municipio.add(new option("SAN ANTONIO DE FLORES", "SAN ANTONIO DE FLORES"));
    municipio.add(new option("SAN LUCAS", "SAN LUCAS"));
    municipio.add(new option("SAN MATÍAS", "SAN MATÍAS"));
    municipio.add(new option("SOLEDAD", "SOLEDAD"));
    municipio.add(new option("TEUPASENTI", "TEUPASENTI"));
    municipio.add(new option("TEXIGUAT", "TEXIGUAT"));
    municipio.add(new option("VADO ANCHO", "VADO ANCHO"));
    municipio.add(new option("YAUYUPE", "YAUYUPE"));
    municipio.add(new option("TROJES", "TROJES"));
  }else if (departamento.value === "FRANCISCO MORAZÁN") {
    municipio.add(new option("DISTRITO CENTRAL", "DISTRITO CENTRAL"));
    municipio.add(new option("ALUBARÉN", "ALUBARÉN"));
    municipio.add(new option("CEDROS", "CEDROS"));
    municipio.add(new option("CURARÉN", "CURARÉN"));
    municipio.add(new option("EL PORVENIR", "EL PORVENIR"));
    municipio.add(new option("GUAIMACA", "GUAIMACA"));
    municipio.add(new option("LA LIBERTAD", "LA LIBERTAD"));
    municipio.add(new option("LA VENTA", "LA VENTA"));
    municipio.add(new option("LEPATERIQUE", "LEPATERIQUE"));
    municipio.add(new option("MARAITA", "MARAITA"));
    municipio.add(new option("MARALE", "MARALE"));
    municipio.add(new option("NUEVA ARMENIA", "NUEVA ARMENIA"));
    municipio.add(new option("OJOJONA", "OJOJONA"));
    municipio.add(new option("ORICA", "ORICA"));
    municipio.add(new option("REITOCA", "REITOCA"));
    municipio.add(new option("SABANAGRANDE", "SABANAGRANDE"));
    municipio.add(new option("SAN ANTONIO DE ORIENTE", "SAN ANTONIO DE ORIENTE"));
    municipio.add(new option("SAN BUENAVENTURA", "SAN BUENAVENTURA"));
    municipio.add(new option("SAN IGNACIO", "SAN IGNACIO"));
    municipio.add(new option("SAN JUAN DE FLORES", "SAN JUAN DE FLORES"));
    municipio.add(new option("SAN MIGUELITO", "SAN MIGUELITO"));
    municipio.add(new option("SANTA ANA", "SANTA ANA"));
    municipio.add(new option("SANTA LUCÍA", "SANTA LUCÍA"));
    municipio.add(new option("TALANGA", "TALANGA"));
    municipio.add(new option("TATUMBLA", "TATUMBLA"));
    municipio.add(new option("VALLE DE ÁNGELES", "VALLE DE ÁNGELES"));
    municipio.add(new option("VILLA DE SAN FRANCISCO", "VILLA DE SAN FRANCISCO"));
    municipio.add(new option("VALLECILLO", "VALLECILLO"));
  }else if (departamento.value === "GRACIAS A DIOS") {
    municipio.add(new option("PUERTO LEMPIRA", "PUERTO LEMPIRA"));
    municipio.add(new option("BRUS LAGUNA", "BRUS LAGUNA"));
    municipio.add(new option("AHUAS", "AHUAS"));
    municipio.add(new option("JUAN FRANCISCO BULNES", "JUAN FRANCISCO BULNES"));
    municipio.add(new option("VILLEDA MORALES", "VILLEDA MORALES"));
    municipio.add(new option("Wampusirpe", "Wampusirpe"));
  }else if (departamento.value === "INTIBUCÁ") {
    municipio.add(new option("LA ESPERANZA", "LA ESPERANZA"));
    municipio.add(new option("CAMASCA", "CAMASCA"));
    municipio.add(new option("COLOMONCAGUA", "COLOMONCAGUA"));
    municipio.add(new option("CONCEPCIÓN", "CONCEPCIÓN"));
    municipio.add(new option("DOLORES", "DOLORES"));
    municipio.add(new option("INTIBUCÁ", "INTIBUCÁ"));
    municipio.add(new option("JESÚS DE OTORO", "JESÚS DE OTORO"));
    municipio.add(new option("MAGDALENA", "MAGDALENA"));
    municipio.add(new option("MASAGUARA", "MASAGUARA"));
    municipio.add(new option("SAN ANTONIO", "SAN ANTONIO"));
    municipio.add(new option("SAN ISIDRO", "SAN ISIDRO"));
    municipio.add(new option("SAN JUAN", "SAN JUAN"));
    municipio.add(new option("SAN MARCOS DE LA SIERRA", "SAN MARCOS DE LA SIERRA"));
    municipio.add(new option("SAN MIGUELITO", "SAN MIGUELITO"));
    municipio.add(new option("SANTA LUCÍA", "SANTA LUCÍA"));
    municipio.add(new option("YAMARANGUILA", "YAMARANGUILA"));
    municipio.add(new option("SAN FRANCISCO DE OPALACA", "SAN FRANCISCO DE OPALACA"));;
  }else if (departamento.value === "ISLAS DE LA BAHÍA") {
    municipio.add(new option("ROATÁN", "ROATÁN"));
    municipio.add(new option("GUANAJA", "GUANAJA"));
    municipio.add(new option("JOSÉ SANTOS GUARDIOLA", "JOSÉ SANTOS GUARDIOLA"));
    municipio.add(new option("UTILA", "UTILA"));
  }else if (departamento.value === "LA PAZ") {
    municipio.add(new option("LA PAZ", "LA PAZ"));
    municipio.add(new option("AGUANQUETERIQUE", "AGUANQUETERIQUE"));
    municipio.add(new option("CABAÑAS", "CABAÑAS"));
    municipio.add(new option("CANE", "CANE"));
    municipio.add(new option("CHINACLA", "CHINACLA"));
    municipio.add(new option("GUAJIQUIRO", "GUAJIQUIRO"));
    municipio.add(new option("LAUTERIQUE", "LAUTERIQUE"));
    municipio.add(new option("MARCALA", "MARCALA"));
    municipio.add(new option("MERCEDES DE ORIENTE", "MERCEDES DE ORIENTE"));
    municipio.add(new option("OPATORO", "OPATORO"));
    municipio.add(new option("SAN ANTONIO DEL NORTE", "SAN ANTONIO DEL NORTE"));
    municipio.add(new option("SAN JOSÉ", "SAN JOSÉ"));
    municipio.add(new option("SAN JUAN", "SAN JUAN"));
    municipio.add(new option("SAN PEDRO DE TUTULE", "SAN PEDRO DE TUTULE"));
    municipio.add(new option("SANTA ANA", "SANTA ANA"));
    municipio.add(new option("SANTA ELENA", "SANTA ELENA"));
    municipio.add(new option("SANTA MARÍA", "SANTA MARÍA"));
    municipio.add(new option("SANTIAGO DE PURINGLA", "SANTIAGO DE PURINGLA"));
    municipio.add(new option("YARULA", "YARULA"));
  }else if (departamento.value === "LEMPIRA") {
    municipio.add(new option("GRACIAS", "GRACIAS"));
    municipio.add(new option("BELÉN", "BELÉN"));
    municipio.add(new option("CANDELARIA", "CANDELARIA"));
    municipio.add(new option("COLOLACA", "COLOLACA"));
    municipio.add(new option("ERANDIQUE", "ERANDIQUE"));
    municipio.add(new option("GUALCINCE", "GUALCINCE"));
    municipio.add(new option("GUARITA", "GUARITA"));
    municipio.add(new option("LA CAMPA", "LA CAMPA"));
    municipio.add(new option("LA IGUALA", "LA IGUALA"));
    municipio.add(new option("LAS FLORES", "LAS FLORES"));
    municipio.add(new option("LA UNIÓN", "LA UNIÓN"));
    municipio.add(new option("LA VIRTUD", "LA VIRTUD"));
    municipio.add(new option("LEPAERA", "LEPAERA"));
    municipio.add(new option("MAPULACA", "MAPULACA"));
    municipio.add(new option("PIRAERA", "PIRAERA"));
    municipio.add(new option("SAN ANDRÉS", "SAN ANDRÉS"));
    municipio.add(new option("SAN FRANCISCO", "SAN FRANCISCO"));
    municipio.add(new option("SAN JUAN GUARITA", "SAN JUAN GUARITA"));
    municipio.add(new option("SAN MANUEL COLOHETE", "SAN MANUEL COLOHETE"));
    municipio.add(new option("SAN RAFAEL", "SAN RAFAEL"));
    municipio.add(new option("SAN SEBASTIÁN", "SAN SEBASTIÁN"));
    municipio.add(new option("SANTA CRUZ", "SANTA CRUZ"));
    municipio.add(new option("TALGUA", "TALGUA"));
    municipio.add(new option("TAMBLA", "TAMBLA"));
    municipio.add(new option("TOMALÁ", "TOMALÁ"));
    municipio.add(new option("VALLADOLID", "VALLADOLID"));
    municipio.add(new option("VIRGINIA", "VIRGINIA"));
    municipio.add(new option("SAN MARCOS DE CAIQUÍN", "SAN MARCOS DE CAIQUÍN"));
  }else if (departamento.value === "OCOTEPEQUE") {
    municipio.add(new option("OCOTEPEQUE", "OCOTEPEQUE"));
    municipio.add(new option("BELÉN GUALCHO", "BELÉN GUALCHO"));
    municipio.add(new option("CONCEPCIÓN", "CONCEPCIÓN"));
    municipio.add(new option("DOLORES MERENDÓN", "DOLORES MERENDÓN"));
    municipio.add(new option("FRATERNIDAD", "FRATERNIDAD"));
    municipio.add(new option("LA ENCARNACIÓN", "LA ENCARNACIÓN"));
    municipio.add(new option("LA LABOR", "LA LABOR"));
    municipio.add(new option("LUCERNA", "LUCERNA"));
    municipio.add(new option("MERCEDES", "MERCEDES"));
    municipio.add(new option("SAN FERNANDO", "SAN FERNANDO"));
    municipio.add(new option("SAN FRANCISCO DEL VALLE", "SAN FRANCISCO DEL VALLE"));
    municipio.add(new option("SAN JORGE", "SAN JORGE"));
    municipio.add(new option("SAN MARCOS", "SAN MARCOS"));
    municipio.add(new option("SANTA FE", "SANTA FE"));
    municipio.add(new option("SENSENTI", "SENSENTI"));
    municipio.add(new option("SINUAPA", "SINUAPA"));
  }else if (departamento.value === "OLANCHO") {
    municipio.add(new option("JUTICALPA", "JUTICALPA"));
    municipio.add(new option("CAMPAMENTO", "CAMPAMENTO"));
    municipio.add(new option("CATACAMAS", "CATACAMAS"));
    municipio.add(new option("CONCORDIA", "CONCORDIA"));
    municipio.add(new option("DULCE NOMBRE DE CULMÍ", "DULCE NOMBRE DE CULMÍ"));
    municipio.add(new option("EL ROSARIO", "EL ROSARIO"));
    municipio.add(new option("ESQUIPULAS DEL NORTE", "ESQUIPULAS DEL NORTE"));
    municipio.add(new option("GUALACO", "GUALACO"));
    municipio.add(new option("GUARIZAMA", "GUARIZAMA"));
    municipio.add(new option("GUATA", "GUATA"));
    municipio.add(new option("GUAYAPE", "GUAYAPE"));
    municipio.add(new option("JANO", "JANO"));
    municipio.add(new option("LA UNIÓN", "LA UNIÓN"));
    municipio.add(new option("MANGULILE", "MANGULILE"));
    municipio.add(new option("MANTO", "MANTO"));
    municipio.add(new option("SALAMÁ", "SALAMÁ"));
    municipio.add(new option("SAN ESTEBAN", "SAN ESTEBAN"));
    municipio.add(new option("SAN FRANCISCO DE BECERRA", "SAN FRANCISCO DE BECERRA"));
    municipio.add(new option("SAN FRANCISCO DE LA PAZ", "SAN FRANCISCO DE LA PAZ"));
    municipio.add(new option("SANTA MARÍA DEL REAL", "SANTA MARÍA DEL REAL"));
    municipio.add(new option("SILCA", "SILCA"));
    municipio.add(new option("YOCÓN", "YOCÓN"));
    municipio.add(new option("PATUCA", "PATUCA"));
  }else if (departamento.value === "SANTA BÁRBARA") {
    municipio.add(new option("SANTA BÁRBARA", "SANTA BÁRBARA"));
    municipio.add(new option("ARADA", "ARADA"));
    municipio.add(new option("ATIMA", "ATIMA"));
    municipio.add(new option("AZACUALPA", "AZACUALPA"));
    municipio.add(new option("CEGUACA", "CEGUACA"));
    municipio.add(new option("CONCEPCIÓN DEL NORTE", "CONCEPCIÓN DEL NORTE"));
    municipio.add(new option("CONCEPCIÓN DEL SUR", "CONCEPCIÓN DEL SUR"));
    municipio.add(new option("CHINDA", "CHINDA"));
    municipio.add(new option("EL NÍSPERO", "EL NÍSPERO"));
    municipio.add(new option("GUALALA", "GUALALA"));
    municipio.add(new option("ILAMA", "ILAMA"));
    municipio.add(new option("LAS VEGAS", "LAS VEGAS"));
    municipio.add(new option("MACUELIZO", "MACUELIZO"));
    municipio.add(new option("NARANJITO", "NARANJITO"));
    municipio.add(new option("NUEVO CELILAC", "NUEVO CELILAC"));
    municipio.add(new option("NUEVA FRONTERA", "NUEVA FRONTERA"));
    municipio.add(new option("PETOA", "PETOA"));
    municipio.add(new option("PROTECCIÓN", "PROTECCIÓN"));
    municipio.add(new option("QUIMISTÁN", "QUIMISTÁN"));
    municipio.add(new option("SAN FRANCISCO DE OJUERA", "SAN FRANCISCO DE OJUERA"));
    municipio.add(new option("SAN JOSÉ DE LAS COLINAS", "SAN JOSÉ DE LAS COLINAS"));
    municipio.add(new option("SAN LUIS", "SAN LUIS"));
    municipio.add(new option("SAN MARCOS", "SAN MARCOS"));
    municipio.add(new option("SAN NICOLÁS", "SAN NICOLÁS"));
    municipio.add(new option("SAN PEDRO ZACAPA", "SAN PEDRO ZACAPA"));
    municipio.add(new option("SAN VICENTE CENTENARIO", "SAN VICENTE CENTENARIO"));
    municipio.add(new option("SANTA RITA", "SANTA RITA"));
    municipio.add(new option("TRINIDAD", "TRINIDAD"));
  }else if (departamento.value === "VALLE") {
    municipio.add(new option("NACAOME", "NACAOME"));
    municipio.add(new option("ALIANZA", "ALIANZA"));
    municipio.add(new option("AMAPALA", "AMAPALA"));
    municipio.add(new option("ARAMECINA", "ARAMECINA"));
    municipio.add(new option("CARIDAD", "CARIDAD"));
    municipio.add(new option("GOASCORÁN", "GOASCORÁN"));
    municipio.add(new option("LANGUE", "LANGUE"));
    municipio.add(new option("SAN FRANCISCO DE CORAY", "SAN FRANCISCO DE CORAY"));
    municipio.add(new option("SAN LORENZO", "SAN LORENZO"));
  }else if (departamento.value === "YORO") {
    municipio.add(new option("YORO", "YORO"));
    municipio.add(new option("ARENAL", "ARENAL"));
    municipio.add(new option("EL NEGRITO", "EL NEGRITO"));
    municipio.add(new option("EL PROGRESO", "EL PROGRESO"));
    municipio.add(new option("JOCÓN", "JOCÓN"));
    municipio.add(new option("MORAZÁN", "MORAZÁN"));
    municipio.add(new option("OLANCHITO", "OLANCHITO"));
    municipio.add(new option("SANTA RITA", "SANTA RITA"));
    municipio.add(new option("SULACO", "SULACO"));
    municipio.add(new option("VICTORIA", "VICTORIA"));
    municipio.add(new option("YORITO", "YORITO"));
  }

} 
</script>
