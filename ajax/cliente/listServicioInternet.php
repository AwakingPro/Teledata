<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		servicio_internet.IdServInternet,
		servicio_internet.Velocidad,
		servicio_internet.Plan
		FROM
		servicio_internet
		WHERE
		IdServicio = ".$_POST['id'];
	$run = new Method;
	$lista = $run->listViewDelete($query,$_POST['id'],1);
	echo $lista;
 ?>