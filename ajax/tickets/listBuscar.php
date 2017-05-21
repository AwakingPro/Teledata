<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		tickets.IdTickets AS `#`,
		tickets.IdCliente AS Cliente,
		tickets.Origen,
		tickets.Departamento,
		tickets.Tipo,
		tickets.Estado,
		usuarios.nombre AS `Asignado a`,
		tiempo_prioridad.Nombre
	FROM
		tickets
	INNER JOIN usuarios ON tickets.AsignarA = usuarios.id
	INNER JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
	WHERE
		tickets.IdTickets LIKE '%".$_POST['NumeroTicket']."%' AND tickets.IdCliente LIKE '%".$_POST['NombreCliente']."%'";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>