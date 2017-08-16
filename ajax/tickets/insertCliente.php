<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$query = "INSERT INTO personaempresa_extra (rut, dv, nombre, giro, direccion, correo, contacto, comentario, telefono) VALUES ('".$_POST['Rut']."', '".$_POST['Dv']."', '".$_POST['Nombre']."', '".$_POST['Giro']."', '".$_POST['DireccionComercial']."', '".$_POST['Correo']."', '".$_POST['Contacto']."', '".$_POST['Comentario']."', '".$_POST['Telefono']."')";
	$run = new Method;
	$data = $run->insert($query);
	$option = "<option value='".$_POST['Rut']."'>".$_POST['Rut']." - ".$_POST['Nombre']."</option>";
	echo  json_encode(array($data,$option,$_POST['Rut']));
 ?>