<div class="container">
    <form action="usuario.php?action=<?php echo($action=='update')?'change&id_usuario='.$datos['id_usuario']:'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo($action=="update")? "Editar": "Nuevo"; ?> Usuario</h2>

        <div class="mb-3">
            <label for="InputUsuario" class="form-label">Correo</label>
            <input type="email" class="form-control" id="InputUsuario" name="correo" required="required" value="<?php echo(isset($datos['correo']))? $datos['correo']: ''; ?>">
        </div>

        <div class="mb-3">
            <label for="InputContraseña" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="InputContraseña" name="contrasena" required="required" value="<?php echo(isset($datos['contrasena']))? $datos['contrasena']: ''; ?>">
        </div>
  
        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>
