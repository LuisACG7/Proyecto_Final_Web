<?php require_once(__DIR__."/sistema.class.php"); ?>

<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Administrador' ) : ?>

<?php 
require_once __DIR__ . '/servicio.class.php';
require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/navbar.php';

$app = new Servicio;
$app->checkRol('Administrador', true);

$action=(isset($_GET['action']))?$_GET['action'] :null;
$id_servicio=(isset($_GET['id_servicio']))?$_GET['id_servicio'] :null;
$datos=array();
$alerta=array();
switch ($action){
    case 'delete':
        $fila=$app->delete($id_servicio);
        if ($fila){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Servicio eliminado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo eliminar el servicio";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/servicios/index.php');
        break;
    case 'create':
        include(__DIR__.'/views/servicios/form.php');
        break;
    case 'save':
        $datos=$_POST;
        $datos['fotografia']=$_FILES['fotografia']['name'];
        if ($app->insert($datos)){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Servicio agregado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo agregar el servicio";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/servicios/index.php');
        break;
    case 'change':
        $datos=$_POST;
        if ($app->update($id_servicio,$datos)){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Servicio actualizado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo actualizar el servicio";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/servicios/index.php');
        break;
    case 'update':
        $datos=$app->getOne($id_servicio);
        if (isset ($datos['id_servicio'])) {
            include(__DIR__.'/views/servicios/form.php');
        } else{
            $alerta['tipo']= 'danger';
            $alerta['mensaje']= 'No existe el servicio especificado';
            $datos=$app->getAll();
            include(__DIR__.'/views/alert.php');
            include(__DIR__.'/views/servicios/index.php');
        }
        break;
    default:
        $datos=$app->getAll();
    include(__DIR__.'/views/servicios/index.php');
}    

include(__DIR__.'/views/footer.php');
?>

<?php else : ?>
  <?php   header('Location: login.php'); ?>
<?php endif; ?>
