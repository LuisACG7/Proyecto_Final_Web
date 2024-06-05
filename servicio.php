<?php
include (__DIR__ . '/administracion/servicio.class.php');
$web = new Servicio();
$datos = $web->getAll();
?>

<?php require_once './partials/header.php'; ?>
<?php require_once './partials/navbar.php'; ?>

    <div class="banner">
        <img src="images/servicios.jpg" alt="Banner Glamour Memo's">
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="titulo-servicios">Servicios</h1>
            </div>
        </div>
        <div class="row py-5 ">
            <?php foreach ($datos as $servicio) : ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="uploads/servicios/<?php echo $servicio['fotografia']; ?>"
                        alt="<?php echo $servicio['servicio']; ?>" class="card-img-top">
                        
                            <div class="card-body d-flex flex-column">
                                <h5><?php echo $servicio['servicio']; ?></h5>
                                <h6><?php echo $servicio['descripcion']; ?></h6>
                                <h6>Duración del Servicio: <?php echo $servicio['duracion']; ?> Minutos</h6>
                                <p class="badge">Costo del Servicio: <?php echo $servicio['precio']; ?> MXN</p>
                                <input type="hidden" name="id_servicio" value="<?php echo $servicio['id_servicio']; ?>">
                            </div>
                            <a href="detalles.php?id_servicio=<?php echo $servicio['id_servicio']; ?>" class="btn btn-primary mt-auto"> Agregar </a>
                        
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <footer class="footer">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <h2>Contacto</h2>
              <p>Teléfono: TEL. 461 415 6124</p>
              <p>Dirección: Mexicali 4, Santa Rita, 38035 Celaya, Gto.</p>
            </div>
      
            <div class="col-md-4">
              <h5>Horario de Atención</h5>
              <p>Lunes a Sábado: 11:00 AM a 8:00PM</p>
              <p>Domingo: 10:00 AM a 2:00PM</p>
            </div>
      
            <div class="col-md-4">
              <h5>Enlaces Rápidos</h5>
              <ul class="list-unstyled">
              <li><a href="servicio.php">SERVICIOS</a></li>
                <li><a href="catalogo.php">CATÁLOGO DE CORTES</a></li>
                <li><a href="register.php">REGISTRATE</a></li>
                <li><a href="contacto.php">CONTACTO</a></li>
              </ul>
            </div>
          </div>
    
          <div class="copy-right">
            <p>&copy; 2024 Glamour Memo's. Todos los derechos reservados.</p>
          </div>
        </div>
      </footer>
<?php require_once './partials/footer.php'; ?>
