<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM tiempo_prioridad WHERE IdTiempoPrioridad = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>