<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
		UsuarioPppoe
		FROM
		servicios
		WHERE
		UsuarioPppoe ="'.$_POST['user'].'"';
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		echo 'true';
	}else{
		echo 'false';
	}
 ?>