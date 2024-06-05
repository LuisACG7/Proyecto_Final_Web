<?php require_once(__DIR__."/sistema.class.php"); ?>

<?php if ( isset($_SESSION['roles']) && $_SESSION['roles'][0] == 'Administrador' ) : ?>

<?php 
require_once __DIR__ . '/views/header.php';
require_once __DIR__ . '/views/navbar.php';

$app=new Sistema;
$app->checkRol('Administrador', true);

$sql= "SELECT s.servicio,COUNT(c.id_servicio) AS numero_solicitudes
FROM cita c
JOIN servicio s ON c.id_servicio = s.id_servicio
GROUP BY s.servicio
ORDER BY numero_solicitudes DESC;";
$datos=$app->query($sql);

?>

    <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        <?php foreach($datos as $dato):?>
          ["<?php echo $dato['servicio']; ?>",<?php echo $dato['numero_solicitudes']; ?> , "#b87333"],
        <?php endforeach;?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Servicio mas solicitado",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
  <div id="barchart_values" style="width: 900px; height: 300px;"></div>



<?php include __DIR__.'/views/footer.php'; ?>

<?php else : ?>
  <?php   header('Location: login.php'); ?>
<?php endif; ?>
