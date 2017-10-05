<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	mantenedor_tipo_factura.id,
	mantenedor_tipo_factura.codigo,
	mantenedor_tipo_factura.descripcion
	FROM
	mantenedor_tipo_factura";
	$run = new Method;
	$lista = $run->listViewDelete($query);
	echo $lista;
 ?>