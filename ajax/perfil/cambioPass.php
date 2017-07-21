<?php
	require_once('../../class/methods_global/methods.php');
	$query = "UPDATE usuarios SET usuario='".$_POST['Usuario']."', nombre='".$_POST['Nombre']."', email='".$_POST['Correo']."' WHERE id=".$_SESSION['idUsuario'];
	$run = new Method;
	$data = $run->update($query);
	echo $data;

 ?>