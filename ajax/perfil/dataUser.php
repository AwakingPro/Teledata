<?php
	require_once('../../class/methods_global/methods.php');
	
	$query = 'SELECT
	usuarios.id,
	usuarios.usuario,
	usuarios.nombre,
	usuarios.email,
	usuarios.sexo,
	usuarios.cargo,
	nivel_privilegio.Nombre
	FROM
	usuarios
	INNER JOIN nivel_privilegio ON usuarios.nivel = nivel_privilegio.IdNivelPrivilegio
	WHERE
		id ='.$_SESSION['idUsuario'];
	$run = new Method;
	$data = $run->select($query);

	if (file_exists('img-profile/'.$_SESSION['idUsuario'].'.jpg')) {
		array_push($data, '<img src="../ajax/perfil/img-profile/'.$_SESSION['idUsuario'].'.jpg" class="img-lg img-circle" alt="Profile Picture">');
	} else {
		array_push($data, '<img src="../img/av1.png" class="img-lg img-circle" alt="Profile Picture">');
	}

	echo json_encode($data);


?>