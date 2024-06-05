<?php 
include (__DIR__ . '/administracion/servicio.class.php');
$web = new Servicio();
$datos = $web->getAll();
?>  
<?php require_once './partials/header.php'; ?>
<?php require_once './partials/navbar.php'; ?>

    <div class="banner">
        <img src="images/banner.jpeg" alt="Banner Glamour Memo's">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="titulo-servicios">Servicios</h1>
            </div>
        </div>
        <div class="row py-5">
            <?php foreach ($datos as $servicio) : ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="uploads/servicios/<?php echo $servicio['fotografia']; ?>"
                        alt="<?php echo $servicio['servicio']; ?>" class="card-img-top">
                        
                            <div class="card-body d-flex flex-column">
                                <h5><?php echo $servicio['servicio']; ?></h5>
                            </div>
                            <a href="servicio.php" class="btn btn-primary mt-auto"> Ver más </a>
                        
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3735.951238878891!2d-100.78705792529819!3d20.54917590407879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842cb0113d6eb263%3A0x315e6441e63f65ca!2sMexicali%204%2C%20Santa%20Rita%2C%2038035%20Celaya%2C%20Gto.!5e0!3m2!1ses-419!2smx!4v1711038624760!5m2!1ses-419!2smx" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
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
