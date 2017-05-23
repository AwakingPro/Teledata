<?php 

	include("../../../class/inventario/tipo_producto/TipoProductoClass.php");

	$TipoProducto = new TipoProducto();
	$TipoProducto->deleteTipoProducto($_POST['id']);
	
?>    