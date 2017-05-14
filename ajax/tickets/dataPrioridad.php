<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO tiempo_prioridad (Nombre, TiempoHora) VALUES ('".$_POST['nombre']."', '".$_POST['tiempo']."');";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>