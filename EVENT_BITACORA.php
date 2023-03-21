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

    #metodo insertar
    public function insertar(){
        $model = new conexion;
        $conexion = $model->conectar();
        $tabla = $this->tabla;
        $values = $this->values;
        $columnas = $this->columnas;

        $sql = "INSERT INTO $tabla ($columnas) VALUES $values ";

        $consulta = $conexion->prepare(sql);

        if(! $consulta){

            ?>
            <script>    
                alert("error en la consulta");
            </script>
            <?php
        }else{
            $consulta->execute();
        }
    }
    #terminar metodo insertar


    #metodo editar
    public function editar(){
        $model = new Conexion;
        $conexion = $model-> conectar();
            $update = $this->update;
            $set = $this->set;
            $condition = $this->condition;

            if($condition !=""){
                $condition = "WHERE ".$condition;

            }
            $sql = "UPDATE $update SET $set $condition";

            $consulta = $conexion->prepare($sql);
                    if(! $condition){

                        ?>
    <script>
        alert("error en la consulta");
    </script> 

    <?php
            
            
                    }else{
                        $consulta -> execute();
                    }
    }
    #termina metodo editar


    #metodo eliminar
    public function eliminar(){

        $model = new Conexion;
        $conexion = $model ->conectar();
        $deletefrom = $this->deletefrom;
        $condition = $this-> condition;
            if($condition !=""){

                $condition = "WHERE ".$condition;
            }

            $sql = "DELETE FROM $deletefrom $condition";
            $consulta = $conexion-> prepare(sql);
                    if(! $consulta){
                        ?>
            <script>
                alert("error en la consulta")
            </script>
            <?php
                    }else{
                        $consulta-> execute();
                    }
    }
        #terminar el metodo eliminar


        #metodo leer
        public function leer(){
            $model = new Conexion;
            $conexion = $model->conectar();

            $select = $this-> select;
            $from = $this->from;
            $condition = $this->condition;
            $rows = $this->rows;
                if($condition !=""){
            $condition = "WHERE ".$condition;
        }

        $sql = "SELECT $select FROM $from $condition";
        $consulta = $conexion-> prepare($sql);
        $consulta->execute();

        while($filas = $consulta->fetch()){
            $this->rows[] = $filas;
        }
    }
    #termina metodo leer


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
            $fecha = date("Y-m-d");
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
    public function RegInsert(){
        session_start();
        
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
            $fecha = date("Y-m-d");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$IDU', '1', 'Creacion de usuario', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        

    }



    public function RegUpt(){
        session_start();
        $_SESSION['UsuarioBitacoraUP'];
        $_SESSION['IDUsuarioBitacoraUP'];
       
            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $_SESSION['IDUsuario'] = $fila['ID_Usuario'];
            $id =  $_SESSION['IDUsuarioBitacoraUP'];
            $user = $_SESSION['UsuarioBitacoraUP'];
            $Descripcion = "Se modifico el usuario: " .$user;
            $fecha = date("Y-m-d");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', '$id ', '1', 'Modificacion de usuario', '$Descripcion')";
            $consulta2= $conexion->prepare($sql2);
            $consulta2->execute();
    
            
          
            ?>
    
        <?php
    
        

    }



    public function RegDelete(){
        session_start();

            $model = new conexion();
            $conexion = $model->conectar();
            $sql = "SELECT * FROM tbl_ms_usuario";
            $consulta = $conexion->prepare($sql);
            $fila = $consulta->fetch();
            $IDDEL= $_SESSION['IDUsuarioBitacoraDELETE'];
            $Nombre_Usuario = $_SESSION['UsuarioBitacoraDELETE'];
            $Descripcion = "Se elimino el usuario: " .$Nombre_Usuario;
            $fecha = date("Y-m-d");
            $sql2 = "INSERT INTO tbl_ms_bitacora(ID_Bitacora,Fecha, ID_Usuario, ID_Objeto, Accion, Descripcion) 
            VALUES (NULL,'$fecha', $IDDEL, '1', 'Eliminacion de usuario', '$Descripcion')";
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
            $fecha = date("Y-m-d");
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
}  
?>