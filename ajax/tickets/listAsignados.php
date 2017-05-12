<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "SELECT
		tickets.IdTickets,
		tickets.IdCliente,
		tickets.Origen,
		tickets.Departamento,
		tickets.Tipo,
		tickets.Prioridad,
		tickets.Estado
		FROM
		tickets
		INNER JOIN usuarios ON tickets.AsignarA = usuarios.id
		WHERE tickets.AsignarA = ".$_SESSION['idUsuario'];
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>