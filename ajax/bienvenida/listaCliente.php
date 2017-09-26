<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "SELECT
		personaempresa.id,
		personaempresa.rut,
		personaempresa.nombre,
		personaempresa.correo,
		personaempresa.comentario
	FROM
			personaempresa
	WHERE
	personaempresa.IdUsuarioSession =".$_SESSION['idUsuario'];
	$run = new Method;
	$lista = $run->listViewSingle($query);
	echo $lista;
 ?>