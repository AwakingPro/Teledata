<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "INSERT INTO comentarios_tickets (IdTickets, Comentario, IdUSuario, Fecha) VALUES ('".$_POST['idTicket']."', '".$_POST['comentario']."', '".$_SESSION['idUsuario']."', '".date("Y-m-d H:i:s")."')";
	
	$data = $run->insert($query);
	echo $data
 ?>