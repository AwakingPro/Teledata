<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = 'SELECT nombre FROM usuarios WHERE id ='.$_SESSION['idUsuario'];
	$run = new Method;
	$data = $run->select($query);
	if (file_exists('../ajax/perfil/img-profile/'.$_SESSION['idUsuario'].'.jpg')) {
		$img = '<img class="img-circle img-user media-object"  src="../ajax/perfil/img-profile/'.$_SESSION['idUsuario'].'.jpg" class="img-lg img-circle" alt="Profile Picture">';
	} else {
		$img =  '<img class="img-circle img-user media-object" src="../img/av1.png" class="img-lg img-circle" alt="Profile Picture">';
	}
	echo json_encode($result);
 ?>