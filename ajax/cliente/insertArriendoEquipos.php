<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO arriendo_equipos_datos (TipoEquipo, Modelo, MacSN, Descripcion,IdServivio) VALUES ('".$_POST['tipoEquipo']."', '".$_POST['modelo']."', '".$_POST['mac']."', '".$_POST['descripcion']."', '".$_POST['idServicio']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data;
 ?>