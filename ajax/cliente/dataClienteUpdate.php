<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT id, rut, dv, nombre, giro, direccion, correo, contacto, comentario, telefono, tipo_cliente
	FROM
		personaempresa
	WHERE
		id ='.$_POST['id'];
	$run = new Method;
	$data = $run->select($query);
	echo json_encode($data);
?>