<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "SELECT
	tickets.IdTickets as '#',
	tickets.FechaCreacion as Fecha,
	clase_tickets.Nombre as Clase,
	CONCAT(personaempresa.rut, ' - ', personaempresa.nombre) AS Cliente,
	origen_tickets.Nombre as Origen,
	departamentos_tickets.Nombre as Departamento,
	usuarios.usuario as Usuario,
	tipo_ticket.Nombre as Tipo,
	subtipo_ticket.Nombre as SubTipo,
	tiempo_prioridad.Nombre as Prioridad,
	estado_tickets.Nombre as Estado
	FROM
	tickets
	INNER JOIN personaempresa ON tickets.IdCliente = personaempresa.rut
	INNER JOIN tipo_ticket ON tickets.Tipo = tipo_ticket.IdTipoTicket
	LEFT JOIN subtipo_ticket ON tickets.Subtipo = subtipo_ticket.IdSubTipoTicket
	LEFT JOIN usuarios ON tickets.AsignarA = usuarios.id
	LEFT JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
	LEFT JOIN departamentos_tickets ON tickets.Departamento = departamentos_tickets.IdDepartamento
	LEFT JOIN origen_tickets ON tickets.Origen = origen_tickets.IdOrigen
	LEFT JOIN estado_tickets ON tickets.Estado = estado_tickets.IdEstado
	LEFT JOIN clase_tickets ON tickets.Clase = clase_tickets.IdClase
	WHERE tickets.Estado = '2' OR tickets.Estado = '3'";
	
	
	if ($_SESSION['idNivel'] != 1) {
		$lista = $run->listViewTicketsSoporte($query);
	}else{
		$lista = $run->listViewTickets($query);
	}
	echo $lista;
 ?>