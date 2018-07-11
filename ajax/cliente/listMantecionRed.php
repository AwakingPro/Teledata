<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	mantencion_red.IdMantencionRed as 'Id',
	mantencion_red.Descripcion,
	mantencion_red.ComentarioDatosAdicionales as 'Comentario (Dato adicional)'
	FROM
	mantencion_red
	WHERE
		IdServivio = ".$_POST['id'];
	$run = new Method;
	$lista = $run->listViewDelete($query,$_POST['id'],1);
	echo $lista;
 ?>