<?php
	require_once('../../class/methods_global/methods.php');
	if ($_POST['passUpdate'] == "") {
		$query = "UPDATE usuarios SET usuario='".$_POST['usuarioUpdate']."', nombre='".$_POST['nombreUpdate']."', nivel='".$_POST['nivelUpdate']."', cargo='".$_POST['cargoUpdate']."', email='".$_POST['correoUpdate']."', tipo_usuario='".$_POST['nivelUpdate']."' WHERE id= ".$_POST['idPerfil'];
	}else{
		$clave = password_hash($_POST['passUpdate'], PASSWORD_DEFAULT);
		$query = "UPDATE usuarios SET usuario='".$_POST['usuarioUpdate']."', nombre='".$_POST['nombreUpdate']."', clave='".$clave."', nivel='".$_POST['nivelUpdate']."', cargo='".$_POST['cargoUpdate']."', email='".$_POST['correoUpdate']."', tipo_usuario='".$_POST['nivelUpdate']."' WHERE id= ".$_POST['idPerfil'];
	}
	$run = new Method;
	$data = $run->update($query);
	echo $query;
 ?>