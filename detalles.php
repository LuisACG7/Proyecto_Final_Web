
<?php
include (__DIR__ . '/administracion/servicio.class.php');

$carrito = array();
if (isset($_SESSION['servicios'])) {
    $carrito = $_SESSION['servicios'];
}

$web = new Servicio;
$total = 0;

    if ( isset($_GET['id_servicio']) ) {
        $dato = $web->getOne($_GET['id_servicio']);

        $comentarios = $web->getComentarios($_GET['id_servicio']);

        if ( is_array($comentarios)) {
            $total_comentarios = count($comentarios);
        } else {
            $total_comentarios = 0;
        }

    } else {
        header("Location: index.php");
    }

if ( isset($_POST['btn_enviar'])) {


    if($web->crearCita($_POST)){
        header("Location: servicio.php");
        
    }else{

    }
}

if ( isset($_POST['btn_comentario'])) {

 
    if($web->crearComentario($_POST)){
        $id = $_POST['id_servicio'];
        header("Location: detalles.php?id_servicio=$id");
        
    }else{
        
    }

}
?>

<?php require_once './partials/header.php'; ?>
<?php require_once './partials/navbar.php'; ?>


<div class="container  ">
  <div class="row py-5">

    <div class="card rounded-3 py-5">
        <div class="card-body p-4 ">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-2 col-lg-2 col-xl-2">
                    <img src="uploads/servicios/<?php echo $dato['fotografia']; ?>"
                         class="img-fluid rounded-3">
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3">
                    <p class="lead fw-normal mb-2"><?php echo $dato['servicio'];?></p>
                    <p><span class="text-muted">Descripción: </span><?php echo $dato['descripcion'];?></p>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                    <p><span class="text-muted">Duracion: </span><?php echo $dato['duracion'];?> min. </p>

                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                    <h5 class="mb-5"><?php echo $dato['precio']; ?> MXN</h5>
                    <?php if ( empty($_SESSION['roles'])  )  : ?>
                    <p class="mb-2"> Para agendar debes : </p>
                    <a href="login.php" class="w-100 p-2 btn btn-success "> Iniciar Sesion </a>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>



<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Cliente' )  : ?>


<div class="container py-5 ">
  <div class="row">

    <div class=" col-10 col-md-auto p-4 border mx-auto container bg-light rounded" method="post" action="#">
        <div class="text-center mb-4">
        <h3>Seleccionar Fecha : </h3>
        </div>

        <input type="date" id="dia_selector" class="form-control mb-4">
        <button id="obtener_horarios" class="w-100 p-2 btn btn-success "> Ver horarios disponibles </button>

    </div>



    <div id="lista_horarios" class="row gx-5 col-10 col-md-6 p-4 row-cols-1 row-cols-md-4  bg-light rounded border " > </div>

    <div class=" col-10 col-md-2 p-4 border mx-auto container bg-light rounded" method="post" action="#">
        <div class="text-center mb-4">
        <h3> Finalizar </h3>
        </div>

        <form  method="post" action="#">
            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
            <input type="hidden" name="id_servicio" value="<?php echo $dato['id_servicio'] ?>">


            <!-- id_empleado puede estar directo en tabla servicio o puede ser seleccionado desde el formulario detalles.php 
            <input type="hidden" name="id_empleado" value="1">
        -->


            <input type="hidden" name="hora" id="hora">
            <input type="hidden" name="fecha" id="fecha" >
            <input type="hidden" name="estado" value="pendiente" >

          <div class="mb-3 mx-auto d-flex justify-content-center">
            <button type="submit" id="btn_enviar" name="btn_enviar" class="w-100 p-2 btn btn-success " disabled >Confirmar Cita</button>
          </div>

        </form>

    </div>

  </div>
</div>

<?php endif; ?>


<div class="container py-5 ">
    <div class="row">

    <div class=" col-10 col-md-10 p-4 border mx-auto container bg-light rounded" method="post" action="#">
        <div class="text-center mb-4">
        <h3>Comentarios ( <?php echo $total_comentarios; ?> ): </h3>
        </div>

        <?php if ( $total_comentarios > 0) :?>
        <div class="col-8 mb-3">
            <?php foreach ($comentarios as $comentario) : ?>
                <div class="col-8 p-3 border rounded bg-white mb-3 ">
                  <h5 class="fw-bold"><?php echo $comentario['nombre_cliente']; ?></h6>
                  <p  style="font-size: 0.86rem" ><?php echo $comentario['createdAt']; ?></p>
                  <h6 class="px-3"><?php echo $comentario['comentario']; ?></h6>
                </div>

            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <div class="col-8 mb-3">

            <h3>No hay comentarios. </h3>
        </div>
            
        <?php endif; ?>


        <?php if ( empty($_SESSION['roles'])  )  : ?>
        <div class="col-4 mb-3">
        <p class="mb-2"> Para Comentar debes : </p>
        <a href="login.php" class="w-100 p-2 btn btn-success "> Iniciar Sesion </a>
        </div>
        <?php else : ?>

        <form  method="post" action="#" class=" col-8 mb-4 p-4">
         <div class="col-4 mb-3">
        <p class="mb-2"> Escribe un Comentario : </p>

        </div>
        <div class="mb-3 " >
            <textarea name="comentario" id="comentario" class="form-control" cols="30" rows="10"></textarea>
        </div>

            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
            <input type="hidden" name="id_servicio" value="<?php echo $dato['id_servicio'] ?>">

          <div class="mb-3 mx-auto d-flex justify-content-center">
            <button type="submit" id="btn_comentario" name="btn_comentario" class="w-75 p-2 btn btn-success "  > Enviar</button>
          </div>

        </form>

        <?php endif; ?>

    </div>

    </div>
</div>



<script>
    const date = document.querySelector('#dia_selector')
    date?.addEventListener('change', (e) => {
    })


    let lista = document.querySelector('#lista_horarios');


    let fecha = document.querySelector('#fecha');
    let hora  = document.querySelector('#hora');
    let btn_enviar  = document.querySelector('#btn_enviar');



    const btn_horarios = document.querySelector('#obtener_horarios')
    btn_horarios?.addEventListener('click', () => {
        if ( date.value != '' ) {

            let formData = {
              "fecha" : date.value,
              "duracion" : "<?php echo $dato['duracion'];?>",
              "id_servicio" : "<?php echo $dato['id_servicio'] ?>",
            };


            $.ajax({
              url: 'obtener_horarios.php',
              type: 'POST',
              data: JSON.stringify(formData),
              error: error => {
                console.log(error.responseText)
              },
              success: response => {
                let horas = JSON.parse(response)
                console.log(horas)

                horas.pop();

                let html = '';

                if ( horas.length > 0 ) {
                  horas.forEach( horario => {
                    html += `
                        <div class="col-6">
                          <button class=" btn_hora btn btn-info" value="${horario}"> <i class="fas fa-clock"></i> ${horario} </button>
                        </div>
                        `;
                  })


                 lista.innerHTML = html;
                 setBtnHora();

                } else {
                  html = '<div class="col-12"> <h3>No hay horarios disponibles.</h3> </div>';
                    lista.innerHTML = html;
                }
              }
            })

        }
 
    })


const setBtnHora = () => {
    let allBtn = document.querySelectorAll('.btn_hora')
    allBtn?.forEach( btn => {
        btn.addEventListener('click', (e) => {
            btn_enviar.disabled = false;
            hora.value = e.target.value;
            fecha.value = date.value;

            console.log(hora.value, fecha.value )
        })
    })
}

</script>
<?php require_once './partials/footer.php'; ?>
