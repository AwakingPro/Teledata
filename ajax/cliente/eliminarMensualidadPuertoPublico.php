<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM mensualidad_puertos_publicos WHERE IdMensualidadPuertosPublicos = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>