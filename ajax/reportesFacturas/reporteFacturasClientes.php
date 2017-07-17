<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		servicios.Codigo,
		personaempresa.rut as 'Rut',
		personaempresa.nombre as 'Nombre',
		mantenedor_servicios.servicio as 'Servicios',
		servicios.Grupo,
		sum(servicios.Valor) as 'Monto'
	FROM
		servicios
		INNER JOIN personaempresa ON servicios.Rut = personaempresa.rut
		INNER JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio
	GROUP BY
	personaempresa.rut";
	$run = new Method;
	$lista = $run->listViewFacturasClientes($query);
	echo $lista;
 ?>