<?php
	require_once('../../class/methods_global/methods.php');
	$clave = password_hash($_POST['pass'], PASSWORD_DEFAULT);
	$query = "INSERT INTO usuarios (usuario, nombre, clave, nivel, cargo, email) VALUES ('".$_POST['usuario']."', '".$_POST['nombre']."', '".$clave."', '".$_POST['previlegios']."', '".$_POST['cargo']."', '".$_POST['correo']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data;
 ?>