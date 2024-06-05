<?php require_once(__DIR__."/sistema.class.php"); ?>

<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Administrador' ) : ?>

<?php 

require_once __DIR__ . '/privilegio.class.php';
require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/navbar.php';

$app = new Privilegio;
$app->checkRol('Administrador', true);


$action=(isset($_GET['action']))?$_GET['action'] :null;
$id_privilegio=(isset($_GET['id_privilegio']))?$_GET['id_privilegio'] :null;
$datos=array();
$alert=array();
switch ($action){
    case 'delete':
        $fila=$app->delete($id_privilegio);
        if ($fila){
            $alert['type']="success";
            $alert['message']= "Privilegio eliminado correctamente";
        }else{
            $alert['type']="danger";
            $alert['message']= "No se pudo eliminar el privilegio ";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/privilegios/index.php');
        break;
    case 'create':
        include(__DIR__.'/views/privilegios/form.php');
        break;
    case 'save':
        $datos=$_POST;
        if ($app->insert($datos)){
            $alert['type']="success";
            $alert['message']= "Privilegio  agregado correctamente";
        }else{
            $alert['type']="danger";
            $alert['message']= "No se pudo agregar el privilegio ";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/privilegios/index.php');
        break;
    case 'change':
        $datos=$_POST;
        if ($app->update($id_privilegio,$datos)){
            $alert['type']="success";
            $alert['message']= "Privilegio actualizado correctamente";
        }else{
            $alert['type']="danger";
            $alert['message']= "No se pudo actualizar el privilegio ";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/privilegios/index.php');
        break;
    case 'update':
        $datos=$app->getOne($id_privilegio);
        if (isset ($datos['id_privilegio'])) {
            include(__DIR__.'/views/privilegios/form.php');
        } else{
            $alert['type']= 'danger';
            $alert['message']= 'No existe el Privilegio  especificado';
            $datos=$app->getAll();
            include(__DIR__.'/views/alert.php');
            include(__DIR__.'/views/privilegios/index.php');
        }
        break;
    default:
    $datos=$app->getAll();
    include(__DIR__.'/views/privilegios/index.php');
}    
include(__DIR__.'/views/footer.php');
?>

<?php else : ?>
  <?php   header('Location: login.php'); ?>
<?php endif; ?>
