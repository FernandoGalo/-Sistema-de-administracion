<?php

require '../../conexion_BD.php';
session_start();
include("../../EVENT_BITACORA.PHP");

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
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
                          <h1 class="box-title">Bitacora principal</h1>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-hover">
                        
                        <!-- Buscar -->
						<form action="" method="post">
                            <label for="campo">Buscar:</label>
                            <input type="text" id="buscador" onkeyup="buscarTabla()" placeholder="Buscar...">
                        </form>

                        <thead>
                            <th>ID bitacora</th>
                            <th>fecha</th>
                            <th>Usuario</th>
                            <th>Objeto</th>
                            <th>Accion</th>
                            <th>Descripcion</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                          <?php
            $sql="SELECT b.ID_Bitacora,b.Fecha, u.Usuario, o.Objeto, b.Accion, b.Descripcion 
			from tbl_ms_bitacora b
			JOIN tbl_objetos o ON b.ID_Objeto = o.ID_Objeto
			JOiN tbl_ms_usuario u ON b.ID_Usuario = u.ID_Usuario
			ORDER BY fecha DESC";
            $result=mysqli_query($conexion,$sql);

            while($mostrar=mysqli_fetch_array($result)){
                ?>

                <tr> 
                    <td><?php echo $mostrar['ID_Bitacora']?></td>
                    <td><?php echo $mostrar['Fecha']?></td>
                    <td><?php echo $mostrar['Usuario']?></td>
                    <td><?php echo $mostrar['Objeto']?></td>
                    <td><?php echo $mostrar['Accion']?></td>
                    <td><?php echo $mostrar['Descripcion']?></td>
                </tr>
             <?php
            }
             ?>     
                          </tfoot>
                        </table>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
		</div>
	</section>


	
	<!--script en java para los efectos-->
	<script src="../../js/jquery-3.1.1.min.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/Buscador.js"></script>
</body>
</html>