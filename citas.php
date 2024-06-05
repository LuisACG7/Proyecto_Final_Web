<?php
include (__DIR__ . '/administracion/sistema.class.php');
require_once './partials/header.php'; 
require_once './partials/navbar.php'; 
$app=new Sistema();
if(!$app->checkRol("Cliente",true)) {
    header("Location: login.php");
}
$app->connec();
$sql = "SELECT * FROM citas WHERE id_usuario = :id_usuario";
$stmt = $app->conn->prepare($sql);
$id_usuario = $_SESSION['id_usuario'];
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
include __DIR__ . '/views/index.php';
?>