<?php
require '../../conexion_BD.php';
/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */
require_once "../../EVENT_BITACORA.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<style></style>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
<script>
	function impedirPegar(event) {
  event.preventDefault(); // Impide la acción predeterminada de pegar el texto
}
function mostrarContrasenaGU() {
      let C_contra_A = document.getElementById("C_contra_A");
      let C_contra_N= document.getElementById("C_contra_N");
      let C_contra_N_2= document.getElementById("C_contra_N_2");
      if (C_contra_A.type == "password") {
          C_contra_A.type = "text";
          C_contra_N.type = "text";
      C_contra_N_2.type = "text";
      } else {
      C_contra_A.type = "password";
          C_contra_N.type = "password";
      C_contra_N_2.type = "password";
      }
    }

</script>
</head>
<form actions2="Controlador_C_contra_admin.php" method="post">
<?php
include("Controlador_C_contra_admin.php");
?>

<h3>ingrese su antigua contraseña<h3> 
<input class="controls" type="password" maxlength="8" name="C_contra_A" id="C_contra_A" onkeypress="return bloquearEspacio(event)"  onpaste="impedirPegar(event)" placeholder="Ingrese su antigua Contraseña"><br>
<h3>ingrese su nueva contraseña</h3> 
       <input class="controls" type="password" maxlength="8" name="C_contra_N" id="C_contra_N" onkeypress="return bloquearEspacio(event)" onpaste="impedirPegar(event)" placeholder="Ingrese su nueva Contraseña"><br>
        <h3>ingrese nuevamente su Contraseña</h3>
        <input class="controls" type="password" maxlength="8" name="C_contra_N_2" id="C_contra_N_2" onkeypress="return bloquearEspacio(event)" onpaste="impedirPegar(event)" placeholder="Ingrese nuevamente su nueva Contraseña"><br>
		<h3></h3>
        <button type="button" class="zmdi zmdi-eye-off" onclick="mostrarContrasenaGU()"></button>
		<h3></h3>
        <input class="buttons" type="submit" Class="btn" name="btn_enviar_N_Contra" value="Cambiar contraseña">
    </form>



	
	<!--script en java para los efectos-->
	<script src="../../js/Buscador.js"></script>
	<script src="../../js/jquery-3.1.1.min.js"></script>
	<script src="../../js/events.js"></script>
	<script src="../../js/main.js"></script>
    <script src="../../js/usuario.js"></script>

</body>
</html>
