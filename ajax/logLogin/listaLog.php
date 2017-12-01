<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	log_login.IdLogLogin,
	log_login.IdUsuario,
	log_login.Usuario,
	log_login.Fecha,
	log_login.Proceso
	FROM
	log_login
	ORDER BY Fecha DESC
	LIMIT 5000";
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;
 ?>