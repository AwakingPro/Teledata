<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;

	$query = 'SELECT * FROM contactos WHERE id ='.$_POST['id'];
	$data = $run->select($query);

	if(!is_array($data)){
		$data = array();
	}

	echo json_encode(array('DataContacto' => $data));
?>