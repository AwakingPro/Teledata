<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO mensualidad_direccion_ip_fija (DireccionIPFija, Descripcion,IdServivio) VALUES ('".$_POST['ip']."', '".$_POST['descripcion']."', '".$_POST['idServicio']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>