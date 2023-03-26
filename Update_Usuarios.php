<?php
    include("conexion_BD.php");
    require_once "EVENT_BITACORA.php";
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<script>
		function validarMayusculas(e) {
			var tecla = e.keyCode || e.which;
			var teclaFinal = String.fromCharCode(tecla).toUpperCase();
			var letras = /^[A-Z]+$/;

			if(!letras.test(teclaFinal)){
				e.preventDefault();
			}
		}
</script>
<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">

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
					<figcaption class="text-center text-titles">Nombre de usuario</figcaption>
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
				</li>
			</ul>
		</div>
	</section>


    <?php
        if(isset($_POST['enviar'])){
            //aqui entra sio el usuario ha presionado el boton enviar
            $id=$_POST['IDusuario'];
            $userName=$_POST['Nombre_Usuario'];
            $user=$_POST['Usuario'];//Obtenidos desde el formulario
            $Rol= $_POST['Rol'];
            $contra=$_POST['contraseña'];
            $email=$_POST['Correo_electronico'];
            $vencimiento = $_POST['FechaVencimiento'];
            $Estado = strtoupper($_POST['Estado']);



            //si lo que esta en el form esta vacio
            if(empty($userName)){
                echo"<p class='error'>* Debes colocar tu nombre completo</p>";
            }else if(empty($user)){
                echo"<p class='error'>* Debes colocar tu usuario</p>";
            }else if(empty($contra)){
                echo"<p class='error'>* Debes colocar tu password</p>";
            }else if(empty($email)){
                echo"<p class='error'>* Debes colocar tu correo</p>";
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<p class='error'> El correo es incorrecto</p>";
            }else{





            //UPDATE tbl_ms_usuario SET Usuario=$user WHERE Nombre_Usuario=$id;
            $sql="UPDATE tbl_ms_usuario SET Nombre_Usuario = '$userName', Usuario ='$user', ID_Rol ='$Rol', Contraseña = '$contra', Correo_electronico = '$email', Fecha_Vencimiento = '$vencimiento', Estado_Usuario = '$Estado' WHERE ID_Usuario='$id';";
            $resultado=mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                    location.assign('usuariosAdm.php');
                    </script>";
                    require_once "EVENT_BITACORA.php";
                            $model = new EVENT_BITACORA;
                            session_start();
                            $_SESSION['UsuarioBitacoraUP']=$user;
                            $_SESSION['IDUsuarioBitacoraUP']=$id;
                            $model->RegUpt();
            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('usuariosAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        }
        }else{
            //si el usuario NO ha presionado el boton enviar
            $id=$_GET['ID_Usuario']; //recuperar el id que se envia desde el home.html
            $sql="SELECT * FROM tbl_ms_usuario where ID_Usuario='".$id."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);

            $idUser=$fila['ID_Usuario'];
            $nombreUsuario=$fila['Nombre_Usuario'];
            $usuario=$fila['Usuario'];//recuperando los datos desde la BD
            $Rol=$fila['ID_Rol'];
            $pass=$fila['Contraseña'];
            $correo=$fila['Correo_electronico'];
            $vencimiento=$fila['Fecha_Vencimiento'];
            $Estado=$fila['Estado_Usuario'];

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
                          <h1 class="box-title">Editar usuarios</h1>
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
                            <label>ID_Usuario(*):</label>
                            <input type="hidden" name="IDusuario" id="IDusuario">
                            <input type="text" class="form-control" name="IDusuario" id="IDusuario" maxlength="100" value="<?php echo $idUser; ?>" readonly>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Usuario(*):</label>
                            <input type="hidden" name="Usuario" id="Usuario">
                            <input style="text-transform:uppercase" type="text" class="form-control" name="Usuario" id="Usuario" maxlength="100"  value="<?php echo $usuario; ?>" placeholder="Ingrese el usuario" onkeypress="validarMayusculas(event)" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre Usuario(*):</label>
                            <input type="hidden" name="Nombre_Usuario" id="Nombre_Usuario">
                            <input type="text" class="form-control" name="Nombre_Usuario" id="Nombre_Usuario" maxlength="100" placeholder="Ingrese el nombre de usuario" onkeypress="validarMayusculas(event);" value="<?php echo $nombreUsuario; ?>" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Rol de Usuario(*):</label>
                            <!-- <input type="hidden" name="Rol" id="Rol"> -->
                            <!-- <input type="number" min="1" max="3" class="form-control" name="Rol" id="Rol" maxlength="1" placeholder="1:admin 2:Editor 3:Super"value=""required> -->
                            <select class="form-control" name="Rol" id="Rol" required>
                              <option value="">Selecione un Rol</option>
                              <option value= 1 >ADMINISTRADOR</option>
                              <option value= 2 >EDITOR</option>
                              <option value= 3 >SUPERVISOR</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <label>Correo electrónico (*):</label>
                           <input type="hidden" name="Correo_electronico" id="Correo_electronico">
                           <input type="text" class="form-control" name="Correo_electronico" id="Correo_electronico" maxlength="100" placeholder="Ingrese el correo electrónico" value="<?php echo $correo; ?>" onkeypress="validarCorreo(event)" required>
                            </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="contraseña">Contraseña</label>
                          <div class="input-group">
                          <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Ingrese su contraseña" maxlength="8" onkeypress="return bloquearEspacio(event);" value="<?php echo $pass; ?>" required>
                           <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="button" id="ver-ocultar" onclick="mostrarContrasena()">
                          <i class="zmdi zmdi-eye"></i>
                          </button>
                         </div>
                         </div>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Fecha de Vencimiento(*):</label>
                            <input type="hidden" name="FechaVencimiento" id="FechaVencimiento">
                            <input type="date" class="form-control" name="FechaVencimiento" id="FechaVencimiento" maxlength="100" placeholder="Ingrese la fecha de vencimiento" value="<?php echo $vencimiento; ?>" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Estado Actual(*)</label>
                            <input type="text" class="form-control" name="Estado_actual" id="Estado_actual" maxlength="100" value="<?php echo $Estado; ?>" readonly>
                            <label>Estado usuario(*)</label>
                            <select class="form-control" name="Estado" id="Estado" required>
                              <option value="">Selecione un Estado</option>
                              <option value="Activo">ACTIVO</option>
                              <option value="Bloqueado">BLOQUEADO</option>
                              <option value="Nuevo">NUEVO</option>
                              <option value="Inactivo">INACTIVO</option>
                            </select>
                        </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="usuariosAdm.php" style="color:white; text-decoration:none;">
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
  <script>
		function validarMayusculas(e) {
			var tecla = e.keyCode || e.which;
			var teclaFinal = String.fromCharCode(tecla).toUpperCase();
			var letras = /^[A-Z]+$/;

			if(!letras.test(teclaFinal)){
				e.preventDefault();
			}
		}
	</script>
    <script>
  function mostrarContrasena() {
    var contrasenaInput = document.getElementById("contraseña");
    var botonVerOcultar = document.getElementById("ver-ocultar");
    
    if (contrasenaInput.type === "password") {
      contrasenaInput.type = "text";
      botonVerOcultar.innerHTML = '<i class="zmdi zmdi-eye-off"></i>';
    } else {
      contrasenaInput.type = "password";
      botonVerOcultar.innerHTML = '<i class="zmdi zmdi-eye"></i>';
    }
  }
  </script>
  <script>
function validarCorreo(event) {
  var correo = event.target.value;
  var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!regex.test(correo)) {
    event.target.setCustomValidity("Ingrese un correo electrónico válido");
  } else {
    event.target.setCustomValidity("");
  }
}
</script>
<script>
        function bloquearEspacio(event) {
        var tecla = event.keyCode || event.which;
        if (tecla == 32) {
            return false;
        }
        }
</script>
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/main.js"></script>
    <script src="./js/usuario.js"></script>

</body>
</html>