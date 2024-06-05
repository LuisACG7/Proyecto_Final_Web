<?php
include __DIR__ . '/administracion/sistema.class.php';
require_once 'vendor/autoload.php';
$app=new Sistema();
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
$app->checkRol("Cliente", true);
$id_cita = $_GET['id_cita'];
$app->connec();
$sql = "SELECT * FROM citas WHERE id_usuario = :id_usuario AND id_cita = :id_cita";
$stmt = $app->conn->prepare($sql);
$id_usuario = $_SESSION['id_usuario'];
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
$stmt->execute();
$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql = "SELECT * FROM cita_detail WHERE id_cita = :id_cita";
$stmt = $app->conn->prepare($sql);
$stmt->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
$stmt->execute();
$detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);
include __DIR__ . '/views/cita.print.php';
ob_start();
$html2pdf = new Html2Pdf('P', 'USLETTER', 'es');
$html2pdf->writeHTML($content);
$html2pdf->output('citas.pdf');
?>