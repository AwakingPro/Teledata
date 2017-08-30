<?php 

	include("../../class/radio/RadioClass.php");

	$Radio = new Radio();
	$Radio->CrearEstacion($_POST['nombre'],$_POST['direccion'],$_POST['telefono'],$_POST['correo'],$_POST['personal_id'],$_POST['contacto'],$_POST['dueno_cerro'],$_POST['latitud_coordenada'],$_POST['longitud_coordenada'],$_POST['latitud_coordenada_site'],$_POST['longitud_coordenada_site'],$_POST['datos_proveedor_electrico']);
	
?>    