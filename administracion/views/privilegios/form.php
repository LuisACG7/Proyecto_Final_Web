<div class="container">
    <form action="privilegio.php?action=<?php echo($action=='update')?'change&id_privilegio='.$datos['id_privilegio']:'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo($action=="update")? "Editar": "Nuevo"; ?> Privilegio</h2>
        <div class="mb-3">
            <label for="InputPrivilegio" class="form-label">Privilegio</label>
            <input type="text" class="form-control" id="InputPrivilegio" name="privilegio" required="required" value="<?php echo(isset($datos['privilegio']))? $datos['privilegio']: ''; ?>">
        </div>
  
        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>
