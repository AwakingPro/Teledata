<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
tickets.IdTickets AS `#`,
usuarios.nombre AS Cliente,
tickets.Origen,
tickets.Departamento,
usuarios.usuario AS Usuario,
tipo_ticket.Nombre AS Tipo,
subtipo_ticket.Nombre AS SubTipo,
tiempo_prioridad.Nombre AS Prioridad,
tickets.Estado
FROM
	tickets
	INNER JOIN usuarios ON tickets.AsignarA = usuarios.id
	INNER JOIN tipo_ticket ON tickets.Tipo = tipo_ticket.IdTipoTicket
	INNER JOIN subtipo_ticket ON tickets.Subtipo = subtipo_ticket.IdSubTipoTicket
	INNER JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
WHERE tickets.Estado = 'Abierto'";
	$run = new Method;
	session_start();
	if ($_SESSION['idNivel'] != 1) {
		$lista = $run->listViewTiketsSoporte($query);
	}else{
		$lista = $run->listViewTicktes($query);
	}
	echo $lista;
 ?>