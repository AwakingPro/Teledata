<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		personaempresa.id as 'Id',
		personaempresa.CodigoCliente as 'Codigo del cliente',
		personaempresa.nombre as 'Nombre',
		personaempresa.correo as 'Correo',
		personaempresa.comentario as 'Comentario'
	FROM
		personaempresa";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>