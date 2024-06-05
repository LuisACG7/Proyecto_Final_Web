<div class="container">
    <form action="empleado.php?action=<?php echo($action=='update')?'change&id_empleado='.$datos['id_empleado']:'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo($action=="update")? "Editar": "Nuevo"; ?> Empleado</h2>
        <div class="mb-3">
            <label for="InputNombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="InputNombre" name="nombre_empleado" required="required" value="<?php echo(isset($datos['nombre_empleado']))? $datos['nombre_empleado']: ''; ?>">
        </div>
        <div class="mb-3">
            <label for="InputApellidoP" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" id="InputApellidoP" name="primer_apellido" required="required" value="<?php echo(isset($datos['primer_apellido']))? $datos['primer_apellido']: ''; ?>">
        </div>
        <div class="mb-3">
            <label for="InputApellidoM" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" id="InputApellidoM" name="segundo_apellido" required="required" value="<?php echo(isset($datos['segundo_apellido']))? $datos['segundo_apellido']: ''; ?>">
        </div>
        <div class="mb-3">
            <label for="InputPuesto" class="form-label">Puesto</label>
            <input type="text" class="form-control" id="InputPuesto" name="puesto" required="required" value="<?php echo(isset($datos['puesto']))? $datos['puesto']: ''; ?>">
        </div>

        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>
