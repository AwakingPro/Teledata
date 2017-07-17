<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	servicios.Codigo,
	personaempresa.rut as 'Rut',
	personaempresa.nombre as 'Nombre',
	mantenedor_servicios.servicio as 'Servicio',
	CONCAT('Grupo ',servicios.Grupo) as 'Grupo',
	Sum(servicios.Valor) as 'Valor'
	FROM
		servicios
		INNER JOIN personaempresa ON servicios.Rut = personaempresa.rut
		INNER JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio
	GROUP BY
	servicios.Grupo";
	$run = new Method;
	$lista = $run->listViewFacturasClientes($query);
	echo $lista;
 ?>