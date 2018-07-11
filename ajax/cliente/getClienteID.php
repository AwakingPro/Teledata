<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT id
	FROM
		personaempresa
	WHERE
		rut ='.$_POST['Rut'];
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
        echo $data[0]['id'];
    }else{
        echo false;
    }
?>