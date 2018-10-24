<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "INSERT INTO tiempo_prioridad (Nombre, TiempoHora) VALUES ('".$_POST['nombre']."', '".$_POST['tiempo']."');";
	$data = $run->insert($query);
	echo $data
 ?>