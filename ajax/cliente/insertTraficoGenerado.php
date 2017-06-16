<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO trafico_generado (LineaTelefonica, Descripcion,IdServivio) VALUES ('".$_POST['linea']."', '".$_POST['descripcion']."','".$_POST['idServicio']."')";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>