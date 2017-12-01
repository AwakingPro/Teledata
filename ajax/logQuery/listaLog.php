<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	log_query.IdLogSql,
	log_query.IdUsuario,
	log_query.Fecha,
	TipoOperacion,
	log_query.Query
	FROM
	log_query
	ORDER BY Fecha DESC
	LIMIT 5000";
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;
 ?>