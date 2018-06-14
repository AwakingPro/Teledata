<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
		IdTipoTicket,
		Nombre
	FROM
		tipo_ticket
	WHERE
        IdTipoTicket ='.$_POST['id'];
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		echo json_encode($data);
	}else{
		echo 'false';
	}
 ?>