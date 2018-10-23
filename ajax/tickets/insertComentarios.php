<?php
	require_once('../../class/methods_global/methods.php');
	
	$query = "INSERT INTO comentarios_tickets (IdTickets, Comentario, IdUSuario, Fecha) VALUES ('".$_POST['idTicket']."', '".$_POST['comentario']."', '".$_SESSION['idUsuario']."', '".date("Y-m-d H:i:s")."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>