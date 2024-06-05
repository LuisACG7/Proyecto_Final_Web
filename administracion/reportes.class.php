<?php
include __DIR__.'/sistema.class.php';
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


class Reportes extends Sistema{
    function servicios()
    {
        try {
            $this->connec();
            $sql = 'SELECT s.id_servicio,s.servicio,COUNT(c.id_servicio) AS cantidad_solicitudes,SUM(s.precio) AS dinero_generado
            FROM cita c JOIN servicio s ON c.id_servicio = s.id_servicio
            GROUP BY s.id_servicio
            ORDER BY dinero_generado desc;';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos=array();
            $datos=$stmt->fetchAll();
            include(__DIR__.'/views/reportes/servicios.php');
            ob_start();
            
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->writeHTML($content);
            $html2pdf->output('servicios.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
        
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }

    function marcas()
    {
        try {
            $this->connec();
            $sql = "SELECT m.id_marca, m.marca, count(p.id_producto) as productos
            from marca m join producto p on p.id_marca=m.id_marca
            group by 1,2
            order by 1;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos=array();
            $datos=$stmt->fetchAll();
            include(__DIR__.'/views/reportes/marcas.php');
            ob_start();
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->writeHTML($content);
            $html2pdf->output('marcas.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
        
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }
}
?>