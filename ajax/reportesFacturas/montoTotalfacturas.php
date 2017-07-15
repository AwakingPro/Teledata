<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	Sum(servicios.Valor),
	Count(servicios.Id)
	FROM
		servicios
		INNER JOIN personaempresa ON servicios.Rut = personaempresa.rut
		INNER JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio";
	$run = new Method;
	$data = $run->select($query);
	echo json_encode($data);
 ?>