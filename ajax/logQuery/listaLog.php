<?php
	require_once('../../class/methods_global/methods.php');
	$query = "	SELECT
					IFNULL(u.nombre, 'Sin usuario') AS 'Usuario',
					l.Fecha,
					l.TipoOperacion,
					l.QUERY 
				FROM
					log_query l
					LEFT JOIN usuarios u ON l.IdUsuario = u.id 
				WHERE
					TipoOperacion != 'select' 
				ORDER BY
					l.Fecha ASC 
					LIMIT 5000";
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;
 ?>