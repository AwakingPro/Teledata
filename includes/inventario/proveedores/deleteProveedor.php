<?php 

	include("../../../class/inventario/proveedores/ProveedorClass.php");

	$Proveedor = new Proveedor();
	$Proveedor->deleteProveedor($_POST['id']);
	
?>    