<h1>Servicios</h1>
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary">Regresar</button>
    <a href="servicio.php?action=create" class="btn btn-success">Nuevo</a>
    <a href="reportes.php?action=servicios" target="_blank" class="btn btn-warning">Reporte</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Duración</th>
            <th scope="col">Precio</th>
            <th scope="col">Fotografía</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $dato) : ?>
            <tr>
                <th scope="row"><?php echo $dato['id_servicio']; ?></th>
                <td><?php echo $dato['servicio']; ?></td>
                <td><?php echo $dato['descripcion']; ?></td>
                <td><?php echo $dato['duracion']; ?></td>
                <td><?php echo $dato['precio']; ?></td>
                <td><?php echo $dato['fotografia'];?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="servicio.php?action=update&id_servicio=<?php echo $dato['id_servicio']; ?>" class="btn btn-info">Actualizar</a>
                        <a href="servicio.php?action=delete&id_servicio=<?php echo $dato['id_servicio']; ?>" class="btn btn-danger">Borrar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p>Se encontraron <?php echo $app->GetCount(); ?> servicios</p>
