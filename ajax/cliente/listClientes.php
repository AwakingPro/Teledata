<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		personaempresa.id,
		personaempresa.rut,
		personaempresa.nombre,
		personaempresa.correo,
		personaempresa.comentario
	FROM
		personaempresa";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>