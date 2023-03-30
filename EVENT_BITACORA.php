<?php
class Conexion{
    public function  conectar(){
       return $conexion= new PDO('mysql:host=localhost; dbname=bd_asociacion_creo_en_ti' , 'root' , '');
    }
    
}
include("conexion_BD.php");

class EVENT_BITACORA{
    
    #atributo para insertar
    public $tabla;
    public $values;
    public $columnas;

    #atributos para editar
    public $update;
    public $set;

    #atributos de mostrar datos
    public $select;
    public $from;
    public $condition;
    public $rows;

    #atributos para eliminar
    public $deletefrom;
    #atributos para login
    public $usuario;
    public $contra;

    #atributos para registrar nuevo usuario
    public $R_usuario;
    public $R_contra;

    //===================================================================================
    //===================================================================================

    public function login(){
        
        $model = new conexion();
        $conexion = $model->conectar();
        $sql = "SELECT * FROM tbl_ms_usuario where Usuario=:usuario AND Contraseña=:contra AND Estado_Usuario ='ACTIVO'";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':usuario',$this->usuario,PDO::PARAM_STR);
        $consulta->bindParam(':contra',$this->contra,PDO::PARAM_STR);
        $consulta->execute();
        $total = $consulta->rowCount();
        if($total ==0){
            ?>

            <?php
        }else{
            $fecha = date("Y-m-d h:i:s");
            $hora = date("H:i:s");
            
            $fila = $consulta->fetch();

            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha,ID_Usuario,ID_Objeto,Accion,Descripcion) VALUES(NULL,'$fecha', '".$fila['ID_Usuario']."','".$fila['1']."','Inicio de sesion','Entro al sistema')";
            #$sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha,ID_Usuario,ID_Objeto,Accion,Descripcion) VALUES(NULL,'$fecha', '".$fila['ID_Usuario']."','".$fila['ID_Objeto']."','Inicio de secion','Entro al sistema')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();

            session_start();
            $_SESSION['IDUsuario'] = $fila['ID_Usuario'];
            ?>

        <?php
        }
    }
    
    //===================================================================================
    //===================================================================================
    public function Cerrarlogin(){
        
        $model = new conexion();
        $conexion = $model->conectar();
        $sql = "SELECT * FROM tbl_ms_usuario where Usuario=:usuario AND Contraseña=:contra AND Estado_Usuario ='ACTIVO'";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':usuario',$this->usuario,PDO::PARAM_STR);
        $consulta->bindParam(':contra',$this->contra,PDO::PARAM_STR);
        $consulta->execute();
        $total = $consulta->rowCount();
        if($total ==0){
            ?>

            <?php
        }else{
            $fecha = date("Y-m-d");
            $hora = date("H:i:s");
            
            $fila = $consulta->fetch();

            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha,ID_Usuario,ID_Objeto,Accion,Descripcion) VALUES(NULL,'$fecha', '".$fila['ID_Usuario']."','".$fila['1']."','Salida de sesion','Salio del sistema sistema')";
            #$sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha,ID_Usuario,ID_Objeto,Accion,Descripcion) VALUES(NULL,'$fecha', '".$fila['ID_Usuario']."','".$fila['ID_Objeto']."','Inicio de secion','Entro al sistema')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();

            session_start();
            $_SESSION['IDUsuario'] = $fila['ID_Usuario'];
            ?>

        <?php
        }
    }
    
    //===================================================================================
    //===================================================================================
    public function RegInsert(){
        session_start();
        $IDGlobal=$_SESSION['ID_User'];
        $_SESSION['IDUsuarioBitacora'];
            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $Accion = "Creacion de usuario";
            $IDU =  $_SESSION['IDUsuarioBitacora'];
            $Usuario = $_SESSION['UsuarioBitacora'];
            $Descripcion = "Nuevo usuario agregado: " .$Usuario;
            $fecha = date("Y-m-d h:i:s");

            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$IDGlobal', '1', 'Creacion de usuario', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        

    }
    
    //===================================================================================
    //===================================================================================
    public function RegautoInsert(){
        session_start();
        $IDGlobal=$_SESSION['ID_User'];
        $_SESSION['IDUsuarioBitacora'];
            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $Accion = "Creacion de usuario";
            $IDU =  $_SESSION['IDUsuarioBitacora'];
            $Usuario = $_SESSION['UsuarioBitacora'];
            $Descripcion = "Se autoregistro el usuario: " .$Usuario;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$IDGlobal', '1', 'creacion de usuario', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        

    }


    //===================================================================================
    //===================================================================================

    public function RegUpt(){
        session_start();
        $_SESSION['UsuarioBitacoraUP'];
        $_SESSION['IDUsuarioBitacoraUP'];
        $IDGlobal=$_SESSION['ID_User'];
            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $_SESSION['IDUsuario'] = $fila['ID_Usuario'];
            $id =  $_SESSION['IDUsuarioBitacoraUP'];
            $user = $_SESSION['UsuarioBitacoraUP'];
            $Descripcion = "Se modifico el usuario: " .$user;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$IDGlobal ', '1', 'Modificacion de usuario', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        

    }


    //===================================================================================
    //===================================================================================

    public function RegDelete(){
        session_start();
        $IDGlobal=$_SESSION['ID_User'];
            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $IDDEL= $_SESSION['IDUsuarioBitacoraDELETE'];
            $Nombre_Usuario = $_SESSION['UsuarioBitacoraDELETE'];
            $Descripcion = "Se elimino el usuario: " .$Nombre_Usuario;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', $IDGlobal, '1', 'Eliminacion de usuario', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
        
    
            
          
            ?>
    
        <?php
    
        

    }



    //===================================================================================
    //===================================================================================
        #atributos para Registrar Nuevo Usuario
        //public $R_Nombre;
        //public $R_usuario;
        //public $R_contra;
        //public $R_contra_2;
        //public $R_correo;

    public function regNuevoUser(){
        $model = new conexion();
        $conexion = $model->conectar();
        $sql = "SELECT * FROM tbl_ms_usuario where Usuario=:R_usuario AND Contraseña=:R_contra AND Estado_Usuario ='ACTIVO'";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':R_usuario',$this->R_usuario,PDO::PARAM_STR);
        $consulta->bindParam(':R_contra',$this->R_contra,PDO::PARAM_STR);
        $consulta->execute();
        $total = $consulta->rowCount();
        if($total ==0){
            ?>


            <?php
        }else{
            $fecha = date("Y-m-d h:i:s");
            $hora = date("H:i:s");
            
            $fila = $consulta->fetch();

            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha,ID_Usuario,ID_Objeto,Accion,Descripcion) VALUES(NULL,'$fecha', '".$fila['ID_Usuario']."','".$fila['1']."','Creacion de Usuario Nuevo','El usuario fue creado')";
            #$sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha,ID_Usuario,ID_Objeto,Accion,Descripcion) VALUES(NULL,'$fecha', '".$fila['ID_Usuario']."','".$fila['ID_Objeto']."','Inicio de secion','Entro al sistema')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();

            session_start();
            $_SESSION['IDUsuario'] = $fila['ID_Usuario'];
            ?>

        <?php
        }


    }
    //===================================================================================
    //===================================================================================



