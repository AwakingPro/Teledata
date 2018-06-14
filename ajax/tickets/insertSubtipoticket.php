<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO subtipo_ticket (IdTipoTicket, Nombre) VALUES ('".$_POST['IdTipoTicket']."', '".$_POST['nombreSubTipo']."');";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>