<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "UPDATE tickets SET  Estado='3' WHERE IdTickets= ".$_POST['id'];
	
	$data = $run->update($query);
	echo $data;
 ?>