<?php
	require_once('../../class/methods_global/methods.php');
	$query = '	SELECT
					mantenedor_tipo_factura.id,
					mantenedor_tipo_factura.codigo,
					mantenedor_tipo_factura.descripcion,
					mantenedor_tipo_facturacion.nombre AS tipo_facturacion
				FROM
					mantenedor_tipo_factura
				INNER JOIN mantenedor_tipo_facturacion ON mantenedor_tipo_factura.tipo_facturacion = mantenedor_tipo_facturacion.id';
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='<option value="">Seleccione...</option>';
		for ($i=0; $i < count($data); $i++) {
			$list.= '<option value="'.$data[$i][0].'">'.$data[$i][1].' - '.$data[$i][2].' - '.$data[$i][3].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>