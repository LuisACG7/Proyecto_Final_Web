<?php
$content = "
<style>
    h2 {
        color: blue;
    }
    .bold {
        font-weight: bold;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<img src=\"../images/logo.jpg\" height=\"200\" width=\"200\" alt=\"logo\" />
<h2>Glamour Memo's</h2>
<h3>{$datos[0]['nombre_cliente']} {$datos[0]['primer_apellido']} {$datos[0]['segundo_apellido']}</h3>
<p class=\"bold\">Fecha en la que se realizo la cita: {$datos[0]['fecha']}</p>
<p class=\"bold\">Hora en la que se realizo la cita: {$datos[0]['hora']}</p>
<table>
    <thead>
        <tr>
            <th>No. Cita</th>
            <th>Servicio</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>";
foreach ($detalles as $detalle) :
$content .= "
        <tr>
            <td>{$detalle['id_cita']}</td>
            <td>{$detalle['servicio']}</td>
            <td>{$detalle['precio']}</td>
        </tr>";
endforeach;
$content .= "
    </tbody>
</table>";

echo $content;
?>
