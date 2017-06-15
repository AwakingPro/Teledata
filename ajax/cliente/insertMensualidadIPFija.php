<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO mensualidad_direccion_ip_fija (DireccionIPFija, Descripcion) VALUES ('".$_POST['ip']."', '".$_POST['descripcion']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>