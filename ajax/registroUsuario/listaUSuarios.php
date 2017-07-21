<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	usuarios.id,
	usuarios.usuario,
	usuarios.nombre,
	usuarios.cargo,
	nivel_privilegio.Nombre
	FROM
	usuarios
	INNER JOIN nivel_privilegio ON usuarios.nivel = nivel_privilegio.IdNivelPrivilegio";
	$run = new Method;
	$lista = $run->listViewUsuarios($query);
	echo $lista;
 ?>