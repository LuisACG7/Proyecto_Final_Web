<?php
include (__DIR__ . '/administracion/sistema.class.php');
$app=new Sistema();

if(!$app->checkRol("Cliente")) {
    header("Location: login.php");
}

require_once './partials/header.php'; 
require_once './partials/navbar.php'; 

$app->connec();
$sql = "SELECT nombre_cliente, primer_apellido, segundo_apellido FROM cliente c JOIN usuario u USING (id_usuario) WHERE c.id_usuario = :id_usuario";
$stmt = $app->conn->prepare($sql);
$id_usuario = $_SESSION['id_usuario'];
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$cliente = $stmt->fetchAll();

echo "<h1>Bienvenido ". $cliente[0]['primer_apellido'] ." ".$cliente[0]['segundo_apellido'] ." ". $cliente[0]['nombre_cliente']."</h1>";
?>