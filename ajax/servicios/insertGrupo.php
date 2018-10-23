<?php
	require_once('../../class/methods_global/methods.php');
	
	$query = "INSERT INTO grupo_servicio (Nombre) VALUES ('".$_POST['NomGrupo']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>