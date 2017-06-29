<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM mantencion_red WHERE IdMantencionRed = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>