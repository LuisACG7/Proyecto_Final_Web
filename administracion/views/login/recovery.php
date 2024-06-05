<div class="container">
  <div class="row">


    <form action="login.php?action=recovery&token=<?php echo $token; ?>" method="post">
      <h1>Establece tu nueva contraseña</h1>
      <!-- Password input -->
      <div class="form-outline mb-4">
        <input type="password" id="form2Example2" class="form-control"  name="contrasena"/>
        <label class="form-label" for="form2Example2">Password</label>
      </div>

      <!-- Submit button -->
      <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>

    </form>

  </div>
</div>
