<?php

$conexion = new mysqli("localhost", "root", "", "bd_asociacion_creo_en_ti", "3306");
$conexion->set_charset("utf8");
session_start();
require_once "EVENT_BITACORA.php";

#$user = new Manto;
#$user-> select = 'tbl_ms_usuario.Nombre_Usuario,tbl_ms_usuario.ID_Usuario';
#$user->from ='tbl_ms_bitacora inner join tbl_ms_usuario on (tbl_ms_usuario.ID_Usuario = tbl_ms_bitacora.ID_Usuario)';
#$user->condition = '';
#$user->leer();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> Monstrar bitacora </title>
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
    
    <link rel="stylesheet" media="screen and (min-device-width: 1025px) and (max-width: 1440px)" href="css/desktop-style.css" />
    <!-- Para Celular -->
    <link rel='stylesheet' media='screen and (min-width: 100px) and (max-width: 767px)' href='css/mobile-style.css' />
    <!-- Para Tablet -->
    <link rel='stylesheet' media='screen and (min-width: 768px) and (max-width: 1024px)' href='css/medium-style.css' />
</head>
<body>
    
    <header>

        <div class="header__superior">
            <div class="logo">
                <img src="img/asociacion.jpg" alt=""> 
            </div>
        </div>

        <div class="contenedor__menu">

            <div class="menu">
                <input type="checkbox" id="check__menu">
                <label id="label__check" for="check__menu">
                    <i class="fa-solid fa-bars icon__menu"></i>
                </label>
                <nav>
                    <ul>
                        <li> <a href="#" id="selected"></a></li>
                        <li> <a href="#">Conocenos +</a>
                            <ul>
                                <li><a href="#">Redes Sociales</a></li>
                                <li><a href="mision_vision.html">Misión y Visión</a></li>
                                <li><a href="informacion_general.html">Información General</a></li>
                            </ul>
                        </li>
                        <li> <a href="#">Proyectos +</a>
                            <ul>
                                <li><a href="#">Proyectos en proceso</a></li>
                                <li><a href="#">Proyectos a futuro</a></li>
                                <li><a href="#">Proyectos realizados</a></li>
                            </ul>
                        </li>
                        <li> <a href="#">Como Ayudar +</a>
                            <ul>
                                <li><a href="#">¿Cómo donar?</a></li>
                                <li><a href="#">Voluntariado</a></li>
                                <li><a href="Contactenos.html">Contactenos</a></li>
                            </ul>
                        </li>
                        <li> <a href="Login.php">Miembros</a></li>
                        <li> <a href="Donar.html">Dona Aqui</a></li>
                    </ul>
                </nav>
            </div>

        </div>
        <div>
<div class="container">
<div class="consulta mt-4">
<div class="row">
    <div class="col-6">
        <h3>
            Bitacora
        </h3>
    </div>
</div>
<div class="box-body">
    <div class="table table-responsive">
        <table table border="1" class="table table-hover">
            <thead>
             <tr>
                    <th>Bitacora</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Objeto</th>
                    <th>Accion</th>
                    <th>Descripcion</th>
                    
                </tr>
            </thead>
            <?php
            $sql="SELECT * from tbl_ms_bitacora";
            $result=mysqli_query($conexion,$sql);

            while($mostrar=mysqli_fetch_array($result)){
                ?>

                <tr> 
                    <td><?php echo $mostrar['ID_Bitacora']?></td>
                    <td><?php echo $mostrar['Fecha']?></td>
                    <td><?php echo $mostrar['ID_Usuario']?></td>
                    <td><?php echo $mostrar['ID_Objeto']?></td>
                    <td><?php echo $mostrar['Accion']?></td>
                    <td><?php echo $mostrar['Descripcion']?></td>
                </tr>
             <?php
            }
             ?>
        </table>
    </div>
</div>

    </header> <!-- Fin Header -->

