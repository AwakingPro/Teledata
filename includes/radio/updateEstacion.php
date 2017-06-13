<?php 

	include("../../class/radio/RadioClass.php");

	$Radio = new Radio();
	$Radio->updateEstacion($_POST['nombre'],$_POST['direccion'],$_POST['telefono'],$_POST['personal_id'],$_POST['correo'], $_POST['id']);
	
?>      