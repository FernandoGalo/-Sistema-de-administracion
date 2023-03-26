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
    let C_contra_A = document.getElementById ("C_contra_A");
    let C_contra_N = document.getElementById("C_contra_N");
    let C_contra_N_2= document.getElementById("C_contra_N_2");

    if (C_contra_N.type == "password") {
        C_contra_A.type ="text";
        C_contra_N.type = "text";
        C_contra_N_2.type = "text";
    } else {
        C_contra_A.type = "password";
        C_contra_N.type = "password";
        C_contra_N_2.type = "password";
    }
  }
</script>
<form actions2="Controlador_C_contra_admin.php" method="post">
<?php
include("Controlador_C_contra_admin.php");
?>
<button type="button" class="fa fa-eye" onclick="mostrarContrasena()"></button>
<h3>ingrese su antigua contraseña<h3>
<input class="controls" type="password" maxlength="8" name="C_contra_A" id="C_contra_A" onkeypress="return bloquearEspacio(event)" onpaste="impedirPegar(event)" placeholder="Ingrese su antigua Contraseña"><br>
<h3>ingrese su nueva contraseña</h3> 
<input class="controls" type="password" maxlength="8" name="C_contra_N" id="C_contra_N" onkeypress="return bloquearEspacio(event)" onpaste="impedirPegar(event)" placeholder="Ingrese su nueva Contraseña"><br>
        <h3>ingrese nuevamente su Contraseña</h3>
        <input class="controls" type="password" maxlength="8" name="C_contra_N_2" id="C_contra_N_2" onkeypress="return bloquearEspacio(event)" onpaste="impedirPegar(event)" placeholder="Ingrese nuevamente su nueva Contraseña"><br>

        <input class="buttons" type="submit" Class="btn" name="btn_enviar_N_Contra" value="Cambiar contraseña">
</form>