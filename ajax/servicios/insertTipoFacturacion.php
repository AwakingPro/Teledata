<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = "INSERT INTO mantenedor_tipo_factura (codigo, descripcion, tipo_facturacion) VALUES ('".$_POST['TipoFacCodigo']."', '".$_POST['TipoFacDescripcion']."', '".$_POST['TipoFacturacion']."')";
	$data = $run->insert($query);
	echo $data
 ?>