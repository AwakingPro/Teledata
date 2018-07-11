<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT * FROM provincias";
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='<option value="">Seleccione...</option>';
		for ($i=0; $i < count($data); $i++) {
			$list.= '<option value="'.$data[$i]['provincia_id'].'">'.$data[$i]['provincia_nombre'].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>