<?php 

	include("../../class/radio/RadioClass.php");

	$Radio = new Radio();
	$Radio->CrearEstacion($_POST['nombre'],$_POST['direccion'],$_POST['telefono'],$_POST['personal_id'],$_POST['correo']);
	
?>    