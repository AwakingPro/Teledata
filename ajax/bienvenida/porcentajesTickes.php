<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "SELECT Count(tickets.IdTickets) FROM tickets WHERE IdUsuarioSession =".$_SESSION['idUsuario'];
	$run = new Method;
	$result = $run->select($query);
	$total = $result[0][0];

	$query = "SELECT COUNT(tickets.IdTickets) FROM tickets WHERE IdUsuarioSession = ".$_SESSION['idUsuario']." AND tickets.Estado = '1' ";
	$run = new Method;
	$result = $run->select($query);
	$totalAbierto = $result[0][0];

	$query = "SELECT COUNT(tickets.IdTickets) FROM tickets WHERE IdUsuarioSession = ".$_SESSION['idUsuario']." AND tickets.Estado = '2' ";
	$run = new Method;
	$result = $run->select($query);
	$totalCerrado = $result[0][0];

	$query = "SELECT COUNT(tickets.IdTickets) FROM tickets WHERE IdUsuarioSession = ".$_SESSION['idUsuario']." AND tickets.Estado = '3' ";
	$run = new Method;
	$result = $run->select($query);
	$totalFinalizados = $result[0][0];

	if($totalAbierto != 0){
		$porcAbiertos = ($totalAbierto * 100) / $total;
	}else{
		$porcAbiertos = 0;
	}
	if($totalCerrado != 0){
		$porcCerrado = ($totalCerrado * 100) / $total;
	}else{
		$porcCerrado = 0;
	}
	if($totalFinalizados != 0){
		$porcFinalizado = ($totalFinalizados * 100) / $total;
	}else{
		$porcFinalizado = 0;
	}

 	echo json_encode(array($porcAbiertos, $porcCerrado, $porcFinalizado));
 ?>