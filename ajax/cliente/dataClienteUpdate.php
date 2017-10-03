<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT *
	FROM
		personaempresa
	WHERE
		id ='.$_POST['id'];
	$run = new Method;
	$data = $run->select($query);
	echo json_encode($data);
?>