<?php
include ("../conexion_BD.php");

if(isset($_POST['btn_enviar_P'])){

    // Recupera el usuario SQL del parámetro del controlador/recupera_contra_pregunta.php
    session_start();
    $User =$_SESSION['user'];
    //Extrae las variables del formulario
    $NContra=$_POST["p_contranueva"];
    $P_Fecha_Actual = date('Y-m-j');
    

    $sql=$conexion->query("SELECT * FROM `tbl_ms_usuario` WHERE Usuario='$User' and Estado_Usuario='ACTIVO'");
    if (mysqli_num_rows($sql)==1) {

        while($row=mysqli_fetch_array($sql)){
            $idUser=$row['ID_Usuario'];
        } 
        
        //Se le permite hacer el cambio de contraseña
        //Trae el parametro de vencimiento DE CONTRASEÑA
        $sql2=$conexion->query("SELECT * FROM `tbl_ms_parametros` WHERE ID_Parametro=7");
                                        
        while($row=mysqli_fetch_array($sql2)){
            $diasV=$row['Valor'];
        }

        $P_Vencida= date("Y-m-d",strtotime($P_Fecha_Actual."+ ".$diasV." days"));

        
            $sql3=$conexion->query("UPDATE tbl_ms_usuario SET Contraseña='$NContra', Fecha_Vencimiento='$P_Vencida', Modificado_Por='$User', Fecha_Modificacion='$P_Fecha_Actual' WHERE ID_Usuario='$idUser'");
            $sql4=$conexion->query("INSERT INTO tbl_ms_hist_contraseña(ID_Usuario, Contraseña, Creado_Por, Fecha_Creacion, Modificado_Por, Fecha_Modificacion) VALUES ('$idUser','$NContra','$User','$P_Fecha_Actual','$User','$P_Fecha_Actual')");

            echo'<script>alert("Contraseña Actualizada Exitosamente")</script>';
            header("refresh:0;url=../Pantallas/Login.php");

    }else {
        echo'<script>alert("Lo sentimos a surgido un error, contactese con uno de los administradores.")</script>';
                header("refresh:0;url=../Pantallas/New_pass_preg.php");
    }

}

?>