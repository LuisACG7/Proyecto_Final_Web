<div class="container">
  <div class="row">

    <form class=" col-10 col-md-4 my-5 p-4 border mx-auto container bg-light rounded" method="post" action="login.php?action=login">
     
      <div class="text-center ">
        <h3>Inicio de Sesión</h3>
      </div>
<?php 
// echo "<pre>";
//   print_r($_SESSION);
//   print_r($_POST);
// echo "</pre>";
  // die;
 ?>
      <div class="text-center mb-3">
        <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
          width="200px" alt="profile">
      </div>

      <div class="mb-3 text-primary">
        <label for="exampleInputEmail1" class="form-label"> <i class="mx-2 fas fa-user"></i> Email </label>
        <input type="email" name="correo" class="form-control" id="exampleInputEmail1" required>
      </div>

      <div class="mb-5 text-primary">
        <label for="password" class="form-label"> <i class="mx-2 fas fa-key"></i>  Contraseña</label>
        <input type="password" name="contrasena" class="form-control" id="password" required>
      </div>

      <div class="mb-3 mx-auto d-flex justify-content-center">
        <button type="submit" name="login" class="w-100 p-2 btn btn-success ">Iniciar Sesion</button>
      </div>


      <div class="text-center mb-3">
        <a href="login.php?action=forgot" class="text-dark fw-bold"> Olvidaste tu contraseña? </a>
      </div>

    </form>

  </div>
</div>

