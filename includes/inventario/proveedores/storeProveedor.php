<?php 

	include("../../../class/inventario/proveedores/ProveedorClass.php");

	$Proveedor = new Proveedor();
	$Proveedor->CrearProveedor($_POST['rut'],$_POST['nombre'],$_POST['direccion'],$_POST['telefono'],$_POST['contacto'],$_POST['correo']);
	
?>    