<?php 

	include("../../class/radio/RadioClass.php");

	$Radio = new Radio();
	$Radio->CrearEstacion($_POST['nombre'],$_POST['direccion'],$_POST['telefono'],$_POST['correo'],$_POST['personal_id']);
	
?>    