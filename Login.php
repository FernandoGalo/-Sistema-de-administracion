<!DOCTYPE html>
<html lang="en">
<head>
    <title> Login </title>
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
<div class="logo">
                <img src="img/asociacion.jpg" alt=""> 
            </div>
    <form actions2="controlador_login.php" method="post">
    <?php
    include ("conexion_BD.php");
    include ("controlador_login.php");
    ?>
            <h2>Usuario</h2>
            <?php if(isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
        <label>Usuario</label>
        <input type="text" name="usuario" placeholder="ingrese su usuario"><br>
        <label>contraseña</label>
        <input type="password" name="contra" placeholder="ingrese su contraseña"><br>
        <input type="submit" Class="btn" name="btn_Login" value="Iniciar secion" ></br>
       
        <a href="renovar-Contra.html">¿olvidaste la contraseña?</a>
    </form>
    <li> <a href="index.html">Home</a></li>
</body>

</html>


