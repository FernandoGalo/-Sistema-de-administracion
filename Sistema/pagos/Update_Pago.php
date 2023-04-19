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
  
<?php include '../sidebarpro.php'; ?>
    <?php
        if(isset($_POST['enviar_F2'])){
            //aqui entra si el usuario ha presionado el boton enviar
            session_start();
            $Usuario=$_SESSION['usuario'];       
    include("../../conexion_BD.php");
    $sql1=$conexion->query("SELECT * FROM `tbl_ms_usuario` WHERE Usuario='$Usuario'");

    while($row=mysqli_fetch_array($sql1)){
        $ID_Usuario=$row['ID_Usuario'];
    }
    $ID_Pago=$_POST["ID_de_pago"];
    $Monto=$_POST["Monto_pagado"];
    $T_Monto=$_POST["Pago"];
    $ID_Proyecto=$_POST["Proyecto"];

    $Fecha_de_transaccion=$_POST["FechaTransaccion"];
    $Fecha_actual = date('Y-m-d');
            //si lo que esta en el form esta vacio

            //UPDATE tbl_ms_usuario SET Usuario=$user WHERE Nombre_Usuario=$id;
            $sql="UPDATE tbl_pagos_realizados SET Monto_pagado = $Monto, ID_T_pago = $T_Monto,ID_de_proyecto = $ID_Proyecto, ID_usuario = $ID_Usuario, Fecha_de_transaccion ='$Fecha_de_transaccion', Modificado_por= '$Usuario', Fecha_Modificacion = '$Fecha_actual' where ID_de_pago = $ID_Pago";
            $resultado = mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                    location.assign('PagosAdm.php');
                    </script>";
                    require_once "../../EVENT_BITACORA.php";
                    $model = new EVENT_BITACORA;
                    session_start();

                    $_SESSION['idpagoBitacoraUP']=$ID_Pago;
                    $model->RegUptpag();

            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('PagosAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        }else{
            //si el usuario NO ha presionado el boton enviar
            $id=$_GET['ID_de_pago']; //recuperar el id que se envia desde el home.html
            $sql="SELECT * FROM tbl_pagos_realizados where ID_de_pago='".$id."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);

            $ID_Pago=$fila['ID_de_pago'];
            $Monto=$fila['Monto_pagado'];
            $T_Monto=$fila['ID_T_pago'];
            $ID_Proyecto=$fila['ID_de_proyecto'];
            $ID_Usuario=$fila['ID_Usuario'];
            $Fecha_transaccion=$fila['Fecha_de_transaccion'];
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
                          <h1 class="box-title">Editar Pagos</h1>
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
                          <label>ID del Pago(*):</label>
                            <input type="hidden" name="ID_de_pago" id="ID_de_pago">
                            <input style="text" type="text" class="form-control" name="ID_de_pago" id="ID_de_pago" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'   value="<?php echo $ID_Pago; ?>" readonly>
                          </div>
                          
                          <?php require '../../conexion_BD.php';?>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Monto Pagado(*):</label>
                            <input type="hidden" name="Monto_pagado" id="Monto_pagado">
                            <input style="text" type="text" class="form-control" name="Monto_pagado" id="Monto_pagado" value="<?php echo $Monto; ?>" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Tipo de Pago(*):</label>
                            <?php
                           $sql1=$conexion->query("SELECT * FROM tbl_tipo_pago_r");
                          ?>
                            <select class="controls" type="text" name="Pago" id="Pago" value="<?php echo $T_Monto; ?>" required ><br>
                           <?php
                            while($row1=mysqli_fetch_array($sql1)){
                            ?>
                             <option value="<?php echo $row1['ID_T_pago'];?>"><?php echo $row1['Nombre'];?></option>
                            <?php
                             }
                            ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Proyecto(*):</label>
                            <?php
                           $sql2=$conexion->query("SELECT * FROM tbl_proyectos");
                          ?>
                            <select class="controls" type="text" name="Proyecto" id="Proyecto"  value="<?php echo $ID_Proyecto; ?>" required ><br>
                           <?php
                            while($row1=mysqli_fetch_array($sql2)){
                            ?>
                             <option value="<?php echo $row1['ID_proyecto'];?>"><?php echo $row1['Nombre_del_proyecto'];?></option>
                            <?php
                             }
                            ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Usuario</label>
                            <input type="text" class="form-control"  name="Usuario" id="Usuario" maxlength="100" value="<?php echo $usuario; ?>" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Fecha de Transaccion:</label>
                            <input type="date" class="form-control" name="FechaTransaccion" id="FechaTransaccion" maxlength="100" placeholder="Ingrese la Fecha de Transaccion">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar_F2" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="PagosAdm.php" style="color:white; text-decoration:none;">
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