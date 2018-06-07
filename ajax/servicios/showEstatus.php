<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
		FechaActivacion
		FROM
		servicios
		WHERE
		Id = "'.$_POST['id'].'"';
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
        $FechaActivacion = $data[0]['FechaActivacion'];
        if($FechaActivacion){
            $FechaActivacion = DateTime::createFromFormat('Y-m-d', $FechaActivacion)->format('d-m-Y');
        }else{
            $FechaActivacion = '';
        }
		echo $FechaActivacion;
	}else{
		echo 'false';
	}
 ?>