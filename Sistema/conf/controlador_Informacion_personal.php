<?php
session_start();
$ID_usuario = $_SESSION['ID_User'];
    if(isset($_POST['boton2'])){
      $userName=$_POST['N_U_Imput'];
      $user=$_POST['U_Imput'];
      $email=$_POST['C_E_Imput'];
      if (empty($_POST["N_U_Imput"]) and empty($_POST["U_Imput"])and empty($_POST["C_E_Imput"])){
        echo '<div class="alert alert-danger">los campos estan vacios</div>';
      }else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo '<div class="alert alert-danger">formato de correo erroneo</div>'; 
      }else {
        $consulta = "UPDATE tabla SET Nombre_Usuario='$userName', Usuario='$user', Correo_electronico='$email' WHERE ID_Usuario=$ID_usuario";
        // Ejecutar la consulta y verificar si se ha actualizado correctamente
        if (mysqli_query($conexion, $consulta)) {
            echo '<script>alert("La información se ha actualizado correctamente."); location.reload();</script>';
        } else {
          echo "Error al actualizar la información: ";
        }
      }
    }
  }
?>
