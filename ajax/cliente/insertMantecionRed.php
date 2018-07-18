<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO mantencion_red (Descripcion, ComentarioDatosAdicionales,IdServicio) VALUES ('".$_POST['descripcion']."', '".$_POST['comentario']."', '".$_POST['idServicio']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data;
 ?>