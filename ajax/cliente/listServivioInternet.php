<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		servicio_internet.IdServInternet,
		servicio_internet.MacRouter,
		servicio_internet.MacAntena,
		servicio_internet.IPRouter,
		servicio_internet.IPAntena,
		servicio_internet.DireccionIPAP,
		servicio_internet.Plan
		FROM
		servicio_internet";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>