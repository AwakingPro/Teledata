<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT id, rut, dv, nombre, giro, direccion, correo, contacto, comentario, telefono
	FROM
		personaempresa
	WHERE
		rut ='.$_POST['rut'];
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		echo json_encode($data);
	}else{
		echo 'false';
	}
 ?>