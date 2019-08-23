<?php 

	include("../../../class/compras/costos/CostoClass.php");

	$Costo = new Costo();
	$nombre = '';
	$personal_id = '';
	$correo = '';
	$direccion = '';
	$telefono = '';
	$codigo_cuenta = '';
	if(isset($_POST['nombre'])){
		$nombre = $_POST['nombre'];
	}
	if(isset($_POST['personal_id'])){
		$personal_id = $_POST['personal_id'];
	}
	if(isset($_POST['correo'])){
		$correo = $_POST['correo'];
	}
	if(isset($_POST['direccion'])){
		$direccion = $_POST['direccion'];
	}
	if(isset($_POST['telefono'])){
		$telefono = $_POST['telefono'];
	}
	if(isset($_POST['codigo_cuenta'])){
		$codigo_cuenta = $_POST['codigo_cuenta'];
	}
	$Costo->CrearCosto($nombre,$personal_id,$correo,$direccion, $telefono, $codigo_cuenta);
	
?>    