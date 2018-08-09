<?php
	require_once('../../class/methods_global/methods.php');
	$query = "	SELECT
					id AS 'Id',
					CONCAT(rut, '-', dv) AS 'Rut',
					nombre AS 'Nombre',
					correo AS 'Correo',
					telefono AS 'Teléfono',
					(
						SELECT
							COUNT(id)
						FROM
							servicios
						WHERE
							Rut = personaempresa.Rut
					) AS Servicios
				FROM
					personaempresa";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>