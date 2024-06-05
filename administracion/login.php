<?php
include __DIR__ . '/sistema.class.php';
$app = new Sistema();
$action=(isset($_GET['action']))?$_GET['action'] :null;
require_once __DIR__ . '/views/header.php';

switch($action) {
    case 'logout':
        $app->logout();
        $tipo = 'success';
        $mensaje = 'Sesión cerrada correctamente';
        $app->alerta($tipo, $mensaje);
        break;
    case 'login':
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $login = $app->login($correo, $contrasena);
        if (is_array($login)) {
            header('Location: index.php');
        }else {
            $tipo = 'danger';
            $mensaje = 'Usuario o contraseña incorrectos';
            $app->alerta($tipo, $mensaje);
        }
        break;
    case 'forgot':
        include __DIR__.'/views/login/forgot.php';
        break;
    case 'reset':
        $correo = $_POST['correo'];
        $reset = $app->reset($correo);
        if ($reset) {
            $tipo ='success';
            $mensaje = 'Se ha enviado un correo para recuperar la contraseña';
            $app->alerta($tipo, $mensaje);
        }else {
            $tipo = 'danger';
            $mensaje = 'No se ha podido enviar el correo';
            $app->alerta($tipo, $mensaje);
        }
        break;
    case 'recovery':
        if(isset($_GET['token'])){
            $token=$_GET['token'];
            if($app->recovery($token)){
                if(isset($_POST['contrasena'])){
                    $contrasena=$_POST['contrasena'];
                    if($app->recovery($token,$contrasena)){
                        $tipo ='success';
                        $mensaje = 'Contraseña cambiada correctamente';
                        $app->alerta($tipo, $mensaje);
                        include __DIR__. '/views/login/index.php';
                        die;
                    }else{
                        $tipo = 'danger';
                        $mensaje = 'No se ha podido cambiar la contraseña';
                        $app->alerta($tipo, $mensaje);
                        die;
                    }
                }
                include __DIR__. '/views/login/recovery.php';
                die;
            }
            $mensaje = 'Token no valido';
            $tipo = 'danger';
            $app->alerta($tipo,$mensaje);
        }
        break;
    default:
        include __DIR__. '/views/login/index.php';
        break;
}

require_once __DIR__ . '/views/footer.php';

?>