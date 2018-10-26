<?php 

	include("../../../class/compras/costos/CostoClass.php");

	$Costo = new Costo();
	$Costo->CrearCosto($_POST['nombre'],$_POST['personal_id'],$_POST['correo'],$_POST['direccion'], $_POST['telefono']);
	
?>    