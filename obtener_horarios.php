<?php
include (__DIR__ . '/administracion/servicio.class.php');
$web = new Servicio;

if ( $_SERVER['REQUEST_METHOD'] == "POST") {

	$json = json_decode(file_get_contents('php://input'));

  if (is_object($json)) {
    $data = get_object_vars($json);
  }

  $fecha_hoy = new DateTime($data['fecha']);

  if ( $fecha_hoy->format('N') != 0 ) {
    $dia_de_semana = $fecha_hoy->format('N');
  }else {
    $dia_de_semana = 7;
  }

  $horario = $web->getHorarios($dia_de_semana);
	$array_horas = array ();


  if ( $dia_de_semana == 7 ) {

	  $inicio = $data['fecha'] . ' ' . $horario['horario_inicio'];
	 	$final = $data['fecha'] . ' ' . $horario['horario_fin'];

		$start_time    = strtotime ($inicio);
		$end_time      = strtotime ($final);

		$minutes  = intval($data['duracion']) * 60;

		while ($start_time <= $end_time) {
		  $array_horas[] = date ("H:i", $start_time);
		  $start_time += $minutes;
		}

  } else {

		$inicio_1 = $data['fecha'] . ' ' . $horario['horario_inicio'];
		$final_1 = $data['fecha'] . ' ' . $horario['horario_inicio_comida'];

		$start_time    = strtotime ($inicio_1);
		$end_time      = strtotime ($final_1);

		$minutes  = intval($data['duracion']) * 60;

		while ($start_time <= $end_time) {
		  $array_horas[] = date ("H:i", $start_time);
		  $start_time += $minutes;
		}

		array_pop($array_horas);


		$inicio_2 = $data['fecha'] . ' ' . $horario['horario_fin_comida'];
		$final_2 = $data['fecha'] . ' ' . $horario['horario_fin'];

		$start_time_2    = strtotime ($inicio_2);
		$end_time_2      = strtotime ($final_2);

		$minutes_2  = intval($data['duracion']) * 60;

		while ($start_time_2 <= $end_time_2) {
		  $array_horas[] = date ("H:i", $start_time_2);
		  $start_time_2 += $minutes_2;
		}

  }
 

  $total_citas = $web->getCitasExistentes($data['id_servicio'], $data['fecha']);

  $citas_existentes = [];

  foreach ($total_citas as $cita) {
  	$time = substr($cita['hora'],0,5);
  	array_push($citas_existentes, $time);
  }

  $citas_disponibles = [];

  foreach ($array_horas as $hora) {
  	if (!in_array($hora, $citas_existentes)) {
  		array_push($citas_disponibles, $hora);
  	}
  	
  }

	echo json_encode($citas_disponibles);

}
 ?>