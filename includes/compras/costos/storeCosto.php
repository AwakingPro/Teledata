<?php 

	include("../../../class/compras/costos/CostoClass.php");

	$Costo = new Costo();
	$Costo->CrearCosto($_POST['nombre'],$_POST['direccion'],$_POST['telefono'],$_POST['personal_id'],$_POST['correo']);
	
?>    