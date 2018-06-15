<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	tickets.IdTickets AS `#`,
	tickets.FechaCreacion as Fecha,
	CONCAT(personaempresa.rut, ' - ', personaempresa.nombre) AS Cliente,
	tickets.Origen,
	tickets.Departamento,
	tipo_ticket.Nombre AS Tipo,
	subtipo_ticket.Nombre AS SubTipo,
	tiempo_prioridad.Nombre AS Prioridad
	FROM
		tickets
		INNER JOIN personaempresa ON tickets.IdCliente = personaempresa.rut
		INNER JOIN tipo_ticket ON tickets.Tipo = tipo_ticket.IdTipoTicket
		LEFT JOIN subtipo_ticket ON tickets.Subtipo = subtipo_ticket.IdSubTipoTicket
		LEFT JOIN usuarios ON tickets.AsignarA = usuarios.id
		LEFT JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
	WHERE 
		tickets.Estado = 'Abierto'
	AND
		(NOW() <= DATE_ADD(tickets.FechaCreacion,INTERVAL tiempo_prioridad.TiempoHora HOUR) OR tiempo_prioridad.IdTiempoPrioridad IS NULL)
	AND
		(tickets.AsignarA = '' OR usuarios.id IS NULL)";
	$run = new Method;
	session_start();
	if ($_SESSION['idNivel'] != 1) {
		$lista = $run->listViewTicketsSoporte($query);
	}else{
		$lista = $run->listViewTickets($query);
	}
	echo $lista;
 ?>