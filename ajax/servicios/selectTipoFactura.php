<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
	tipo_facturacion.codigo,
	tipo_facturacion.descripcion
	FROM
	tipo_facturacion';
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='<option value="">Seleccione...</option>';
		for ($i=0; $i < count($data); $i++) {
			$list.= '<option value="'.$data[$i][0].'">'.$data[$i][0].' - '.$data[$i][1].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>