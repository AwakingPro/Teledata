<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	mantencion_red.IdMantencionRed,
	mantencion_red.Descripcion,
	mantencion_red.ComentarioDatosAdicionales
	FROM
	mantencion_red
	WHERE
		IdServivio = ".$_POST['id'];
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>