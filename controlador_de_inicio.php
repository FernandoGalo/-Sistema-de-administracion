<?php
session_start();
if (empty($_SESSION['user']) and empty($_SESSION['passw'])) {
    header('location:Login.php');
}else{
header('location:Sistema_Principal.php');
}
?>