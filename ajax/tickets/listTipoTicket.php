<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		tipo_ticket.IdTipoTicket,
		tipo_ticket.Nombre
	FROM
		tipo_ticket";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>