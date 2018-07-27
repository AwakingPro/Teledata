<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "SELECT
		id,
		rut,
		nombre,
		correo,
		comentario
	FROM
		personaempresa
	WHERE
	id_usuario_sistema = ".$_SESSION['idUsuario'];
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;
 ?>