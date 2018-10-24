<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "SELECT
		IdTiempoPrioridad,
		tiempo_prioridad.Nombre,
		tiempo_prioridad.TiempoHora as 'Tiempo en horas'
		FROM
		tiempo_prioridad";
	
	$lista = $run->listView($query);
	echo $lista;
 ?>