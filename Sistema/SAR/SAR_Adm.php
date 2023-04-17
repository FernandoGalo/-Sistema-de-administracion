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
  <script type="text/javascript">
    function confirmar(){
      return confirm('¿Está Seguro?, se eliminará el usuario');
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
                    <?php } ?>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" action="Insert_SAR.php" method="POST">
                        <div class="container">
                          <div class="row">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>ID SAR:</label>
                            <input type="hidden" name="id_sar" id="id_sar">
                            <input type="number" class="form-control" name="id_sar" id="id_sar" maxlength="100" placeholder="Ingrese el ID SAR"  required>
                          </div>
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
                                <option value="atlantida">Atlántida</option>
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
                          


                          <!-- <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Municipio(*):</label>
                            <input type="hidden" name="municipio" id="municipio">
                            <input type="text" class="form-control" name="municipio" id="municipio" maxlength="100" placeholder="Ingrese el Municipio" required> 
                          </div> -->

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
                            <input type="text" class="form-control" name="telFijo" id="telFijo" maxlength="100" placeholder="Ingrese el Telefono Fijo" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Celular(*):</label>
                            <input type="hidden" name="telCelular" id="telCelular">
                            <input type="text" class="form-control" name="telCelular" id="telCelular" maxlength="100" placeholder="Ingrese el Telefono Celular" required>
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
  if (departamento.value === "atlantida") {
    municipio.add(new Option("La Ceiba", "la Ceiba"));
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
