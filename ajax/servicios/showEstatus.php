<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
		FechaInicioDesactivacion,
		FechaFinalDesactivacion
		FROM
		servicios
		WHERE
		Id = "'.$_POST['id'].'"';
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		$FechaInicioDesactivacion = $data[0]['FechaInicioDesactivacion'];
		$FechaFinalDesactivacion = $data[0]['FechaFinalDesactivacion'];
        if($FechaInicioDesactivacion){
            $FechaInicioDesactivacion = DateTime::createFromFormat('Y-m-d', $FechaInicioDesactivacion)->format('Y/m/d');
        }else{
            $FechaInicioDesactivacion = '';
		}
		if($FechaFinalDesactivacion){
            $FechaFinalDesactivacion = DateTime::createFromFormat('Y-m-d', $FechaFinalDesactivacion)->format('Y/m/d');
        }else{
            $FechaFinalDesactivacion = '';
        }
		echo json_encode(array('FechaInicioDesactivacion' => $FechaInicioDesactivacion, 'FechaFinalDesactivacion' => $FechaFinalDesactivacion));
	}else{
		echo 'false';
	}
 ?>