<?php
    require_once('../../class/methods_global/methods.php');
    $region_id = $_POST['Region'];
	$query = "	SELECT
					ciudades.*
				FROM
					ciudades
				INNER JOIN provincias ON ciudades.provincia_id = provincias.id
				WHERE
					provincias.region_id = '".$region_id."'
				ORDER BY ciudades.nombre";
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='<option value="">Seleccione...</option>';
		for ($i=0; $i < count($data); $i++) {
			$list.= '<option value="'.$data[$i]['id'].'">'.$data[$i]['nombre'].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>