<!DOCTYPE html>
<html lang="en">
<head>
<title> Sistema Principal </title>
    <link rel="stylesheet" href="css/normalize.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&family=Staatliches&display=swap" rel="stylesheet">
    <!-- Preload -->
    <link rel="preload" href="css/normalize.css">
    <link rel="stylesheet" href="css/normalize.css">

    <link rel="preload" href="css/style.css">
    <link rel="stylesheet" href="css/style.css">
</head>
  
<body>
    <?php
    include ("controlador de inicio.php");
    ?>
    <header>
    <div class="logo_l">
        <img src="img/asociacion.jpg"> 
    </div>
    <h1>Asociacion Creo en tí</h1>
            <li><a href="Login.php">Desconectar</a></li>
            <input class="buttons" type="submit" Class="btn" name="btn_E_Configuracion" value="Configuracion" ></br>
    </header>

     <form action="">

     </form>
     <input class="buttons" type="submit" Class="btn" name="btn_I_Proyectos" value="Proyectos" ></br>
     <input class="buttons" type="submit" Class="btn" name="btn_I_Fondos" value="Fondos" ></br>
     <input class="buttons" type="submit" Class="btn" name="btn_I_Voluntarios" value="Voluntarios" ></br>
     <input class="buttons" type="submit" Class="btn" name="btn_I_Libro_c" value="Libro contable" ></br>
     <input class="buttons" type="submit" Class="btn" name="btn_I_Partidas" value="Partidas" ></br>
     <input class="buttons" type="submit" Class="btn" name="btn_I_SAR" value="SAR" ></br>
     
    
</body>
</html>