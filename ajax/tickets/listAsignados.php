<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "SELECT
		tickets.IdTickets AS `#`,
		tickets.IdCliente AS Cliente,
		tickets.Origen,
		tickets.Departamento,
		tickets.Tipo,
		tickets.Estado,
		tiempo_prioridad.Nombre as Prioridad
	FROM
		tickets
	INNER JOIN usuarios ON tickets.AsignarA = usuarios.id
	INNER JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
	WHERE tickets.AsignarA = ".$_SESSION['idUsuario'];
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>