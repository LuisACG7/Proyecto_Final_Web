<?php
include (__DIR__ . '/administracion/cortes.class.php');
$web = new Corte();
$datos = $web->getAll();
?>

<?php require_once './partials/header.php'; ?>
<?php require_once './partials/navbar.php'; ?>

    <div class="banner">
        <img src="images/CortesC.jpg" alt="Banner Glamour Memo's">
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="titulo-servicios">Catálogo de Cortes</h1>
            </div>
        </div>
        <div class="row py-5 ">
            <?php foreach ($datos as $corte) : ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="uploads/cortes/<?php echo $corte['fotografia']; ?>"
                        alt="<?php echo $corte['nombre']; ?>" class="card-img-top">
                        
                            <div class="card-body d-flex flex-column">
                                <h5><?php echo $corte['nombre']; ?></h5>
                                <h6><?php echo $corte['descripcion']; ?></h6>
                                <input type="hidden" name="id_catalogo" value="<?php echo $corte['id_catalogo']; ?>">
                            </div>
                        
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
