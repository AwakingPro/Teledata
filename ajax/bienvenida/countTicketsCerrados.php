<?php
	require_once('../../class/methods_global/methods.php');
	
	$query = "SELECT
	COUNT(tickets.IdTickets)
	FROM
	tickets
	WHERE
	IdUsuarioSession = ".$_SESSION['idUsuario']." AND
	Estado = '2'";
	$run = new Method;
	$result = $run->select($query);
	echo json_encode($result);
 ?>