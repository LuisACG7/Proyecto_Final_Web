<h1>Citas</h1>
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary">Regresar</button>
    <a href="cita.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Cliente</th>
            <th scope="col">Servicio</th>
            <th scope="col">Empleado</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $dato) : ?>
            <tr>
                <th scope="row"><?php echo $dato['id_cita']; ?></th>
                <td><?php echo $dato['fecha']; ?></td>
                <td><?php echo $dato['hora']; ?></td>
                <td><?php echo $dato['nombre_cliente']; ?></td>
                <td><?php echo $dato['servicio']; ?></td>
                <td><?php echo $dato['nombre_empleado']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="cita.php?action=update&id_cita=<?php echo $dato['id_cita']; ?>" class="btn btn-info">Actualizar</a>
                        <a href="cita.php?action=delete&id_cita=<?php echo $dato['id_cita']; ?>" class="btn btn-danger">Borrar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p>Se encontraron <?php echo $app->GetCount(); ?> citas</p>
