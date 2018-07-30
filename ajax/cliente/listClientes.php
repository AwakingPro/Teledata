<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		id as 'Id',
		CONCAT(rut,'-',dv) as 'Rut',
		nombre as 'Nombre',
		correo as 'Correo',
		comentario as 'Comentario'
	FROM
		personaempresa";
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>