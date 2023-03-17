<?php

include ("../conexion_BD.php");

if (!empty($_POST["btn_enviar_New_Contra"])) {
    session_start();

    $contra_actual=$_POST['contrasena_actual'];
    $contra_new=$_POST['contrasena_nueva'];
    $contra_confir_new=$_POST['confirmar_contrasena'];
    //Extrae las fechas
    $Fecha_Actual = date('Y-m-d');

    
    //Consulta a la base de datos, con la contraseña proporcionada y verifica si el estado es activo
    $sql=$conexion->query("SELECT * FROM `tbl_ms_usuario` WHERE Contraseña='$contra_actual' and Estado_Usuario='ACTIVO'");
    if (mysqli_num_rows($sql) ==1) {
        while($row=mysqli_fetch_array($sql)){
            $idUser=$row['ID_Usuario'];
            $User=$row['Usuario'];
            $Contraseña=$row['Contraseña'];
            $Fecha_Vencimiento=$row['Fecha_Vencimiento'];
        }  
          
            //Valida si la fecha del sistema es la igual o mayor a la fecha de vencimiento,
            //El usuario se bloque
            if ($Fecha_Vencimiento == $Fecha_Actual or $Fecha_Vencimiento < $Fecha_Actual) {
                echo'<script>alert("Lo sentimos tu contraseña a expirado. Por favor contactese con uno de los administradores")</script>';
                header("refresh:0;url=../Pantallas/Nueva_Contra.php");
                //echo '<div class="alert_danger">Lo sentimos tu contraseña a expirado, por favor contactese con uno de los administradores </div>';
                
                //Se le bloquea el usuario
                $sql1=$conexion->query("UPDATE tbl_ms_usuario SET Estado_Usuario='BlOQUEADO', Fecha_Modificacion='$Fecha_Actual' WHERE ID_Usuario='$idUser'");
                
              } else if ($Fecha_Vencimiento > $Fecha_Actual) {
    
                    //Se le permite hacer el cambio de contraseña
                        //Trae el parametro de vencimiento DE CONTRASEÑA
                        $sql2=$conexion->query("SELECT * FROM `tbl_ms_parametros` WHERE ID_Parametro=7");
                                        
                        while($row=mysqli_fetch_array($sql2)){
                            $diasV=$row['Valor'];
                        }

                        $F_Vencida= date("Y-m-d",strtotime($Fecha_Actual."+ ".$diasV." days"));
                        

                        if (strlen($contra_new) < 8 || !preg_match('/[a-z]/', $contra_new) || !preg_match('/[A-Z]/', $contra_new) || !preg_match('/[0-9]/', $contra_new) ) {
                            echo'<script>alert("Contraseña poco segura. Debe contener al menos 8 caracteres , 1 numero, 1 Mayuscula y 1 minuscula")</script>';
                            header("refresh:0;url=../Pantallas/Nueva_Contra.php");
                            //echo '<div class="alert_danger">Contraseña poco segura. Debe contener al menos 8 caracteres , 1 numero, 1 Mayuscula y 1 minuscula</div>';
        
    
                        }else {
                            if ($_POST['contrasena_nueva'] === $_POST['confirmar_contrasena']) {
                                $sql3=$conexion->query("UPDATE tbl_ms_usuario SET Contraseña='$contra_new', Fecha_Vencimiento='$F_Vencida', Modificado_Por='$User', Fecha_Modificacion='$Fecha_Actual' WHERE ID_Usuario='$idUser'");
                                $sql4=$conexion->query(" INSERT INTO `tbl_ms_hist_contraseña`(`ID_Usuario`, `Contraseña`, `Creado_Por`, `Fecha_Creacion`) VALUES ('$idUser','$contra_new','$User','$Fecha_Actual')");
                                echo'<script>alert("Su contraseña se ha actualizado exitosamente")</script>';
                                header("refresh:0;url=../Pantallas/Login.php");
    
                            }else {
                                echo'<script>alert("La contraseñas no coinciden")</script>';
                                header("refresh:0;url=../Pantallas/Nueva_Contra.php");
                            }
                         }
                    }
                                       
                        
        
    }else {
        echo'<script>alert("Lo sentimos, Ha surgido un error. Por favor contactese con uno de los administradores")</script>';
        header("refresh:0;url=../Pantallas/Nueva_Contra.php");
    } 

}




?>