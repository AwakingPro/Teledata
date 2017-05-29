<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO tipo_ticket (Nombre) VALUES ('".$_POST['nombreTipo']."');";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>