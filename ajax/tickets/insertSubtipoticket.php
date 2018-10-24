<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "INSERT INTO subtipo_ticket (IdTipoTicket, Nombre) VALUES ('".$_POST['IdTipoTicket']."', '".$_POST['nombreSubTipo']."');";
	
	$data = $run->insert($query);
	echo $data
 ?>