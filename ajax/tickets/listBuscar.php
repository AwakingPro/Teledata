<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	tickets.IdTickets as '#',
	personaempresa.nombre as Cliente,
	tickets.Origen,
	tickets.Departamento,
	usuarios.usuario as Usuario,
	tipo_ticket.Nombre as Tipo,
	subtipo_ticket.Nombre as Subtipo,
	tiempo_prioridad.Nombre as Prioridad,
	tickets.Estado
	FROM
	tickets
	INNER JOIN personaempresa ON tickets.IdCliente = personaempresa.rut
	INNER JOIN tipo_ticket ON tickets.Tipo = tipo_ticket.IdTipoTicket
	LEFT JOIN subtipo_ticket ON tickets.Subtipo = subtipo_ticket.IdSubTipoTicket
	LEFT JOIN usuarios ON tickets.AsignarA = usuarios.id
	LEFT JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
	WHERE
		tickets.IdTickets LIKE '%".$_POST['NumeroTicket']."%' AND tickets.IdCliente LIKE '%".$_POST['NombreCliente']."%'";
	$run = new Method;
	session_start();
	if ($_SESSION['idNivel'] != 1) {
		$lista = $run->listViewTicketsSoporte($query);
	}else{
		$lista = $run->listViewTickets($query);
	}
	echo $lista;
 ?>