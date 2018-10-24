<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "INSERT INTO grupo_servicio (Nombre) VALUES ('".$_POST['NomGrupo']."')";
	$data = $run->insert($query);
	echo $data
 ?>