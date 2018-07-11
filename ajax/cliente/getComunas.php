<?php
    require_once('../../class/methods_global/methods.php');
    $provincia_id = $_POST['Provincia'];
	$query = "SELECT * FROM comunas WHERE provincia_id = '".$provincia_id."'";
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='<option value="">Seleccione...</option>';
		for ($i=0; $i < count($data); $i++) {
			$list.= '<option value="'.$data[$i]['comuna_id'].'">'.$data[$i]['comuna_nombre'].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>