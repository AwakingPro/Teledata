<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "DELETE FROM tiempo_prioridad WHERE IdTiempoPrioridad = ".$_POST['id'];
	
	$data = $run->delete($query);
	echo $data;
 ?>