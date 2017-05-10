<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		tickets.IdTickets,
		tickets.IdCliente,
		tickets.Origen,
		tickets.Departamento,
		personaempresa.nombre AS Nombre,
		tickets.Tipo,
		tickets.Prioridad,
		tickets.Estado,
		personaempresa.rut,
		personaempresa.nombre AS `Asignado a`
	FROM
		tickets
	INNER JOIN personaempresa ON tickets.AsignarA = personaempresa.rut
	WHERE
		tickets.IdTickets LIKE '%".$_POST['NumeroTicket']."%' AND tickets.IdCliente LIKE '%".$_POST['NombreCliente']."%'";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>