<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT 
				servicios.Codigo, personaempresa.rut as 'Rut', 
				personaempresa.nombre as 'Nombre', 
				mantenedor_servicios.servicio as 'Servicio', 
				COALESCE ( grupo_servicio.Nombre, servicios.Grupo ) AS 'Grupo', 
				servicios.Valor 
			FROM 
				servicios
			INNER JOIN 
				personaempresa 
			ON 
				servicios.Rut = personaempresa.rut 
			INNER JOIN 
				mantenedor_servicios 
			ON 
				servicios.IdServicio = mantenedor_servicios.IdServicio 
			LEFT JOIN 
				grupo_servicio 
			ON 
				grupo_servicio.IdGrupo = servicios.Grupo";
	$run = new Method;
	$lista = $run->listViewFacturasClientes($query);
	echo $lista;
 ?>