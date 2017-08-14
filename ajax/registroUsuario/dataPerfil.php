<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
	usuarios.id,
	usuarios.usuario,
	usuarios.nombre,
	usuarios.clave,
	usuarios.nivel,
	usuarios.cargo,
	usuarios.email,
	usuarios.sexo
	FROM
	usuarios
	WHERE
		usuarios.id ='.$_POST['id'];
	$run = new Method;
	$data = $run->select($query);
	echo json_encode($data);
?>