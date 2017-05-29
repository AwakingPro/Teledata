<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	tickets.IdTickets as '#',
	tickets.IdCliente as Cliente,
	tickets.Origen,
	tickets.Departamento,
	usuarios.usuario as Usuario,
	tipo_ticket.Nombre as Tipo,
	subtipo_ticket.Nombre as SubTipo,
	tiempo_prioridad.Nombre as Prioridad,
	tickets.Estado,
	tickets.FechaCreasion as Fecha
	FROM
		tickets
		INNER JOIN usuarios ON tickets.AsignarA = usuarios.id
		INNER JOIN tipo_ticket ON tickets.Tipo = tipo_ticket.IdTipoTicket
		INNER JOIN subtipo_ticket ON tickets.Subtipo = subtipo_ticket.IdSubTipoTicket
		INNER JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
	WHERE  NOW() > DATE_ADD(tickets.FechaCreasion,INTERVAL tiempo_prioridad.TiempoHora HOUR)";
	$run = new Method;
	session_start();
	if ($_SESSION['idNivel'] != 1) {
		$lista = $run->listViewTiketsSoporte($query);
	}else{
		$lista = $run->listViewTicktes($query);
	}
	echo $lista;
 ?>