
<?php if ( empty($_SESSION['correo']) ) : ?>

  <header>
      <div class="container-header">
          <div class="logo">
              <a href="index.php">
                  <img src="images/logo.jpg" alt="Glamour Memo's">
              </a>
          </div>

          <div class="menu">
              <nav>
                  <ul>
                      <li><a href="index.php">INICIO</a></li>
                      <li><a href="servicio.php">SERVICIOS</a></li>
                      <li><a href="catalogo.php">CATÁLOGO DE CORTES</a></li>
                      <li><a href="contacto.php">CONTACTO</a></li>
                  </ul>
              </nav>

              <a href="register.php" class="btn-quote">REGISTRATE</a>
              <div class="search-container">
                  <form action="/buscar" method="get">
                      <input type="search" placeholder="Buscar..." name="q" aria-label="Buscar">
                      <button type="submit">Buscar</button>
                  </form>
              </div>
              
          </div>
      </div>
  </header>



<?php elseif ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Cliente' )  : ?>


<?php
  if ( isset($_POST['btn_logout']) ) {

    $web->logout();
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
          <a class="nav-link active" aria-current="page" href="profile.php">Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="servicio.php">Lista Servicios</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="citas.php">Mis Citas</a>
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