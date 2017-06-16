<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO mensualidad_puerdo_publicos (PuertoTCPUDP, Descripcion,IdServivio) VALUES ('".$_POST['puerto']."', '".$_POST['descripcion']."', '".$_POST['idServicio']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>