##Insert fondos
public function RegaInsertFondo(){
    session_start();
    $Fondo=$_SESSION['IDFondoBitacora'];
    $IDGlobal=$_SESSION['ID_User'];
        $model = new conexion();
        $conexion = $model->conectar();
        $sql = "SELECT * FROM tbl_ms_usuario";
        $consulta = $conexion->prepare($sql);
        $fila = $consulta->fetch();
        $Accion = "Creacion de usuario";

        $Usuario = $_SESSION['UsuarioBitacora'];
        $Descripcion = "Se registro el fondo: " .$Fondo;
        $fecha = date("Y-m-d h:i:s");
        $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
        VALUES (NULL,'$fecha', '$IDGlobal', '1', 'Registro de fondo', '$Descripcion')";
        $consulta2= $conexion->prepare($sql2);
        $consulta2->execute();

        
      
        ?>

    <?php

    

}

    //===================================================================================
    //===================================================================================
#Delete Fondos
public function DeleteFondo(){
    session_start();
    $IDGlobal=$_SESSION['ID_User'];
   $Fondo=$_SESSION['IDFondoBitacoraDELETE'];
        $model = new conexion();
        $conexion = $model->conectar();
        $sql = "SELECT * FROM tbl_ms_usuario";
        $consulta = $conexion->prepare($sql);
        $fila = $consulta->fetch();
        $Descripcion = "Se elimino el fondo: " .$Fondo;
        $fecha = date("Y-m-d h:i:s");
        $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
        VALUES (NULL,'$fecha', $IDGlobal, '1', 'Eliminacion de fondo', '$Descripcion')";
        $consulta2= $conexion->prepare($sql2);
        $consulta2->execute();
    

        
      
        ?>

    <?php

    

}

    //===================================================================================
    //===================================================================================
