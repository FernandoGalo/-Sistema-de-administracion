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
            //aqui entra sio el usuario ha presionado el boton enviar
            // $id_rol=$_GET['id'];
            $id_rol2=$_POST['id'];

            $nombreRol=$_POST['Nombre_rol'];
            $descripcion=$_POST['descripcion'];//Obtenidos desde el formulario
            $estado= $_POST['estado'];




            //si lo que esta en el form esta vacio
            if(empty($nombreRol)){
                echo"<p class='error'>* Debes colocar un rol</p>";
            }else if(empty($descripcion)){
                echo"<p class='error'>* Debes colocar una descripcion</p>";
            }else if(empty($estado)){
                echo"<p class='error'>* Debes colocar un estado</p>";
            }else{





            //UPDATE tbl_ms_usuario SET Usuario=$user WHERE Nombre_Usuario=$id;
            $sql="UPDATE tbl_ms_roles SET Rol = '$nombreRol', Descripcion ='$descripcion', Estado = $estado WHERE ID_ROL = $id_rol2";
            $resultado=mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                    location.assign('RolesAdm.php');
                    </script>";

            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron');
            location.assign('RolesAdm.php');
            </script>";
            }
            mysqli_close($conexion);
        }
        }else{
            //si el usuario NO ha presionado el boton enviar
            $id=$_GET['ID_Rol']; //recuperar el id que se envia desde el home.html
            $sql="SELECT * FROM tbl_ms_roles where ID_Rol='".$id."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);

            $nombreRol=$fila['Rol'];
            $descripcion=$fila['Descripcion'];
            $estado=$fila['Estado'];//recuperando los datos desde la BD

            if($fila['Estado'] == 1){
                $strEstado = "Activo";
              }else{
                $strEstado = "Inactivo";
              } 
              

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
                          <h1 class="box-title">Editar Roles</h1>
                        </div>
                        <br>
                    </div>


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>ID ROL(*):</label>
                            <input type="hidden" name="id" id="id">
                            <input type="text" class="form-control" name="id" id="id" maxlength="100" placeholder="Ingrese la descripcion del rol" value="<?php echo $id?>"  readonly required>
                          </div>

        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Nombre rol(*):</label>
                            <input type="hidden" name="Nombre_rol" id="Nombre_rol">
                            <input type="text" class="form-control" name="Nombre_rol" id="Nombre_rol" maxlength="100" placeholder="Ingrese el nombre del Rol" onkeypress="validarMayusculas(event)" value="<?php echo $nombreRol?>" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Descripcion(*):</label>
                            <input type="hidden" name="descripcion" id="descripcion">
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="100" placeholder="Ingrese la descripcion del rol" value="<?php echo $descripcion ?>" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Estado Actual</label>
                            <input type="text" class="form-control" name="Estado_actual" id="Estado_actual" maxlength="100" value="<?php echo $strEstado ?>" readonly>
                            <label>Estado(*):</label>
                           <!-- <input type="number" min="1" max="3" class="form-control" name="Rol" id="Rol" maxlength="1" placeholder="1:Administrador 2:Editor 3:Supervisor">  -->
                            <select class="form-control" name="estado" id="estado" required>
                              <option value="">Selecione un estado</option>
                              <option value="1" >ACTIVO</option>
                              <option value="2" >INACTIVO</option>
                            </select>
                          </div>


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" name="enviar" value="AGREGAR"><i class="zmdi zmdi-download"></i> Guardar</button>
                          <button class="btn btn-danger" type="button">
                          <a href="RolesAdm.php" style="color:white; text-decoration:none;">
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