<?php 

	include("../../../class/inventario/proveedores/ProveedorClass.php");

	$Proveedor = new Proveedor();
	$Proveedor->showProveedor($_POST['id']);
	
?>    