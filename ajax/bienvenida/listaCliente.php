<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
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
	
	$lista = $run->listViewSingle($query);
	echo $lista;
 ?>