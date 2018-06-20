<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	usuarios.id as '#',
	usuarios.usuario as Usuario,
	usuarios.nombre as Nombre,
	usuarios.cargo as Cargo,
	nivel_privilegio.Nombre as Rol
	FROM
	usuarios
	INNER JOIN nivel_privilegio ON usuarios.nivel = nivel_privilegio.IdNivelPrivilegio";
	$run = new Method;
	$lista = $run->listViewUsuarios($query);
	echo $lista;
 ?>