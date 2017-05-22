<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		IdTiempoPrioridad,
		tiempo_prioridad.Nombre,
		tiempo_prioridad.TiempoHora as 'Tiempo en horas'
		FROM
		tiempo_prioridad";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>