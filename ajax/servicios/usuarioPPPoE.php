<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
		UsuarioPppoe
		FROM
		servicios
		WHERE
		UsuarioPppoe ="'.$_POST['user'].'".';
	$run = new Method;
	$data = $run->select($query);
	echo $data[1][0];
	if ($data[1][0] == $_POST['user']) {
		echo 'true';
	}else{
		echo 'false';
	}
 ?>