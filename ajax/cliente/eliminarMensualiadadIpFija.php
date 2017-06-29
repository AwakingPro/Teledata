<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM mensualidad_direccion_ip_fija WHERE IdMensualidadDireccionIPFija = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>