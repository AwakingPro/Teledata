<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "INSERT INTO tipo_ticket (Nombre) VALUES ('".$_POST['nombreTipo']."');";
	
	$data = $run->insert($query);
	echo $data
 ?>