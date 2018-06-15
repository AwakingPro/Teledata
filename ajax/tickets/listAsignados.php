<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "SELECT
	tickets.IdTickets as '#',
	tickets.FechaCreacion as Fecha,
	CONCAT(personaempresa.rut, ' - ', personaempresa.nombre) AS Cliente,
	origen_tickets.Nombre as Origen,
	departamentos_tickets.Nombre as Departamento,
	usuarios.usuario as Usuario,
	tipo_ticket.Nombre as Tipo,
	subtipo_ticket.Nombre as SubTipo,
	tiempo_prioridad.Nombre as Prioridad
	FROM
	tickets
	INNER JOIN personaempresa ON tickets.IdCliente = personaempresa.rut
	INNER JOIN tipo_ticket ON tickets.Tipo = tipo_ticket.IdTipoTicket
	LEFT JOIN subtipo_ticket ON tickets.Subtipo = subtipo_ticket.IdSubTipoTicket
	INNER JOIN usuarios ON tickets.AsignarA = usuarios.id
	LEFT JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
	LEFT JOIN departamentos_tickets ON tickets.Departamento = departamentos_tickets.IdDepartamento
	LEFT JOIN origen_tickets ON tickets.Origen = origen_tickets.IdOrigen
	WHERE 
		tickets.AsignarA != ''
	AND 
		tickets.Estado = '1'
	AND
		(NOW() <= DATE_ADD(tickets.FechaCreacion,INTERVAL tiempo_prioridad.TiempoHora HOUR) OR tiempo_prioridad.IdTiempoPrioridad IS NULL)";
	$run = new Method;
	if ($_SESSION['idNivel'] != 1) {
		$query .= " AND tickets.AsignarA = '".$_SESSION['idUsuario']."'";
		$lista = $run->listViewTicketsSoporte($query);
	}else{
		$lista = $run->listViewTickets($query);
	}
	echo $lista;
 ?>