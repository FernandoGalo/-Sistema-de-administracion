<?php 

 require_once "../EVENT_BITACORA.php";
 if(isset($_POST['btn_enviar_R'])){

     $model = new EVENT_BITACORA;
     //$model->R_Nombre = $_POST['R_Nombre'];
     $model->R_usuario = $_POST['R_usuario'];
     $model->R_contra = $_POST['R_contra'];
     //$model->R_contra_2 = $_POST['R_contra_2'];
     //$model->R_correo = $_POST['R_correo'];
     $model->regNuevoUser();
 };
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> Registro de usuario </title>
    <link rel="stylesheet" href="css/normalize.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
    <!-- Preload -->
    <link rel="preload" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/normalize.css">

    <link rel="preload" href="../css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <script>
function soloLetras(e) {
    // Obtener el código ASCII de la tecla presionada
    var key = e.keyCode || e.which;
    
    // Convertir el código ASCII a una letra
    var letra = String.fromCharCode(key).toLowerCase();
    
    // Definir la expresión regular
    var soloLetras = /[a-z\s]/;
    
    // Verificar si la letra es válida
    if (!soloLetras.test(letra)) {
        // Si la letra no es válida, cancelar el evento
        e.preventDefault();
        return false;
    }
}
</script>
<script>
function validarMayusculas(e) {
			var tecla = e.keyCode || e.which;
			var teclaFinal = String.fromCharCode(tecla).toUpperCase();
			var letras = /^[A-Z]+$/;

			if(!letras.test(teclaFinal)){
				e.preventDefault();
			}
		}
function impedirPegar(event) {
  event.preventDefault(); // Impide la acción predeterminada de pegar el texto
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
<script>
function mostrarContrasena() {
    let R_contra = document.getElementById("R_contra");
    let R_contra_2= document.getElementById("R_contra_2");

    if (R_contra.type == "password") {
        R_contra.type = "text";
        R_contra_2.type = "text";
    } else {
        R_contra.type = "password";
        R_contra_2.type = "password";
    }
  }
</script>
</head>
<body>
    <section class="f_login">
            
    <form actions2="../Controladores/controlador_registro.php" method="post"> <!--envia datos de tipo post -->
            <h2>Registro</h2>
            <div class="log_R">
            <img src="../img/asociacion.jpg">  <!--logo -->
            </div>
            <?php
    include ("../conexion_BD.php");
    include ("../Controladores/controlador_registro.php"); /*incluyo los controladores que necesita para funcionar */
    ?>
            <?php if(isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; ?></p> <!-- esto manda los errores php que esten sucediendo -->
            <?php } ?>
            <h3>Nombre completo</h3>
        <input class="controls" type="text" name="R_Nombre" onkeypress="return soloLetras(event);" placeholder="Ingrese su Nombre completo"><br> <!--text de nombre completo -->
        <h3>Nombre de usuario</h3>
        <input class="controls" type="text" maxlength="15" name="R_usuario" onkeypress="return validarMayusculas(event)" onpaste="impedirPegar(event)" style="text-transform:uppercase" placeholder="Ingrese su Usuario"><br>
        <h3>contraseña</h3> <button type="button" class="fa fa-eye" onclick="mostrarContrasena()"></button>
        <input class="controls" type="password" maxlength="8" name="R_contra" id="R_contra" onkeypress="return bloquearEspacio(event)" onpaste="impedirPegar(event)" placeholder="Ingrese su Contraseña"><br>
        <h3>Confirmar Contraseña</h3>
        <input class="controls" type="password" maxlength="8" name="R_contra_2" id="R_contra_2" onkeypress="return bloquearEspacio(event)" onpaste="impedirPegar(event)" placeholder="Ingrese nuevamente la Contraseña"><br>
        <h3>Correo Electronico</h3>
        <input class="controls" type="text" name="R_correo" placeholder="Ingrese su Correo Electronico"><br>

        <input class="buttons" type="submit" Class="btn" name="btn_enviar_R" value="Enviar">  <!--boton que envia los datos de registro al controlador -->
       
    </form>
    <section>
    <li><a href="../Pantallas/Login.php">volver atras</a></li> <!-- text que te manda a login-->
</body>

</html>


