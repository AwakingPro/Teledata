<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "SELECT
	tickets.IdTickets as '#',
	tickets.IdCliente as Cliente,
	tickets.Origen,
	tickets.Departamento,
	usuarios.usuario as Usuario,
	tipo_ticket.Nombre as Tipo,
	subtipo_ticket.Nombre as SubTipo,
	tiempo_prioridad.Nombre as Prioridad,
	tickets.Estado
	FROM
	tickets
	INNER JOIN usuarios ON tickets.AsignarA = usuarios.id
	INNER JOIN tipo_ticket ON tickets.Tipo = tipo_ticket.IdTipoTicket
	INNER JOIN subtipo_ticket ON tickets.Subtipo = subtipo_ticket.IdSubTipoTicket
	INNER JOIN tiempo_prioridad ON tickets.Prioridad = tiempo_prioridad.IdTiempoPrioridad
	WHERE tickets.AsignarA = ".$_SESSION['idUsuario'];
	$run = new Method;
	if ($_SESSION['idNivel'] != 1) {
		$lista = $run->listViewTiketsSoporte($query);
	}else{
		$lista = $run->listView($query);
	}
	echo $lista;
 ?>