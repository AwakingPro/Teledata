<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
		tickets.IdTickets,
		tickets.IdCliente,
		tickets.Origen,
		tickets.Departamento,
		tickets.Tipo,
		tickets.Subtipo,
		tickets.Prioridad,
		tickets.AsignarA,
		tickets.Estado,
		tickets.FechaCreasion
	FROM
		tickets
	WHERE IdTickets ='.$_POST['id'];
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		echo json_encode($data);
	}else{
		echo 'false';
	}
 ?>