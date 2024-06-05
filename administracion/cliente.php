<?php require_once(__DIR__."/sistema.class.php"); ?>

<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Administrador' ) : ?>

<?php 
require_once __DIR__ . '/cliente.class.php';
require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/navbar.php';

$app = new Cliente;
$app->checkRol('Administrador', true);


$action=(isset($_GET['action']))?$_GET['action'] :null;
$id_cliente=(isset($_GET['id_cliente']))?$_GET['id_cliente'] :null;
$datos=array();
$alerta=array();
switch ($action){
    case 'delete':
        $fila=$app->delete($id_cliente);
        if ($fila){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Cliente eliminado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo eliminar el cliente";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/clientes/index.php');
        break;
    case 'create':
        include(__DIR__.'/views/clientes/form.php');
        break;
    case 'save':
        $datos=$_POST;
        if ($app->insert($datos)){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Cliente agregado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo agregar el cliente";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/clientes/index.php');
        break;
    case 'change':
        $datos=$_POST;
        if ($app->update($id_cliente,$datos)){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Cliente actualizado correctamente";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo actualizar el cliente";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/clientes/index.php');
        break;
    case 'update':
        $datos=$app->getOne($id_cliente);
        if (isset ($datos['id_cliente'])) {
            include(__DIR__.'/views/clientes/form.php');
        } else{
            $alerta['tipo']= 'danger';
            $alerta['mensaje']= 'No existe el cliente especificado';
            $datos=$app->getAll();
            include(__DIR__.'/views/alert.php');
            include(__DIR__.'/views/clientes/index.php');
        }
        break;
    default:
    $datos=$app->getAll();
    include(__DIR__.'/views/clientes/index.php');
}    
include(__DIR__.'/views/footer.php');
?>

<?php else : ?>
  <?php   header('Location: login.php'); ?>
<?php endif; ?>
