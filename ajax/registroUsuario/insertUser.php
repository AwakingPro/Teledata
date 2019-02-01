<?php
	require_once('../../class/methods_global/methods.php');
	$clave = password_hash($_POST['pass'], PASSWORD_DEFAULT);
	$usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : "";
	$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : "";
	$correo = isset($_POST['correo']) ? trim($_POST['correo']) : "";
	$privilegio = $_POST['nivel'];

	$query = " INSERT INTO usuarios (usuario, nombre, clave, nivel, cargo, email, sexo, tipo_usuario) 
	VALUES ('".$usuario."', '".$nombre."', '".$clave."', '".$privilegio."', '".$_POST['cargo']."', '".$correo."', '', '".$privilegio."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data;
 ?>


