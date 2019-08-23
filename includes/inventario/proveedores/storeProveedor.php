<?php 

	include("../../../class/inventario/proveedores/ProveedorClass.php");

	$Proveedor = new Proveedor();
	$nombre = '';
	$direccion = '';
	$telefono = '';
	$contacto = '';
	$correo = '';
	$rut = '';

	if(isset($_POST['nombre'])){
		$nombre = $_POST['nombre'];
	}
	if(isset($_POST['direccion'])){
		$direccion = $_POST['direccion'];
	}
	if(isset($_POST['telefono'])){
		$telefono = $_POST['telefono'];
	}
	if(isset($_POST['contacto'])){
		$contacto = $_POST['contacto'];
	}
	if(isset($_POST['correo'])){
		$correo = $_POST['correo'];
	}
	if(isset($_POST['rut'])){
		$rut = $_POST['rut'];
	}
	$Proveedor->CrearProveedor($nombre,$direccion,$telefono,$contacto,$correo, $rut);
	
?>    