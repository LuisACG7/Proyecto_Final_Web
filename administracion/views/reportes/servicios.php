<?php
$content = "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Listado de Servicios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            display: block;
            margin: 10px 0;
        }
        h1 {
            color: red;
        }
    </style>
</head>
<body>
    <img src='../images/logo.jpg' height='200' width='300' alt='logo' />
    <h1>Listado de servicios que mas generan dinero</h1>
    <p>Se encontraron " . count($datos) . " servicios</p>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Servicio</th>
                <th>Cantidad de Solicitudes</th>
                <th>Dinero Generado</th>
            </tr>
        </thead>
        <tbody>";
foreach ($datos as $dato) {
    $content .= "
        <tr>
            <td>" . $dato['id_servicio'] . "</td>
            <td>" . $dato['servicio'] . "</td>
            <td>" . $dato['cantidad_solicitudes'] . "</td>
            <td>$" . number_format($dato['dinero_generado'], 2) . "</td>
        </tr>";
}
$content .= "
        </tbody>
    </table>
</body>
</html>";
?>
