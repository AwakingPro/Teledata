<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "UPDATE tiempo_prioridad SET Nombre='".$_POST['nombre']."', TiempoHora='".$_POST['tiempo']."' WHERE IdTiempoPrioridad = ".$_POST['idUpdatePrioridad'];
	$data = $run->update($query);
	echo $data;
 ?>