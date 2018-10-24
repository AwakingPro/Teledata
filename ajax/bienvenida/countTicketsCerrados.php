<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "SELECT
	COUNT(tickets.IdTickets)
	FROM
	tickets
	WHERE
	IdUsuarioSession = ".$_SESSION['idUsuario']." AND
	Estado = '2'";
	
	$result = $run->select($query);
	echo json_encode($result);
 ?>