<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	grupo_servicio.IdGrupo,
	grupo_servicio.Nombre
	FROM
	grupo_servicio";
	$run = new Method;
	$lista = $run->listViewDelete($query,'','');
	echo $lista;
 ?>