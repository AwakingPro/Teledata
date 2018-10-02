<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT * FROM mantenedor_tipo_contacto";
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		for ($i=0; $i < count($data); $i++) {
			$list.= '<option value="'.$data[$i]['id'].'">'.$data[$i]['nombre'].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>