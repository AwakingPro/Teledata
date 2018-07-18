<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO mensualidad_puertos_publicos (PuertoTCPUDP, Descripcion,IdServicio) VALUES ('".$_POST['puerto']."', '".$_POST['descripcion']."', '".$_POST['idServicio']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data;
 ?>