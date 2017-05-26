<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
		servicios.id,
		servicios.codigo,
		servicios.descripcion
	FROM
		servicios';
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='<option value="">Seleccione...</option>';
		for ($i=0; $i < count($data); $i++) {
			$list.= '<option value="'.$data[$i]['id'].'">'.$data[$i]['codigo'].' - '.$data[$i]['descripcion'].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>