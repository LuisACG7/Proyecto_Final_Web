<h1>Catalogo de Cortes</h1>
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary">Regresar</button>
    <a href="cortes.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fotografía</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $dato) : ?>
            <tr>
                <th scope="row"><?php echo $dato['id_catalogo']; ?></th>
                <td><?php echo $dato['nombre']; ?></td>
                <td><?php echo $dato['descripcion']; ?></td>
                <td><?php echo $dato['fotografia'];?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="cortes.php?action=update&id_catalogo=<?php echo $dato['id_catalogo']; ?>" class="btn btn-info">Actualizar</a>
                        <a href="cortes.php?action=delete&id_catalogo=<?php echo $dato['id_catalogo']; ?>" class="btn btn-danger">Borrar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p>Se encontraron <?php echo $app->GetCount(); ?> cortes</p>
