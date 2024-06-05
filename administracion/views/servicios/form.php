<div class="container">
    <form action="servicio.php?action=<?php echo($action=='update')?'change&id_servicio='.$datos['id_servicio']:'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo($action=="update")? "Editar": "Nuevo"; ?> Servicio</h2>
        <div class="mb-3">
            <label for="Inputservicio" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="Inputservicio" name="servicio" required="required" value="<?php echo(isset($datos['servicio']))? $datos['servicio']: ''; ?>">
        </div>
        <div class="mb-3">
            <label for="InputDescripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="InputDescripcion" name="descripcion" required="required" value="<?php echo(isset($datos['descripcion']))? $datos['descripcion']: ''; ?>">
        </div>
        
        <div class="mb-3">
        <label for="InputDuracion" class="form-label">Duración</label>
        <input type="number" class="form-control" id="InputDuracion" name="duracion" required="required" value="<?php echo(isset($datos['duracion']))? $datos['duracion']: ''; ?>">
         <small class="form-text text-muted">Introduce la duración en minutos</small>
        </div>

        <div class="mb-3">
            <label for="InputPrecio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="InputPrecio" name="precio" required="required" step="0.01" value="<?php echo(isset($datos['precio']))? $datos['precio']: ''; ?>">
            <small class="form-text text-muted">Introduce el precio del servicio</small>
        </div>
         
        <?php if($action== 'update'): ?>
        <div class="mb-3">
        <label for="InputFotografia" class="form-label">Fotografía Actual</label>
            <img src="../uploads/servicios/<?php echo $datos['fotografia'] ?>" alt="">
        </div>
        <?php endif;?>
        <div class="mb-3">
            <label for="InputFotografia" class="form-label">Fotografía</label>
            <input type="file" class="form-control" id="InputFotografia" name="fotografia" value="<?php echo(isset($datos['fotografia']))? $datos['fotografia']: ''; ?>">
        </div>

        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>
