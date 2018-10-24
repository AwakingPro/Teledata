<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = 'SELECT
		tiempo_prioridad.IdTiempoPrioridad,
		tiempo_prioridad.Nombre,
		tiempo_prioridad.TiempoHora
	FROM
		tiempo_prioridad
	WHERE
		tiempo_prioridad.IdTiempoPrioridad ='.$_POST['id'];
	
	$data = $run->select($query);
	if (count($data) > 0) {
		echo json_encode($data);
	}else{
		echo 'false';
	}
 ?>