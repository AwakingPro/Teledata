<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = 'SELECT
		*
	FROM
		tickets
	WHERE IdTickets ='.$_POST['id'];
	
	$data = $run->select($query);
	if (count($data) > 0) {
		echo json_encode($data);
	}else{
		echo 'false';
	}
 ?>