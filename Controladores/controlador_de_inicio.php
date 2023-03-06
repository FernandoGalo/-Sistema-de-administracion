<?php
require '../conexion_BD.php';
session_start();
if (empty($_SESSION['user']) and empty($_SESSION['passw'])) {
    header('location:../Pantallas/Login.php');
}else{
        header('location:../Pantallas/home.html');
}

/*esta variable impide que se pueda entrar al sistema principal si no se entra por login (crea un usuario global) */
?>