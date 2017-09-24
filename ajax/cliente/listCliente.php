<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT *
	FROM
		personaempresa
	WHERE
		rut = ".$_POST['rut'];
	$run = new Method;
	$result = $run->select($query);
	echo json_encode($result);
 ?>