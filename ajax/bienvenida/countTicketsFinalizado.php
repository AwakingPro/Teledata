<?php
	require_once('../../class/methods_global/methods.php');
	
	$query = "SELECT
	COUNT(IdTickets)
	FROM
	tickets
	WHERE
	IdUsuarioSession = ".$_SESSION['idUsuario']." AND
	Estado = '3'";
	$run = new Method;
	$result = $run->select($query);
	echo json_encode($result);
 ?>