<?php
	require_once('../../class/methods_global/methods.php');
	if(isset($_POST['user']) && $_POST['user'] != ''){
		$query = 'SELECT
		UsuarioPppoeTeorico
		FROM
		servicios
		WHERE
		UsuarioPppoeTeorico ="'.$_POST['user'].'"';
		$run = new Method;
		$data = $run->select($query);
		if (count($data) > 0) {
			echo 'true';
		}else{
			echo 'false';
		}
	}else{
		echo 'false';
	}
	
 ?>