<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO arriendo_equipos_datos (TipoEquipo, Modelo, Mac/SN, Descripcion) VALUES ('".$_POST['tipoEquipo']."', '".$_POST['modelo']."', '".$_POST['mac']."', '".$_POST['descripcion']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>