<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "SELECT
		tipo_ticket.IdTipoTicket,
		tipo_ticket.Nombre
	FROM
		tipo_ticket";
	
	$lista = $run->listView($query);
	echo $lista;
 ?>