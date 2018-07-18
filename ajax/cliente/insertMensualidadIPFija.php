<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO mensualidad_direccion_ip_fija (DireccionIPFija, Descripcion,IdServicio) VALUES ('".$_POST['ip']."', '".$_POST['descripcion']."', '".$_POST['idServicio']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data;
 ?>