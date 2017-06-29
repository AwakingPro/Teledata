<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM arriendo_equipos_datos WHERE IdArriendoEquiposDatos = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>