<?php
	require_once('../../class/methods_global/methods.php');
	$query = "UPDATE tickets SET  Estado='Finalizado' WHERE IdTickets= ".$_POST['id'];
	$run = new Method;
	$data = $run->update($query);
	echo $data;
 ?>