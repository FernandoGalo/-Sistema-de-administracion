<?php 
//Controladores importantes
 require '../../conexion_BD.php'; 
 require_once "../../EVENT_BITACORA.php";
 session_start();     
 $usuario=$_SESSION['user'];
 $ID_Rol=$_SESSION['ID_Rol'];
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
	

	<!-- Theme style -->
	<link rel="stylesheet" href="../../css/adminlte.min.css">

</head>
<style>
	.container-fluid h1{
    text-align: center;
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    color: black;
    margin-top: 20px;
    margin-bottom: 20px;

	}

	.knob-label{
		font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
		font-weight: 100;
		font-size: large;
	}

	.card-header{
		background: #FF9A6E;
		font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
		font-weight: 100;
		font-size: large;


	}

	.card-header{
		background: #FF9A6E;
		font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
		font-weight: 100;
		font-size: large;


	}
</style>


<body >

	<!--+Barra lateral -->
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
		<div style="background: rgb(1,5,36);
			background: linear-gradient(125deg, rgba(1,5,36,1) 0%, rgba(50,142,190,1) 49%, rgba(1,5,36,1) 100%);" class="container-fluid" class="full-box cover dashboard-sideBar" style="overflow-y: auto;">
			<h1 class="panel_informativo">Panel Informativo</h1>
			 <!-- Main content -->
		</div>
			 <section class="content">

    <div class="container-fluid">
        <!-- row -->
        <div class="row">
          <div class="col-12">
            <!-- jQuery Knob -->
            <div style="margin-top: 30px;" class="card">
              <div class="card-header" style="background: #A0FF6A;">
                <h3 class="card-title"><i class="zmdi zmdi-bookmark"></i> Registros</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-6 col-md-3 text-center">
					<?php //TABLA USUARIO
					// Consulta SQL para contar la cantidad de registros en la tabla "usuario"
						$sql = "SELECT COUNT(*) as total FROM tbl_ms_usuario";
						// Ejecutar la consulta
						$resultado=mysqli_query($conexion,$sql);
						// Obtener el resultado como un array asociativo
						$datos = mysqli_fetch_array($resultado);
						$Usuario_cantidad = $datos['total'];
					?>
                    <input type="text" class="knob" value="<?php echo $Usuario_cantidad; ?>" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">
                    <div class="knob-label">Usuarios</div>
                  </div>
                  <!-- ./col -->

                  <div class="col-6 col-md-3 text-center">
					<?php //TABLA PROYECTOS
						// Consulta SQL para contar la cantidad de registros en la tabla "usuario"
							$sql = "SELECT COUNT(*) as total FROM tbl_proyectos";
							// Ejecutar la consulta
							$resultado=mysqli_query($conexion,$sql);
							// Obtener el resultado como un array asociativo
							$datos = mysqli_fetch_array($resultado);
							$Proyecto_cantidad = $datos['total'];
						?>
                    <input type="text" class="knob" value="<?php echo $Proyecto_cantidad; ?>" data-width="90" data-height="90"data-fgColor="#f56954" data-readonly="true">

                    <div class="knob-label">Proyectos</div>
                  </div>
                  <!-- ./col -->

                  <div class="col-6 col-md-3 text-center">
				  <?php //TABLA DONACIONES
						// Consulta SQL para contar la cantidad de registros en la tabla "usuario"
							$sql = "SELECT COUNT(*) as total FROM tbl_donantes";
							// Ejecutar la consulta
							$resultado=mysqli_query($conexion,$sql);
							// Obtener el resultado como un array asociativo
							$datos = mysqli_fetch_array($resultado);
							$Donantes_cantidad = $datos['total'];
						?>
                    <input type="text" class="knob" data-readonly="true" value="<?php echo $Donantes_cantidad; ?>" data-width="90" data-height="90" data-fgColor="#00a65a">
                    <div class="knob-label">Donantes</div>
                  </div>
                  <!-- ./col -->

                  <div class="col-6 col-md-3 text-center">
				  <?php //TABLA VOLUNTARIOS
						// Consulta SQL para contar la cantidad de registros en la tabla "usuario"
							$sql = "SELECT COUNT(*) as total FROM tbl_voluntarios";
							// Ejecutar la consulta
							$resultado=mysqli_query($conexion,$sql);
							// Obtener el resultado como un array asociativo
							$datos = mysqli_fetch_array($resultado);
							$Voluntarios_cantidad = $datos['total'];
						?>
                    <input type="text" class="knob" data-readonly="true" value="<?php echo $Voluntarios_cantidad; ?>" data-width="90" data-height="90" data-fgColor="#00c0ef">
                    <div class="knob-label">Voluntarios</div>
                  </div>
                  <!-- ./col -->

                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
   	</div>

	    <div><!-- FONDOS -->
			<!-- jQuery Knob -->
			<div style="margin-top: 30px;" class="card">
				<div class="card-header" style="background: #A0FF6A;">
					<h3 class="card-title"><i class="zmdi zmdi-bookmark"></i> Fondos</h3>
				</div>
					<?php
						// Consulta SQL para obtener los datos
						require '../../conexion_BD.php'; 
						$sql = "SELECT `Fecha_Creacion`, SUM(`Fondos_proyecto`) AS Total_Fondos FROM tbl_proyectos GROUP BY `Fecha_Creacion`;";

						// Ejecutar la consulta
						$resultado = mysqli_query($conexion, $sql);

						// Formatear los datos en formato JSON
						$data = array();
						while ($fila = mysqli_fetch_assoc($resultado)) {
						$data[] = array('Fecha_Creacion' => $fila['Fecha_Creacion'], 'Total_Tondos' => $fila['Total_Fondos']);
						}
						$json_data = json_encode($data);

						// Crear el gráfico de barras utilizando Chart.js
					?>
					<canvas id="grafico"></canvas>
		</div>

	</div>



	
	</section>

	


	
	<!--script en java para los efectos-->
	<script src="../../js/usuario.js"></script>
	<script src="../../js/jquery-3.1.1.min.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/jquery.knob.min.js"></script><!-- jQuery Knob -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

	<!-- Para los graficos de dona-->
	<script>
		$(function () {
			/* jQueryKnob */

			$('.knob').knob({
			draw: function () {
			}
			})
		})

	</script>

	<!-- Para el grafico lineal del total de fondos-->
	<script>
        var data = <?php echo $json_data; ?>;
        var labels = [];
        var valores = [];
        data.forEach(function(item) {
            labels.push(item.Fecha_Creacion);
            valores.push(item.Total_Tondos);
        });
        var ctx = document.getElementById("grafico").getContext("2d");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de Fondos por Fecha',
                    data: valores,
					fill: false,
                    borderColor: 'rgba(4, 113, 163, 0.61)',
                    tension: 0.1 
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Fecha'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Cantidad de Fondos'
                        }
                    }]
                }
            }
        });
    </script>

	
</body>
</html>