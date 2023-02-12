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
    <section class="recu_contra">
            <?php if(isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
        <div class="logo_l">
            <img src="img/asociacion.jpg"> 
        </div>

        <h1>Recuperacion de Contraseña</h1>
        <h3>Se le enviaria un correo con la contraseña</h3>
        <h3>Correo</h3>
            <input class="controls" type="email" name="email" placeholder="Ingrese su Correo Electronico">
            <input class="buttons" type="submit" Class="btn" name="btn_enviar_C" value="Enviar"> 
    </section>
</body>

</html>