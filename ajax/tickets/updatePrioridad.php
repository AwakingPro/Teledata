<?php
	require_once('../../class/methods_global/methods.php');
	$query = "UPDATE tiempo_prioridad SET Nombre='".$_POST['nombre']."', TiempoHora='".$_POST['tiempo']."' WHERE IdTiempoPrioridad = ".$_POST['idUpdatePrioridad'];
	$run = new Method;
	$data = $run->update($query);
	echo $data;
 ?>