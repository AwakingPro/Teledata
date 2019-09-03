<?php
	require_once('../../class/methods_global/methods.php');
	$query = "	SELECT
					u.nombre AS 'Usuario',
					DATE_FORMAT(l.Fecha, '%d-%m-%Y') as Fecha,
					l.TipoOperacion,
					l.QUERY 
				FROM
					log_query l
					INNER JOIN usuarios u ON l.IdUsuario = u.id 
				WHERE
					TipoOperacion != 'select' 
				ORDER BY
					l.Fecha DESC"; 
					// LIMIT 5000";
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;
 ?>