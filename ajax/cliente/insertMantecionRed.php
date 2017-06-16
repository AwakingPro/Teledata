<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO mantencion_red (Descripcion, ComentarioDatosAdicionales,IdServivio) VALUES ('".$_POST['descripcion']."', '".$_POST['comentario']."', '".$_POST['idServicio']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>