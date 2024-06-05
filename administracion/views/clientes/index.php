<h1>Clientes</h1>
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary">Regresar</button>
    <a href="cliente.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido Paterno</th>
            <th scope="col">Apellido Materno</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $dato) : ?>
            <tr>
                <th scope="row"><?php echo $dato['id_cliente']; ?></th>
                <td><?php echo $dato['nombre_cliente']; ?></td>
                <td><?php echo $dato['primer_apellido']; ?></td>
                <td><?php echo $dato['segundo_apellido']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="cliente.php?action=update&id_cliente=<?php echo $dato['id_cliente']; ?>" class="btn btn-info">Actualizar</a>
                        <a href="cliente.php?action=delete&id_cliente=<?php echo $dato['id_cliente']; ?>" class="btn btn-danger">Borrar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p>Se encontraron <?php echo $app->GetCount(); ?> clientes</p>
