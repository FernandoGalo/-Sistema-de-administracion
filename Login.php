<!DOCTYPE html>
<html lang="en">
<head>
    <title> Login </title>
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
    <form actions2="controlador_login.php" method="post">
            <h2>Usuario</h2>
            <?php if(isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
        <label>Usuario</label>
        <input type="usuario" name="Usuario" placeholder="ingrese su usuario"><br>
        <label>contraseña</label>
        <input type="contraseña" name="Contra" placeholder="ingrese su contraseña"><br>

        <button type="submit">Login</button>

        <a href="renovar-Contra.html">¿olvidaste la contraseña?</a>
    </form>
</body>

</html>


