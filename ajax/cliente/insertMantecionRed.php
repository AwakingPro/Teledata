<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO mantencion_red (Descripcion, ComentarioDatosAdicionales) VALUES ('".$_POST['descripcion']."', '".$_POST['comentario']."');";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>