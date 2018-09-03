<?php
	require_once('../../class/methods_global/methods.php');
	$query = "	SELECT
					Usuario,
					Fecha,
					Proceso 
				FROM
					log_login 
				ORDER BY
					Fecha DESC 
					LIMIT 5000";
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;
 ?>