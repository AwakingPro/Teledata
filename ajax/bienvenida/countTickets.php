<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "SELECT
	Count(tickets.IdTickets)
	FROM
	tickets
	WHERE
	IdUsuarioSession =".$_SESSION['idUsuario'];
	$run = new Method;
	$result = $run->select($query);
	echo json_encode($result);
 ?>