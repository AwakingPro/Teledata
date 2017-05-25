<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		tickets.IdTickets AS `#`,
		tickets.IdCliente,
		tickets.Origen,
		tickets.Departamento,
		tickets.Tipo,
		usuarios.nombre AS Nombre,
		tiempo_prioridad.Nombre AS Prioridad,
		tickets.FechaCreasion
	FROM
		tickets
	INNER JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
	INNER JOIN usuarios ON tickets.AsignarA = usuarios.id
	WHERE  NOW() > DATE_ADD(tickets.FechaCreasion,INTERVAL tiempo_prioridad.TiempoHora HOUR)";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>