<?php require_once(__DIR__."/sistema.class.php"); ?>

<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Administrador' ) : ?>

<?php 
require_once __DIR__ . '/empleado.class.php';
require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/navbar.php';


$app = new Empleado;
$app->checkRol('Administrador', true);


$action=(isset($_GET['action']))?$_GET['action'] :null;
$id_empleado=(isset($_GET['id_empleado']))?$_GET['id_empleado'] :null;
$datos=array();
$alerta=array();
switch ($action){
    case 'delete':
        $fila=$app->delete($id_empleado);
        if ($fila){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Empleado eliminado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo eliminar el empleado";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/empleados/index.php');
        break;
    case 'create':
        include(__DIR__.'/views/empleados/form.php');
        break;
    case 'save':
        $datos=$_POST;
        $fila=$app->insert($datos);
        if ($fila){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Empleado agregado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo agregar el empleado";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/empleados/index.php');
        break;
    case 'change':
        $datos=$_POST;
        $fila=$app->update($id_empleado,$datos);
        if ($fila){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Empleado actualizado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo actualizar el empleado";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/empleados/index.php');
        break;
    case 'update':
        $datos=$app->getOne($id_empleado);
        if (isset ($datos['id_empleado'])) {
            include(__DIR__.'/views/empleados/form.php');
        } else{
            $alerta['tipo']= 'danger';
            $alerta['mensaje']= 'No existe el empleado especificado';
            $datos=$app->getAll();
            include(__DIR__.'/views/alert.php');
            include(__DIR__.'/views/empleados/index.php');
        }
        break;
    default:
        $datos=$app->getAll();
        include(__DIR__.'/views/empleados/index.php');
}    
include(__DIR__.'/views/footer.php');
?>

<?php else : ?>
  <?php   header('Location: login.php'); ?>
<?php endif; ?>
