<h1>Empleados</h1>
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary">Regresar</button>
    <a href="empleado.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido Paterno</th>
            <th scope="col">Apellido Materno</th>
            <th scope="col">Puesto</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $dato) : ?>
            <tr>
                <th scope="row"><?php echo $dato['id_empleado']; ?></th>
                <td><?php echo $dato['nombre_empleado']; ?></td>
                <td><?php echo $dato['primer_apellido']; ?></td>
                <td><?php echo $dato['segundo_apellido']; ?></td>
                <td><?php echo $dato['puesto']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="empleado.php?action=update&id_empleado=<?php echo $dato['id_empleado']; ?>" class="btn btn-info">Actualizar</a>
                        <a href="empleado.php?action=delete&id_empleado=<?php echo $dato['id_empleado']; ?>" class="btn btn-danger">Borrar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p>Se encontraron <?php echo $app->GetCount(); ?> empleados</p>
