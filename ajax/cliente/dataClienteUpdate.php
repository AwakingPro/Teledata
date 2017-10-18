<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;

	$query = 'SELECT * FROM personaempresa WHERE id ='.$_POST['id'];
	$data = $run->select($query);

	$query = 'SELECT * FROM contactos_extras WHERE contactos_extras.IdCliente ='.$_POST['id'];
	$contactos = $run->select($query);

	$query = 'SELECT * FROM correo_extra WHERE correo_extra.IdUsuario ='.$_POST['id'];
	$data = $run->select($query);

	$query = 'SELECT * FROM telefono_extra WHERE telefono_extra.IdUsuario ='.$_POST['id'];
	$data = $run->select($query);

	echo json_encode($data);
?>