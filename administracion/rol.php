<?php require_once(__DIR__."/sistema.class.php"); ?>

<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Administrador' ) : ?>

<?php 
require_once __DIR__ . '/rol.class.php';
require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/navbar.php';

$app = new Rol;
$app->checkRol('Administrador', true);


$action=(isset($_GET['action']))?$_GET['action'] :null;
$id_rol=(isset($_GET['id_rol']))?$_GET['id_rol'] :null;
$datos=array();
$alerta=array();
switch ($action){
    case 'delete':
        $fila=$app->delete($id_rol);
        if ($fila){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Rol eliminado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo eliminar el rol";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/roles/index.php');
        break;
    case 'create':
        include(__DIR__.'/views/roles/form.php');
        break;
    case 'save':
        $datos=$_POST;
        if ($app->insert($datos)){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Rol agregado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo agregar el rol";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/roles/index.php');
        break;
    case 'change':
        $datos=$_POST;
        if ($app->update($id_rol,$datos)){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Rol actualizado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo actualizar el rol";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/roles/index.php');
        break;
    case 'update':
        $datos=$app->getOne($id_rol);
        if (isset ($datos['id_rol'])) {
            include(__DIR__.'/views/roles/form.php');
        } else{
            $alerta['tipo']= 'danger';
            $alerta['mensaje']= 'No existe el rol especificado';
            $datos=$app->getAll();
            include(__DIR__.'/views/alert.php');
            include(__DIR__.'/views/roles/index.php');
        }
        break;
    default:
    $datos=$app->getAll();
    include(__DIR__.'/views/roles/index.php');
}    
include(__DIR__.'/views/footer.php');
?>

<?php else : ?>
  <?php   header('Location: login.php'); ?>
<?php endif; ?>
