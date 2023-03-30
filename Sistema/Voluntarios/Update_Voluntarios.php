<?php
    include("../../conexion_BD.php");
    require_once "../../EVENT_BITACORA.php";
    
    session_start();     
$usuario=$_SESSION['usuario'];
    
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
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--Muestra el titulo de la barra lateral-->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				Creo en ti <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- Informacion de usuario de la barra lateral -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./img/avatar.jpg" alt="UserIcon">
					<figcaption class="text-center text-titles"><?php echo $usuario; ?></figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a href="./Pantallas/Login.php" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- Menu de la barra lateral -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="usuariosAdm.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Mantenimiento usuarios</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Seguridad <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="./Controladores/Bitacora.php"><i class="zmdi zmdi-file zmdi-hc-fw"></i> Bitacora </a>
						</li>
					</ul>
          <li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Proyectos <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href=""><i class="zmdi zmdi-file zmdi-hc-fw"></i> Mantenimiento Proyectos </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-money-box"></i> Fondos <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="FondosAdm.php"><i class="zmdi zmdi-file zmdi-hc-fw"></i> Mantenimiento Fondos </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-accounts"></i> Voluntarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="Voluntarios.php"><i class="zmdi zmdi-file zmdi-hc-fw"></i> Mantenimiento voluntarios </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-money"></i> Pagos <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href=""><i class="zmdi zmdi-file zmdi-hc-fw"></i> Mantenimiento pagos </a>
						</li>
					</ul>
				</li>
				</li>
			</ul>
		</div>
	</section>


    <?php
        if(isset($_POST['Enviar_V'])){

            
         
          
            //aqui entra sio el usuario ha presionado el boton enviar
            $ID_Voluntario=$_POST["ID_Voluntario"];
            $Nombre_Voluntario=$_POST["Nombre_Voluntario"];
            $Telefono_Voluntario=$_POST["Telefono_Voluntario"];
            $Direccion_Voluntario=$_POST["Direccion_Voluntario"];
            $Fecha_actual = date('Y-m-d');


            //si lo que esta en el form esta vacio
            if(empty($Nombre_Voluntario)){
                echo"<p class='error'>* Debes colocar un completo</p>";
            }else if(empty($Telefono_Voluntario)){
                echo"<p class='error'>* Debes colocar el telefono</p>";
            }else if(empty($Direccion_Voluntario)){
                echo"<p class='error'>* Debes colocar la direccion</p>";
            }





            //UPDATE tbl_voluntarios SET Usuario=$user WHERE Nombre_Usuario=$id;
            $sql="UPDATE tbl_voluntarios SET Nombre_Voluntario = '$Nombre_Voluntario', Telefono_Voluntario ='$Telefono_Voluntario', Direccion_Voluntario ='$Direccion_Voluntario',Modificado_por='$usuario', Fecha_Modificacion='$Fecha_actual' WHERE ID_Voluntario='$ID_Voluntario';";
            $resultado=mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                    location.assign('VoluntariosAdm.php');
                    </script>";
                    require_once "../../EVENT_BITACORA.php";
                            $model = new EVENT_BITACORA;
                            session_start();
                            $_SESSION['VOLBitacoraUP']=$Nombre_Voluntario;

                            $model->RegUptVol();
            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('usuariosAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        }
        else{
            //si el usuario NO ha presionado el boton enviar
            $id=$_GET['ID_Voluntario']; //recuperar el id que se envia desde el home.html
            $sql2="SELECT * FROM tbl_voluntarios where ID_Voluntario='".$id."'";
            $resultado=mysqli_query($conexion,$sql2);

            $fila=mysqli_fetch_assoc($resultado);

            $ID_Voluntario=$fila['ID_Voluntario'];
            $Nombre_Voluntario=$fila['Nombre_Voluntario'];
            $Telefono_Voluntario=$fila['Telefono_Voluntario'];//recuperando los datos desde la BD
            $Direccion_Voluntario=$fila['Direccion_Voluntario'];


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
                          <h1 class="box-title">Editar Voluntarios</h1>
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
                          <label>ID Voluntario(*):</label>
                            <input type="hidden" name="ID_Voluntario" id="ID_Voluntario">
                            <input type="text" class="form-control" name="ID_Voluntario" id="ID_Voluntario" maxlength="10" value="<?php echo $ID_Voluntario; ?>" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre Voluntario(*):</label>
                            <input type="hidden" name="Nombre_Voluntario" id="Nombre_Voluntario">
                            <input style="text-transform:uppercase" type="text" class="form-control" name="Nombre_Voluntario" id="Nombre_Voluntario" maxlength="30" placeholder="Ingrese el nombre del voluntario"  onkeypress="validarMayusculas(event)"  value="<?php echo $Nombre_Voluntario; ?>"required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Telefono(*):</label>
                            <input type="hidden" name="Telefono_Voluntario" id="Telefono_Voluntario">
                            <input type="text" class="form-control" name="Telefono_Voluntario" id="Telefono_Voluntario" maxlength="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  placeholder="Ingrese el numero telefonico del voluntario" value="<?php echo $Telefono_Voluntario; ?>" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Direccion Voluntario(*):</label>
                            <input type="hidden" name="Direccion_Voluntario" id="Direccion_Voluntario">
                            <input style="text-transform:uppercase" type="text" class="form-control" name="Direccion_Voluntario" id="Direccion_Voluntario" maxlength="100" placeholder="Ingrese la direccion del voluntario" value="<?php echo $Direccion_Voluntario; ?>" required>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="Enviar_V" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="VoluntariosAdm.php" style="color:white; text-decoration:none;">
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