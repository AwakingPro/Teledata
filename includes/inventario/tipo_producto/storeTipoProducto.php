<?php 

	include("../../../class/inventario/tipo_producto/TipoProductoClass.php");

	$TipoProducto = new TipoProducto();
	$TipoProducto->CrearTipoProducto($_POST['nombre'],$_POST['descripcion']);
	
?>    