<?php
    require_once('../../class/methods_global/methods.php');
    header("Content-Type: application/json", true);
	$query = '  SELECT
                    tipo_cliente
                FROM
                    personaempresa
                WHERE
                    rut = "'.$_GET['Rut'].'"';
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
        $data = array('tipo_cliente' => $data[0]['tipo_cliente']);
        echo json_encode($data);
	}else{
		$data = array('tipo_cliente' => '');
        echo json_encode($data);
	}
 ?>