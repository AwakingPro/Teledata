<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		tickets.IdTickets as '#',
		tickets.IdCliente as 'Cliente',
		tickets.Origen,
		tickets.Departamento,
		tickets.Tipo,
		tickets.Prioridad,
		tickets.Estado,
		usuarios.nombre as 'Asignado a'
	FROM
		tickets
	INNER JOIN usuarios ON tickets.AsignarA = usuarios.id
	WHERE tickets.Estado = 'Abierto'";
	$run = new Method;
	$data = $run->select($query);
	echo count($data);
 ?>