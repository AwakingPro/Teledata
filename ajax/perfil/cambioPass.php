<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = 'SELECT clave FROM Usuarios WHERE id ='.$_SESSION['idUsuario'];
	$run = new Method;
	$data = $run->select($query);

	if (password_verify($_POST['pass'], $data[0]['clave'])) {
		$clave = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
		$query = "UPDATE usuarios SET clave = '".$clave."' WHERE id=".$_SESSION['idUsuario'];
		$run = new Method;
		$data = $run->update($query);
		echo $data;
	}else{
		echo false;
	}
 ?>