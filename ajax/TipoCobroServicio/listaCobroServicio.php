<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	mantenedor_tipo_facturacion.id,
	mantenedor_tipo_facturacion.codigo,
	mantenedor_tipo_facturacion.descripcion
	FROM
	mantenedor_tipo_facturacion";
	$run = new Method;
	$lista = $run->listViewDelete($query);
	echo $lista;
 ?>