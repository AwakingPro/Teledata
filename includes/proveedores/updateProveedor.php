<?php 

	include("../../class/proveedores/ProveedorClass.php");

	$Proveedor = new Proveedor();
	$Proveedor->updateProveedor($_POST['nombre'],$_POST['direccion'],$_POST['telefono'],$_POST['contacto'],$_POST['correo'], $_POST['id']);
	
?>    