# Registro de Fondos
public function RegUptFondo(){
    session_start();
    $idfondo= $_SESSION['IDFondoBitacoraUP'];
    $IDGlobal=$_SESSION['ID_User'];
        $model = new conexion();
        $conexion = $model->conectar();
        $sql = "SELECT * FROM tbl_ms_usuario";
        $consulta = $conexion->prepare($sql);
        $fila = $consulta->fetch();
        $_SESSION['IDUsuario'] = $fila['ID_Usuario'];
        $id =  $_SESSION['IDUsuarioBitacoraUP'];
        $user = $_SESSION['UsuarioBitacoraUP'];
        $Descripcion = "Se modifico el fondo: " .$idfondo;
        $fecha = date("Y-m-d h:i:s");
        $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
        VALUES (NULL,'$fecha', '$IDGlobal ', '1', 'Modificacion de fondo', '$Descripcion')";
        $consulta2= $conexion->prepare($sql2);
        $consulta2->execute();

        
      
        ?>

    <?php

    

}

     //===================================================================================
    //===================================================================================
    #registro voluntario
    public function RegInsertvol(){
        session_start();
        $IDGlobal=$_SESSION['ID_User'];
     $voluntario=$_SESSION['nombreVolBitacora'];
            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $Accion = "Creacion de Voluntario";
            $Descripcion = "Nuevo Voluntario agregado: ".$voluntario;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$IDGlobal', '1', 'Creacion de voluntario', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        

    }
 //===================================================================================
    //===================================================================================
    #delete voluntario
    public function DeleteVol(){
        session_start();
        $IDGlobal=$_SESSION['ID_User'];
       $idvol=$_SESSION['idVolBitacoraDELETE'];
       $voldelete= $_SESSION['NombreVolBitacoraDELETE'];
            $model = new conexion();
            $conexion = $model->conectar();

            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $Descripcion = "Se elimino el Voluntario: ".$idvol;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', $IDGlobal, '1', 'Eliminacion de voluntario', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
        
    
            
          
            ?>
    
        <?php
    
        
    
    }
     //===================================================================================
    //===================================================================================
#registro pago
    public function RegInsertPago(){
        session_start();
        $IDGlobal=$_SESSION['ID_User'];
       $idpago= $_SESSION['IDpagoBitacora'];
            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $Accion = "Creacion de Pago";
            $Descripcion = "Nuevo Pago agregado: ".$idpago;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$IDGlobal', '1', 'Creacion de Pago', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        

    }

     //===================================================================================
    //===================================================================================
    #update voluntario
    public function RegUptVol(){
        session_start();

        $IDGlobal=$_SESSION['ID_User'];
       $Voluntarioup= $_SESSION['VOLBitacoraUP'];
            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            
            $Descripcion = "Se modifico el voluntario: " .$Voluntarioup;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$IDGlobal ', '1', 'Modificacion de voluntario', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        
    
    }

     //===================================================================================
    //===================================================================================
    #update pago
    public function RegUptpag(){
        session_start();

        $IDGlobal=$_SESSION['ID_User'];
       $pago= $_SESSION['pagoBitacoraUP'];
            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            
            $Descripcion = "Se modifico el pago: " .$idpago;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$IDGlobal ', '1', 'Modificacion de pago', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        
    
    }
        //===================================================================================
#delete pago
    public function DeletePago(){
        session_start();
        $IDGlobal=$_SESSION['ID_User'];
     $idpago=$_SESSION['IDPagoBitacoraDELETE'];
            $model = new conexion();
            $conexion = $model->conectar();

            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $Descripcion = "Se elimino el Pago: ".$idpago;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', $IDGlobal, '1', 'Eliminacion de Pago', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
        
    
            
          
            ?>
    
        <?php
    
        
    
    }

      //===================================================================================
    //===================================================================================
#registro donante
    public function RegInsertDon(){
        session_start();
        $IDGlobal=$_SESSION['ID_User'];
      $donante= $_SESSION['DonanteBitacora'];
      $_SESSION['IDdonanteBitacora'];
            $model = new conexion();
            $conexion = $model->conectar();

            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();

            $Descripcion = "Nuevo Donante agregado: ".$donante;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$IDGlobal', '1', 'Creacion de Donante', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        

    }

     //===================================================================================
#delete donante
     public function DeleteDon(){
        session_start();
        $IDGlobal=$_SESSION['ID_User'];
      $iddonante=  $_SESSION['IDdonanteBitacoraDELETE'];
            $model = new conexion();
            $conexion = $model->conectar();

            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $Descripcion = "Se elimino el Donante: ".$iddonante;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', $IDGlobal, '1', 'Eliminacion de Donante', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
        
    
            
          
            ?>
    
        <?php
    
        
    
    }

       //===================================================================================
    //===================================================================================
    #update donante
    public function RegUptdon(){
        session_start();

        $IDGlobal=$_SESSION['ID_User'];
        $Nombredonante=$_SESSION['donanteBitacoraUP'];
            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            
            $Descripcion = "Se modifico el donante: " .$Nombredonante;
            $fecha = date("Y-m-d h:i:s");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$IDGlobal ', '1', 'Modificacion de donante', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        
    
    }
}  
?>