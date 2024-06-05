<?php require_once(__DIR__."/sistema.class.php"); ?>

<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Administrador' ) : ?>

<?php 
require_once __DIR__ . '/cortes.class.php';
require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/navbar.php';

$app = new Corte;
$app->checkRol('Administrador', true);

$action=(isset($_GET['action']))?$_GET['action'] :null;
$id_catalogo=(isset($_GET['id_catalogo']))?$_GET['id_catalogo'] :null;
$datos=array();
$alerta=array();
switch ($action){
    case 'delete':
        $fila=$app->delete($id_catalogo);
        if ($fila){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Corte eliminado correctamente del catalogo";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo eliminar el corte del catalogo";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/cortes/index.php');
        break;
    case 'create':
        include(__DIR__.'/views/cortes/form.php');
        break;
    case 'save':
        $datos=$_POST;
        $datos['fotografia']=$_FILES['fotografia']['name'];
        if ($app->insert($datos)){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Corte agregado correctamente al catalogo";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo agregar el corte al catalogo";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/cortes/index.php');
        break;
    case 'change':
        $datos=$_POST;
        if ($app->update($id_catalogo,$datos)){
            $alerta['tipo']="success";
            $alerta['mensaje']= "Corte actualizado correctamente en el catalogo";
        }else{
            $alerta['tipo']="danger";
            $alerta['mensaje']= "No se pudo actualizar el corte del catalogo";
        }
        $datos=$app->getAll();
        include(__DIR__.'/views/alert.php');
        include(__DIR__.'/views/cortes/index.php');
        break;
    case 'update':
        $datos=$app->getOne($id_catalogo);
        if (isset ($datos['id_catalogo'])) {
            include(__DIR__.'/views/cortes/form.php');
        } else{
            $alerta['tipo']= 'danger';
            $alerta['mensaje']= 'No existe el corte especificado en el catalogo';
            $datos=$app->getAll();
            include(__DIR__.'/views/alert.php');
            include(__DIR__.'/views/cortes/index.php');
        }
        break;
    default:
        $datos=$app->getAll();
    include(__DIR__.'/views/cortes/index.php');
}    

include(__DIR__.'/views/footer.php');
?>

<?php else : ?>
  <?php   header('Location: login.php'); ?>
<?php endif; ?>
