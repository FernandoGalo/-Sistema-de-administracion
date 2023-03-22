<!DOCTYPE html>
<html lang="en">
<head>
<title> Recuperar contraseña </title>
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
    
    <section class="f_login">
            
    <form class="content" action="../Controladores/recupera_contra_pregunta.php" method="post" enctype="multipart/form-data">
            <h2>Recuperacion de Contraseña</h2><div class="log_R">
            <img src="../img/asociacion.jpg"> 
            </div>
            <?php
    include ("../conexion_BD.php");
   include ("../Controladores/recupera_contra_pregunta.php");
    ?>
            <?php if(isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; ?></p>
            <?php }
             ?>
              <?php

    
    
            /* $user=$_POST['Usuario_Recupera'];
               session_start();
    $_SESSION['usuario']=$user;*/
        $sql=$conexion->query("SELECT * FROM tbl_preguntas");
        ?>

 <!-- comienza el while -->
            <i class="fas fa-user-alt"></i>
            <input class="controls" type="text" name="Usuario_Recupera" placeholder="Ingrese el Usuario" required>
         

        <h3>Seleccione una pregunta</h3>
        <select class="controls" type="text" name="Pregunta" required ><br>
            <?php
        while($row=mysqli_fetch_array($sql)){
        ?>
                 <option value="<?php echo $row['ID_Pregunta'];?>"><?php echo $row['Pregunta'];?></option>
          <?php
          }
        ?>

        <input class="controls" type="text" required name="respuesta" placeholder="Ingrese la Respuesta "><br>
     <!-- TERMINA EL WHILE -->

         <h3>Debe de Realizar cambio de contraseña</h3>
        <input class="controls" type="password" name="contranueva" id="contranueva" required placeholder="Ingrese la Contraseña Nueva " onkeypress="return bloquearEspacio(event);" required><br>
        <button type="button" class="fa fa-eye" onclick="mostrarPassword()"></button>
        <input class="buttons" type="submit" class="btn" name="btn_enviar_R" value="Enviar"> 
       
    </form>
    <section>
    <li><a href="../Pantallas/renovar-Contra.php">volver atras</a></li>
</body>


<script>
function mostrarPassword() {
  var password = document.getElementById("contranueva");
  var boton = document.querySelector(".fa-eye");

  if (password.type === "password") {
    password.type = "text";
    boton.classList.remove("fa-eye");
    boton.classList.add("fa-eye-slash");
  } else {
    password.type = "password";
    boton.classList.remove("fa-eye-slash");
    boton.classList.add("fa-eye");
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