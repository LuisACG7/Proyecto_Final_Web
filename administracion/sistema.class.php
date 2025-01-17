<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require __DIR__ . "/config.php";

class Sistema extends Config {
    
    var $conn;
    var $count=0;
    function connec() 
    {
        $this->conn = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD,);
    }
    
    function query($sql)
    {
        $this->connec();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $datos=array();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        return $datos;   
    }

    
    function SetCount($count)
    {
        $this->count = $count;
    }

    function GetCount()
    {
        return $this->count;
    }

    function getRol($correo)
    {
        $sql = "select r.rol from usuario u
        join usuario_rol ur on u.id_usuario = ur.id_usuario
        join rol r on ur.id_rol = r.id_rol
        where u.correo = '" .$correo. "'";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row) 
            array_push($info, $row['rol']);
        return $info;
    }

    function getPrivilegio($correo)
    {
        $sql = "select p.privilegio from usuario u
        join usuario_rol ur on u.id_usuario = ur.id_usuario
        join rol_privilegio rp on ur.id_rol = rp.id_rol
        join privilegio p on rp.id_privilegio = p.id_privilegio
        where u.correo = '" .$correo. "'";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row) 
            array_push($info, $row['privilegio']);
        return $info;
    }

    function login($correo,$contrasena)
    {
        $contrasena = md5($contrasena);
        $this->connec();
        $sql = "select *from usuario
        where correo = :correo and contrasena = :contrasena;";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stm->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
        $stm->execute();
        $datos = array();
        $result = $stm->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stm->fetchAll();
        if (isset($datos[0])){
            $roles = array();
            $roles = $this->getRol($correo);
            $privilegios = array();
            $privilegios = $this->getPrivilegio($correo);
            $_SESSION['validado'] = true;
            $_SESSION['correo'] = $correo;
            $_SESSION['roles'] = $roles;
            $_SESSION['privilegios'] = $privilegios;
            $_SESSION['id_usuario'] = $datos[0]['id_usuario'];
            return $datos[0];
        }else {
            $this->logout();
        }
        return false;
    }    


    function logout()
    {
        if(!isset($_SESSION['servicios'])){
            unset($_SESSION);
            session_destroy();
        }else{
            unset($_SESSION['validado']);
            unset($_SESSION['correo']);
            unset($_SESSION['roles']);
            unset($_SESSION['privilegios']);
        }
    }



    function checkRol($rol, $kill = false)
    {
        if(isset($_SESSION['roles'])){
            if($_SESSION['validado']) {
                if (in_array($rol, $_SESSION['roles'])){
                    return true;
                }
            }
        }
        if ($kill) {
            $this->logout();
            $this->alerta('danger','Permiso denegado');
            die;
        }
        return false;
    }

    function checkPrivilegio($privilegio, $kill = false)
    {
        if(isset($_SESSION['privilegios'])){
            if($_SESSION['validado']) {
                if (in_array($privilegio, $_SESSION['privilegios'])){
                    return true;
                }
            }
        }
        if ($kill) {
            $this->logout();
            $this->alerta('danger','Permiso denegado');
            die;
        }
        return false;
    }

    function alerta($tipo, $mensaje){
        $alerta = array();
        $alerta['tipo'] = $tipo;
        $alerta['mensaje'] = $mensaje;
        include __DIR__ . '/views/alert.php';
        return $alerta;
    }

    function reset($correo){
        if(filter_var($correo,FILTER_VALIDATE_EMAIL)){
            $this->connec();
            $sql="SELECT * from usuario where correo=:correo;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':correo', $correo,PDO::PARAM_STR);
            $stmt->execute();
            $datos=array();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            if(isset($datos[0])){
                $token1 = md5($correo.'ALeaToRio52');
                $token2 = md5($correo.date('Y-m-d H:i:s').rand(1,1000000));
                $token = $token1.$token2;
                $sql="UPDATE usuario set token=:token where correo=:correo;";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                $stmt->bindParam(':correo', $correo,PDO::PARAM_STR);
                $stmt->execute();
                $destinatario = $correo;
                $nombre_persona = 'Juanito Bananas'; 
                $asunto = 'Recuperar contraseña';
                $mensaje = " 
                Hola, se ha solicitado un cambio de contraseña para tu cuenta.</br>
                Usted puede recuperarla presionando el siguiente enlace </br>
                <a href = 'http://localhost/Estetica/administracion/login.php?action=recovery&token=".$token."'>Recuperar contraseña</a> </br>
                Muchas gracias </br>
                Ferreteria";
                if ($this->sendMail($destinatario,$nombre_persona,$asunto,$mensaje)){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }

    function recovery($token, $contrasena=null){
        $this->connec();
        if(strlen($token)==64){
            $sql="SELECT * from usuario where token=:token;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':token', $token,PDO::PARAM_STR);
            $stmt->execute();
            $datos=array();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            if(isset($datos[0])){
                if(!is_null($contrasena)){
                    $contrasena=md5($contrasena);
                    $correo=$datos[0]['correo'];
                    $sql="UPDATE usuario set contrasena=:contrasena, token=null where correo=:correo;";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
                    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                    $stmt->execute();
                }
                return true;
            }
        }
        return false;
    }

    function sendMail($destinatario,$nombre_persona,$asunto,$mensaje){
        require  __DIR__ . '/../vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = '20031609@itcelaya.edu.mx';
        $mail->Password = 'huihubvfasagncxu';
        $mail->setFrom('20031609@itcelaya.edu.mx', 'Luis Angel Cruz Guerrero');
        $mail->addAddress($destinatario, $nombre_persona);
        $mail->Subject = $asunto;
        $mail->msgHTML($mensaje);
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    function register($datos){
        if(!filter_var($datos['correo'],FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $this->connec();

        try{
            $this->conn->beginTransaction();
            $sql = 'select * from usuario where correo=:correo';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetchAll();
            if(isset($usuario[0])){
                $this->conn->rollBack();
                return false;
            }
            $sql = 'insert into usuario (correo,contrasena) values (:correo,:contrasena)';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $contrasena = $datos['contrasena'];
            $contrasena = md5($contrasena);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $stmt->execute();
            $sql = 'select * from usuario where correo = :correo';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetchAll();
            if($usuario[0]){
                $id_usuario = $usuario[0]['id_usuario'];
                $sql = 'insert into usuario_rol (id_usuario,id_rol) values (:id_usuario,2)';
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $sql = 'insert into cliente (nombre_cliente,primer_apellido,segundo_apellido,id_usuario) values (:nombre_cliente,:primer_apellido,:segundo_apellido,:id_usuario)';
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':nombre_cliente', $datos['nombre_cliente'], PDO::PARAM_STR);
                $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
                $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $sql = 'select * from cliente c join usuario u on u.id_usuario = c.id_usuario where c.id_usuario = :id_usuario;';
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $info = $stmt->fetchAll();
                if(isset($info[0])){
                    $this->conn->commit();
                    return true;
                }
                $this->conn->rollBack();
                return false;
            }else{
                $this->conn->rollBack();
                return false;        
            }
        }catch(PDOException $e){
            $this->conn->rollBack();
            return false;
        }
    }

    public function validateEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }



    function upload($carpeta)
    {
       // $permitidos = array('image/jpeg','image/png','image/gif');

        if (in_array($_FILES['fotografia']['type'], $this->__getImageType())) {
            if ($_FILES['fotografia']['size'] <= $this->__getImageSize()) {
                $n = rand(1, 1000000);
                $nombre_archivo = $n.$_FILES['fotografia']['size'].$_FILES['fotografia']['name'];
                $nombre_archivo=md5($nombre_archivo);
                $extension = explode('.', $_FILES['fotografia']['name']);
                $extension =$extension[sizeof($extension)-1];
                $nombre_archivo = $nombre_archivo.'.'.$extension;
                
                if(!file_exists('../uploads/'.$carpeta.'/'.$nombre_archivo)){
                move_uploaded_file($_FILES['fotografia']['tmp_name'], '../uploads/'.$carpeta.'/'.$nombre_archivo);
                return $nombre_archivo;
                }
            }
        }
        return false;
    }
}