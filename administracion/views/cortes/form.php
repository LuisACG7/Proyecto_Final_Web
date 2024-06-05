<div class="container">
    <form action="cortes.php?action=<?php echo($action=='update')?'change&id_catalogo='.$datos['id_catalogo']:'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo($action=="update")? "Editar": "Nuevo"; ?> Catálogo de cortes</h2>
        <div class="mb-3">
            <label for="InputCorte" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="InputCorte" name="nombre" required="required" value="<?php echo(isset($datos['nombre']))? $datos['nombre']: ''; ?>">
        </div>
        <div class="mb-3">
            <label for="InputDescripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="InputDescripcion" name="descripcion" required="required" value="<?php echo(isset($datos['descripcion']))? $datos['descripcion']: ''; ?>">
        </div>
         
        <?php if($action== 'update'): ?>
        <div class="mb-3">
        <label for="InputFotografia" class="form-label">Fotografía Actual</label>
            <img src="../uploads/cortes/<?php echo $datos['fotografia'] ?>" alt="">
        </div>
        <?php endif;?>
        <div class="mb-3">
            <label for="InputFotografia" class="form-label">Fotografía</label>
            <input type="file" class="form-control" id="InputFotografia" name="fotografia" value="<?php echo(isset($datos['fotografia']))? $datos['fotografia']: ''; ?>">
        </div>

        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>
