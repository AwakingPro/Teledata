<?php
	require_once('../../class/methods_global/methods.php');
	$query = '  SELECT
                    *
                FROM
                    servicio_internet
                WHERE
                    IdServInternet = "'.$_POST['id'].'"';
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
        echo json_encode($data);
	}else{
		echo json_encode(array());
	}
 ?>