<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	tickets.IdTickets,
	tickets.IdCliente,
	subtipo_ticket.Nombre,
	tickets.Origen,
	tickets.Departamento,
	usuarios.usuario,
	tipo_ticket.Nombre,
	subtipo_ticket.Nombre,
	tiempo_prioridad.Nombre,
	tickets.Estado
	FROM
	tickets
	INNER JOIN personaempresa ON tickets.IdCliente = personaempresa.rut
	INNER JOIN tipo_ticket ON tickets.Tipo = tipo_ticket.IdTipoTicket
	LEFT JOIN subtipo_ticket ON tickets.Subtipo = subtipo_ticket.IdSubTipoTicket
	LEFT JOIN usuarios ON tickets.AsignarA = usuarios.id
	LEFT JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
	WHERE tickets.Estado = 'Finalizado' OR tickets.Estado = 'Cerrado'";
	$run = new Method;
	$data = $run->select($query);
	echo count($data);
 ?>