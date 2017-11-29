<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;

	$query = 'SELECT * FROM personaempresa WHERE id ='.$_POST['id'];
	$data1 = $run->select($query);

	$query = 'SELECT * FROM contactos_extras WHERE contactos_extras.IdCliente ='.$_POST['id'];
	$data2 = $run->select($query);

	$query = 'SELECT * FROM correo_extra WHERE correo_extra.IdUsuario ='.$_POST['id'];
	$data3 = $run->select($query);

	$query = 'SELECT * FROM telefono_extra WHERE telefono_extra.IdUsuario ='.$_POST['id'];
	$data4 = $run->select($query);

	if(!is_array($data1)){
		$data1 = array();
	}

	if(!is_array($data2)){
		$data2 = array();
	}

	if(!is_array($data3)){
		$data3 = array();
	}

	if(!is_array($data4)){
		$data4 = array();
	}

	echo json_encode(array_merge($data1, $data2, $data3, $data4));
?>