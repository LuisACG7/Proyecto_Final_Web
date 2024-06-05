<?php $pagina_anterior = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''; ?>
<div class="container">
    <h1>Mis Citas</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="<?php echo $pagina_anterior; ?>" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th style="max-width: 250px; width: 200px;">Número de cita</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Servicio</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $cita):?>
                <tr>
                    <td><?php echo $cita['id_cita']; ?></td>
                    <td><?php echo $cita['fecha'];?></td>
                    <td><?php echo $cita['hora'];?></td>
                    <td><?php echo $cita['servicio'];?></td>
                    
                    <td>
                        <div class="btn-group" role="group">
                            <a href="" class="btn btn-primary">Ver detalles</a>
                            <a href="citas.print.php?id_cita=<?php echo $cita['id_cita']; ?>" target="_blank" class="btn btn-warning">Imprimir</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>