<!DOCTYPE html>
<html lang="en">
<head>
<title> nueva contraseña </title>
    <link rel="stylesheet" href="../css/normalize.css">
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
</head>
<body>
        <section class="primer_i">

        <form class="content" action="../Controladores/controlador_N_Contra.php" method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php
             include ("../conexion_BD.php");
             //include ("controlador_N_Contra");
        ?>
         <h3>Es necesario un cambio de contraseña</h3>
         <h3>Por favor ingrese una nueva contraseña</h3>
         <input class="controls" type="password" name="contranueva" id="contranueva" placeholder="Ingrese la Contraseña Nueva" onkeypress="return bloquearEspacio(event);" required><br>
         <button type="button" class="fa fa-eye" onclick="mostrarPassword()"></button>
        <input class="buttons" type="submit" class="btn" name="btn_enviar_R" value="Enviar"> 
        </form>
        </section>
</body>

<script>
function mostrarPassword() {
  var password = document.getElementById("contranueva");
  var boton = document.querySelector("fa fa-eye");

  if (password.type === "password") {
    password.type = "text";
    boton.classList.remove("fa fa-eye");
    boton.classList.add("fa fa-eye-slash");
  } else {
    password.type = "password";
    boton.classList.remove("fa fa-eye-slash");
    boton.classList.add("fa fa-eye");
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

</html>
