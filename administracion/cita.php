<?php require_once(__DIR__."/sistema.class.php"); ?>

<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Administrador' ) : ?>

<?php 
require_once __DIR__ . '/cita.class.php';
require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/navbar.php';

$app = new Cita;
$app->checkRol('Administrador', true);


$action=(isset($_GET['action']))?$_GET['action'] :null;
$id_cita=(isset($_GET['id_cita']))?$_GET['id_cita'] :null;
$datos=array();
$alerta=array();
switch ($action){
    case 'delete':
        $fila=$app->delete($id_cita);
        if ($fila){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Cita eliminada correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo eliminar la cita";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/citas/index.php');
        break;
    case 'create':
        include(__DIR__.'/views/citas/form.php');
        break;
    case 'save':
        $datos=$_POST;
        if ($app->insert($datos)){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Cita agregada correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo agregar la cita";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/citas/index.php');
        break;
    case 'change':
        $datos=$_POST;
        if ($app->update($id_cita,$datos)){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Cita actualizada correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo actualizar la cita";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/citas/index.php');
        break;
    case 'update':
        $datos=$app->getOne($id_cita);
        if (isset ($datos['id_cita'])) {
            include(__DIR__.'/views/citas/form.php');
        } else{
            $alerta['tipo']= 'danger';
            $alerta['mensaje']= 'No existe la cita especificada';
            $datos=$app->getAll();
            include(__DIR__.'/views/alert.php');
            include(__DIR__.'/views/citas/index.php');
        }
        break;
    default:
    $datos=$app->getAll();
    include(__DIR__.'/views/citas/index.php');
}    
include(__DIR__.'/views/footer.php');
?>

<?php else : ?>
  <?php   header('Location: login.php'); ?>
<?php endif; ?>
