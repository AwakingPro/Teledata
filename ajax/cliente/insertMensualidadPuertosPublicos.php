<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO mensualidad_puerdo_publicos (PuertoTCP/UDP, Descripcion) VALUES ('".$_POST['puerto']."', '".$_POST['descripcion']."');";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>