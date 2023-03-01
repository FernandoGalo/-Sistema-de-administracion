<?php
/*cuando el sistema de preguntas este implementado, mandara los datos a la 
base de datos y luego ingresara al sistema principal */
if (!empty($_POST["btn_enviar_pi"])) {
    
    header("location: Sistema_Principal.php");
}

?>