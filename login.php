<?php
include (__DIR__ . '/administracion/sistema.class.php');
$datos=$_POST;
$app=new Sistema;

  if ( $_SERVER['REQUEST_METHOD'] == 'POST') {

    if($app->validateEmail($datos['correo'])){
        if($app->login($datos['correo'],$datos['contrasena'])){
            header("Location: profile.php");
        }else{
            header("Location: login.php");
        }
    }else{
        header("Location: login.php");
    }
  }
?>

<?php require_once './partials/header.php'; ?>


<div class="container">
  <div class="row">

    <form class=" col-10 col-md-4 my-5 p-4 border mx-auto container bg-light rounded" method="post" action="#">
     
      <div class="text-center ">
        <h3>Inicio de Sesión</h3>
      </div>

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
        <span class="form-text ">No estas registrado? </span> 
        <a href="register.php" class="text-dark fw-bold"> Crea una cuenta</a>
      </div>

      <div class="text-center mb-3">
        <a href="login.php?action=forgot" class="text-dark fw-bold"> Olvidaste tu contraseña? </a>
      </div>

    </form>

  </div>
</div>

<?php require_once './partials/footer.php'; ?>
