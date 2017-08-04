<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO mantenedor_tipo_factura (codigo, descripcion) VALUES ('".$_POST['TipoFacCodigo']."', '".$_POST['TipoFacDescripcion']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>