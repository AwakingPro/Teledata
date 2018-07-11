<?php
	require_once('../../class/methods_global/methods.php');
	$query = "	SELECT
					mantenedor_tipo_factura.id,
					mantenedor_tipo_factura.codigo,
					mantenedor_tipo_factura.descripcion,
					mantenedor_tipo_facturacion.nombre AS 'Tipo de Facturación'
				FROM
					mantenedor_tipo_factura
				INNER JOIN mantenedor_tipo_facturacion ON mantenedor_tipo_factura.tipo_facturacion = mantenedor_tipo_facturacion.id";
	$run = new Method;
	$lista = $run->listViewDelete($query,'','');
	echo $lista;
 ?>