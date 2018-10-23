<?php
	require_once('../../class/methods_global/methods.php');
	
	$run = new Method;
	$query = "SELECT Count(IdTickets) FROM tickets WHERE IdUsuarioSession =".$_SESSION['idUsuario'];
	$result = $run->select($query);
	$total = $result[0][0];

	$query = "SELECT COUNT(IdTickets) FROM tickets WHERE IdUsuarioSession = ".$_SESSION['idUsuario']." AND tickets.Estado = '1'";
	$result = $run->select($query);
	$totalAbierto = $result[0][0];

	$query = "SELECT COUNT(IdTickets) FROM tickets WHERE IdUsuarioSession = ".$_SESSION['idUsuario']." AND tickets.Estado = '2'";
	$result = $run->select($query);
	$totalCerrado = $result[0][0];

	$query = "SELECT COUNT(IdTickets) FROM tickets WHERE IdUsuarioSession = ".$_SESSION['idUsuario']." AND tickets.Estado = '3'";
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