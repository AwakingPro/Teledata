<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM grupo_servicio WHERE IdGrupo = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>