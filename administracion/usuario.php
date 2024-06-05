<?php require_once(__DIR__."/sistema.class.php"); ?>

<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Administrador' ) : ?>

<?php 
require_once __DIR__. '/usuario.class.php';
require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/navbar.php';

$app = new Usuario;
$app->checkRol('Administrador', true);

$action=(isset($_GET['action']))?$_GET['action'] :null;
$id_usuario=(isset($_GET['id_usuario']))?$_GET['id_usuario'] :null;
$datos=array();
$alerta=array();

switch ($action){
    case 'delete':
        $fila=$app->delete($id_usuario);
        if ($fila){
            $alert['type']="success";
            $alert['message']= "Usuario eliminado correctamente";
        }else{
            $alert['type']="danger";
            $alert['message']= "No se pudo eliminar el usuario";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/usuarios/index.php');
        break;
    case 'create':
        include(__DIR__.'/views/usuarios/form.php');
        break;
    case 'save':
        $datos=$_POST;
        if ($app->insert($datos)){
            $alert['type']="success";
            $alert['message']= "Usuario agregado correctamente";
        }else{
            $alert['type']="danger";
            $alert['message']= "No se pudo agregar el usuario";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/usuarios/index.php');
        break;
    case 'change':
        $datos=$_POST;
        if ($app->update($id_usuario,$datos)){
            $alert['type']="success";
            $alert['message']= "Usuario actualizado correctamente";
        }else{
            $alert['type']="danger";
            $alert['message']= "No se pudo actualizar el usuario";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/usuarios/index.php');
        break;
    case 'update':
        $datos=$app->getOne($id_usuario);
        if (isset ($datos['id_usuario'])) {
            include(__DIR__.'/views/usuarios/form.php');
        } else{
            $alert['type']= 'danger';
            $alert['message']= 'No existe el usuario especificado';
            $datos=$app->getAll();
            include(__DIR__.'/views/alert.php');
            include(__DIR__.'/views/usuarios/index.php');
        }
        break;
    default:
    $datos=$app->getAll();
    include(__DIR__.'/views/usuarios/index.php');
}    
include(__DIR__.'/views/footer.php');
?>

<?php else : ?>
  <?php   header('Location: login.php'); ?>
<?php endif; ?>
