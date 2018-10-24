<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "SELECT
	COUNT(IdTickets)
	FROM
	tickets
	WHERE
	IdUsuarioSession = ".$_SESSION['idUsuario']." AND
	Estado = '1'";
	
	$result = $run->select($query);
	echo json_encode($result);
 ?>