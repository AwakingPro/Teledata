<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;

	$query = 'SELECT * FROM personaempresa WHERE id ='.$_POST['id'];
	$data = $run->select($query);

	echo json_encode($data);
?>