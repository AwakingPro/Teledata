<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
		personaempresa.id,
		personaempresa.rut,
		personaempresa.dv,
		personaempresa.nombre,
		personaempresa.giro,
		personaempresa.direccion,
		personaempresa.correo,
		personaempresa.contacto,
		personaempresa.comentario,
		personaempresa.telefono
		FROM
		personaempresa
	WHERE rut ='.$_POST['rut'];
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		echo json_encode($data);
	}else{
		echo 'false';
	}
 ?>