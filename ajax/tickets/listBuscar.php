<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT tickets.Origen, tickets.Departamento, personaempresa.nombre as 'Nombre', tickets.Tipo, tickets.Prioridad, tickets.AsignarA as 'Asignado a', tickets.Estado FROM tickets INNER JOIN personaempresa ON tickets.IdCliente = personaempresa.rut WHERE tickets.Estado = 'Abierto'";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>