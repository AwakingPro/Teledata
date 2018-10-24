<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$query = 'SELECT clave FROM usuarios WHERE id ='.$_SESSION['idUsuario'];
	$data = $run->select($query);

	if (password_verify($_POST['pass'], $data[0]['clave'])) {
		$clave = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
		$query = "UPDATE usuarios SET clave = '".$clave."' WHERE id=".$_SESSION['idUsuario'];
		$data = $run->update($query);
		echo $data;
	}else{
		echo false;
	}
 ?>