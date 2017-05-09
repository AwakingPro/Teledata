<?php 

	include("../../../class/inventario/tipo_producto/TipoProductoClass.php");

	$TipoProducto = new TipoProducto();
	$TipoProducto->updateTipoProducto($_POST['nombre'],$_POST['descripcion'], $_POST['id']);
	
?>    