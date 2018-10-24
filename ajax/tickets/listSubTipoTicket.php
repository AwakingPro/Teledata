<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "SELECT
		subtipo_ticket.IdSubTipoTicket as '#',
		tipo_ticket.Nombre as Tipo,
		subtipo_ticket.Nombre as SubTipo
	FROM
		subtipo_ticket
	INNER JOIN tipo_ticket ON subtipo_ticket.IdTipoTicket = tipo_ticket.IdTipoTicket";
	
	$lista = $run->listView($query);
	echo $lista;
 ?>