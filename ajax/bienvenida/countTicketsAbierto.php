<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "SELECT
	COUNT(tickets.IdTickets)
	FROM
	tickets
	WHERE
	IdUsuarioSession = ".$_SESSION['idUsuario']." AND
	tickets.Estado = '1'";
	$run = new Method;
	$result = $run->select($query);
	echo json_encode($result);
 ?>