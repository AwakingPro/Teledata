<?php 

	include("../../class/radio/RadioClass.php");

	$Radio = new Radio();
	$Radio->updateIngreso($_POST['estacion_id'],$_POST['funcion'],$_POST['alarma_activada'],$_POST['direccion_ip'],$_POST['puerto_acceso'],$_POST['ancho_canal'],$_POST['frecuencia'],$_POST['tx_power'],$_POST['producto_id'],$_POST['id']);
	
?>    