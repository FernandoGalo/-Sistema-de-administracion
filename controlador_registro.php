<?php
if (!empty($_POST["btn_enviar_R"])) {
    if (empty($_POST["R_usuario"]) and empty($_POST["R_contra"])and empty($_POST["R_correo"])) 
    {
        echo '<div class="alert alert-danger">los campos estan vacios</div>';
    } else{
        if (($_POST["R_contra"]) != ($_POST["R_contra_2"])) {
            echo '<div class="alert alert-danger">la contraseña es distinta </div>';
            $email = $_POST["email"];
       

        } else {
            $R_Correo=$_POST["R_correo"];
            if (!filter_var($R_Correo, FILTER_VALIDATE_EMAIL)) {
                echo '<div class="alert alert-danger">formato de correo erroneo</div>'; 
            } else {

	$caracteres = '0123456789'; /*abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ*/

	                function generarID($caracteres, $Tamaño= 5)
	                {
		                    $Max = strlen($caracteres);
		                     $ID_A = '';
		                     for ($c = 0; $c < $Tamaño; $c++) {
			                 $ID_A .= $caracteres[random_int(0, $Max - 1)];
		                   }
		
		               return $ID_A;
	                }
                $ID_Usuario=(generarID($caracteres, $Tamaño= 5));
                $R_usuario=$_POST["R_usuario"];
                $R_contra=$_POST["R_contra"];
                $R_Correo=$_POST["R_correo"];
                $R_Fecha_actual = date('Y-m-d');
                $R_F_Vencida= date('Y-m-d',strtotime($R_Fecha_actual.'+ 1 month'));
                /*$sql=$conexion->query("INSERT INTO tbl_ms_usuario(ID_Usuario,ID_Rol,Nombre_Usuario,Usuario,Contraseña,Correo_Electronico,Fecha_Ultima_conexion, Preguntas_contestadas, Primer_ingreso, Fecha_vencimiento,Estado_Usuario, Creado_por, Fecha_Creacion, Modificado_por, Fecha_Modificacion) VALUES ('$ID_Usuario',3,'$R_usuario', '$R_usuario','$R_contra','$R_Correo','$R_Fecha_actual',0,0,'$R_F_Vencida','ACTIVO','$R_usuario', '$R_Fecha_actual','$R_usuario', '$R_Fecha_actual' );");
                header("location: Login.php");*/
                echo $R_F_Vencida;
            }
            
          
        }
        
        
    }
}


?>