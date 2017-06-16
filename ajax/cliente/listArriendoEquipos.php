<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		arriendo_equipos_datos.IdArriendoEquiposDatos,
		arriendo_equipos_datos.MacSN,
		arriendo_equipos_datos.Modelo,
		arriendo_equipos_datos.TipoEquipo
	FROM
		arriendo_equipos_datos";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>