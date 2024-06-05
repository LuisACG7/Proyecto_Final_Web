<div class="container">
    <form action="rol.php?action=<?php echo($action=='update')?'change&id_rol='.$datos['id_rol']:'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo($action=="update")? "Editar": "Nuevo"; ?> Rol</h2>
        <div class="mb-3">
            <label for="InputRol" class="form-label">Rol</label>
            <input type="text" class="form-control" id="InputRol" name="rol" required="required" value="<?php echo(isset($datos['rol']))? $datos['rol']: ''; ?>">
        </div>
  
        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>
