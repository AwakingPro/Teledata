<?php 

	include("../../../class/compras/costos/CostoClass.php");

	$Costo = new Costo();
	$correo = '';
	$telefono = '';
	if(isset($_POST['correo'])){
		$correo = $_POST['correo'];
	}
	if(isset($_POST['telefono'])){
		$telefono = $_POST['telefono'];
	}
	$Costo->CrearCosto($_POST['nombre'],$_POST['personal_id'],$correo,$_POST['direccion'], $telefono, $_POST['codigo_cuenta']);
	
?>    