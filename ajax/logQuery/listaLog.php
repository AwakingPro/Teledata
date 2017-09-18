<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	log_query.IdLogSql,
	log_query.IdUsuario,
	log_query.Fecha,
	TipoOperacion,
	log_query.Query
	FROM
	log_query";
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;
 ?>