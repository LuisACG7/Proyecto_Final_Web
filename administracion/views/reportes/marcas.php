<?php
$content="
        <img src=\"../uploads/marcas/default.png\" height=\"100px\" width=\"100px\" 
        alt=\"logo\" />
        <h1>Listado de Marcas</h1>
        <p>Se encontraron ".count($datos)." marcas</p>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Marca</th>
                    <th>Total productos</th>
                </tr>
            </thead>
            <tbody>";
        foreach($datos as $dato){
            $content.="
            <tr>
                <td>".$dato['id_marca']."</td>
                <td>".$dato['marca']."</td>
                <td>".$dato['productos']."</td>
            </tr>";
        }
        $content.="    
            </tbody>
        </table>";
?>