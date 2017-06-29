<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM trafico_generado WHERE IdTraficoGenerado = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>