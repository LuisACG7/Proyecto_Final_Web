<div class="container">
    <form action="cita.php?action=<?php echo($action=='update')?'change&id_cita='.$datos['id_cita']:'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo($action=="update")? "Editar": "Nuevo"; ?> Cita</h2>

        <div class="mb-3">
            <label for="InputFecha" class="form-label">Fecha de la Cita</label>
            <input type="date" class="form-control" id="InputFecha" name="fecha" required="required" value="<?php echo(isset($datos['fecha']))? $datos['fecha']: ''; ?>">
        </div>
        <div class="mb-3">
            <label for="InputHora" class="form-label">Hora de la Cita</label>
            <input type="time" class="form-control" id="InputHora" name="hora" required="required" value="<?php echo(isset($datos['hora']))? $datos['hora']: ''; ?>">
        </div>

        <div class="mb-3">
            <label for="InputNombreC" class="form-label">Nombre del Cliente</label>
            <input type="text" class="form-control" id="InputNombreC" name="nombre_cliente" required value="<?php echo isset($datos['nombre_cliente']) ? $datos['nombre_cliente'] : ''; ?>">
        </div>

        <div class="mb-3">
            <label for="InputServicio" class="form-label">Servicio Solicitado</label>
            <input type="text" class="form-control" id="InputServicio" name="servicio" required value="<?php echo isset($datos['servicio']) ? $datos['servicio'] : ''; ?>">
        </div>

        <div class="mb-3">
            <label for="InputNombreE" class="form-label">Nombre del Empleado a atender</label>
            <input type="text" class="form-control" id="InputNombreE" name="nombre_empleado" required value="<?php echo isset($datos['nombre_empleado']) ? $datos['nombre_empleado'] : ''; ?>">
        </div>

        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>
