<?php
	require_once('../../class/methods_global/methods.php');
	$user= mysql_real_escape_string($_POST['usuario']);
	$query = 'SELECT clave, id FROM Usuarios WHERE usuario="'.$user.'"';
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		if (password_verify($_POST['password'], $data[0]['clave'])) {
			session_start();
			$_SESSION['idUsuario'] = $data[0]['id'];
			$array = array(true,'bienvenida/bienvenida.php');
		}else{
			$array = array(false,null);
		}
	}else{
		$array = array(false,null);
	}
	echo json_encode($array);
 ?>