<!DOCTYPE html>
<html lang="en">
<head>
<title>Cambio de Contraseña</title>
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
function bloquearEspacio(event) {
  var tecla = event.keyCode || event.which;
  if (tecla == 32) {
    return false;
  }
}
</script>
</head>
<body style="background: rgb(1,5,36);
            background: radial-gradient(circle, rgba(1,5,36,1) 0%, rgba(50,142,190,1) 100%);">
    
    <section class="f_login">

        <form  action="../Controladores/controlador_nueva_contra.php" method="post" enctype="multipart/form-data"  onsubmit="return validar()">

           <h2>Nueva Contraseña</h2>
            <div class="log_R">
            <img src="../img/asociacion.jpg"> 
            </div>
            
              <?php
              include ("../conexion_BD.php");
              include ("../Controladores/controlador_nueva_contra.php");
              ?>

            <?php 
            if(isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

                    

          <h3>Contraseña actual</h3>
          <input class="controls" maxlength="20" type="password" id="contrasena_actual" name="contrasena_actual" onkeypress="return bloquearEspacio(event)" placeholder="Ingrese su contraseña actual" required><br>
        
          <h3>Nueva Contraseña</h3>
          <input class="controls" maxlength="20" type="password" id="contrasena_nueva" name="contrasena_nueva" onkeypress="return bloquearEspacio(event)"  placeholder="Ingrese su Nueva Contraseña" required><br>
          <h3>Confirmar Nueva contraseña</h3>
          <input class="controls" maxlength="20" type="password" id="confirmar_contrasena" name="confirmar_contrasena" onkeypress="return bloquearEspacio(event)"  placeholder="Confirme su nueva Contraseña" required><br>

          
          <input type="checkbox" id="mostrar_contrasena">
          <label for="mostrar_contrasena">Mostrar contraseñas</label>
              
            
          <input class="buttons" type="submit" name="btn_enviar_New_Contra" value="Actualizar"> 
          <?php
          ?>
          

    </form>
            
     <style>

      
      /* Ocultamos el checkbox original */
      input[type=checkbox] {
        display: none;

      }

      /* Estilo del checkbox personalizado */
      label {
        display: inline-block;
        position: relative;
        padding-left: 25px;
        margin-right: 10px;
        cursor: pointer;
        font-size: 16px;
        color: #002406;
        margin-top: 2px;
        margin-bottom: 20px;
        
      }

      /* Estilo del "tick" del checkbox */
      label:before {
        content: "";
        display: inline-block;
        position: absolute;
        left: 0;
        
        width: 16px;
        height: 16px;
        border: 1px solid #bbb;
        background-color: #def7a5;
      }

      /* Estilo del "tick" del checkbox cuando está seleccionado */
      input[type=checkbox]:checked + label:before {
        content: "\2713";
        color: #08e95e;
        font-size: 16px;
        text-align: center;
        line-height: 16px;
        background-color: #181717;
        border: 1px solid #bbb;
      }


    </style>

    <script>
      var mostrarContrasena = document.getElementById("mostrar_contrasena");
      var contrasena1 = document.getElementById("contrasena_actual");
      var contrasena2 = document.getElementById("contrasena_nueva");
      var contrasena3 = document.getElementById("confirmar_contrasena");
      
      mostrarContrasena.addEventListener("click", function() {
        if (mostrarContrasena.checked) {
          contrasena1.type = "text";
          contrasena2.type = "text";
          contrasena3.type = "text";
        } else {
          contrasena1.type = "password";
          contrasena2.type = "password";
          contrasena3.type = "password";
        }
      });
    </script>



   
</body>

</html>
