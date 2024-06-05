<?php
header('Content-Type: application/json; charset=utf-8');
include (__DIR__ . '/servicio.class.php');
$action = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : null;
$id_producto=(isset($_GET['id_producto']))?$_GET['id_producto'] :null;


class API extends Servicio
{
    public function read()
    {
        $datos = $this->getAll();
        $datos = json_encode($datos);
        print $datos;
    }

    public function readOne($id_servicio)
    {
        $datos = $this->getone($id_servicio);
        if (isset($datos['id_producto'])) {
            $datos = json_encode($datos);
            print $datos;
        } else {
            $datos['mensaje'] = "No se ha encontrado el servicio especificado";
            $datos = json_encode($datos);
            print $datos;
        }
    }

    public function deleteOne($id_servicio)
    {
        $filas = $this->delete($id_servicio);
        if ($filas) {
            $datos['mensaje'] = "El servicio se ha eliminado";
        } else {
            $datos['mensaje'] = "No se pudo eliminar el servicio";
        }
        $datos = json_encode($datos);
        print($datos);
    }

    public function create($datos) {
        if ($this->insert($datos)) {
            $datos['mensaje'] = "El servicio se ha añadido correctamente";
            $datos = json_encode($datos);
            print($datos);
        }else {
            $datos['mensaje'] = "No se ha encontrado el servicio especificado";
            $datos = json_encode($datos);
            print $datos;
        }
    }

    function modify($id_servicio, $datos)
    {
        if ($this->update($id_servicio, $datos)) {
            $datos['mensaje'] = "Servicio modificado correctamente";
            $datos = json_encode($datos);
            print $datos;
        } else {
            $datos['mensaje'] = "No se pudo modificar el servicio";
            $datos = json_encode($datos);
            print $datos;
        }
    }
}

$app = new Api();
switch ($action) {
    case 'POST':
        $datos = array();
        $datos['servicio'] = $_POST['servicio'];
        $datos['descripcion'] = $_POST['descripcion'];
        $datos['duracion'] = $_POST['duracion'];
        $datos['precio'] = $_POST['precio'];
        $datos['id_servicio'] = $_POST['id_servicio'];
        if(isset($_GET['$id_'])){
            $id_servicio = $_GET['id_servicio'];
            $app->modify($id_servicio,$datos);
        }else{
            $app->create($datos);
        }
        break;
    case 'PUT':
        break;
    case 'DELETE':
        if (isset($_GET['id_servicio'])) {
            $app->deleteOne($id_servicio);
        }
    break;
    case 'GET':
    default:
        if (isset($_GET['id_servicio'])) {
            $app->readOne($id_servicio);
        } else {
            $app->read();
        }
    break;
}
?>