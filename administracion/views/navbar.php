
<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Administrador' )  : ?>

<?php
if ( isset($_POST['btn_logout']) ) {
  include (__DIR__ . '/administracion/sistema.class.php');
  $app=new Sistema();
  $app->logout();
  header('Location: index.php');
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Estética</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Catálogos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="servicio.php">Servicios</a></li>
            <li><a class="dropdown-item" href="cliente.php">Clientes</a></li>
            <li><a class="dropdown-item" href="empleado.php">Empleados</a></li>
            <li><a class="dropdown-item" href="cita.php">Citas</a></li>
            <li><a class="dropdown-item" href="cortes.php">Cortes</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Administrador
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="usuario.php">Usuarios</a></li>
            <li><a class="dropdown-item" href="rol.php">Roles</a></li>
            <li><a class="dropdown-item" href="privilegio.php">Privilegios</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <form action="" method="post">
            <button class="nav-link active" type="submit" name="btn_logout">Logout</button>
          </form>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>



<?php endif; ?>