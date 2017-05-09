<?php 

	include("../../../class/inventario/marca_producto/MarcaProductoClass.php");

	$MarcaProducto = new MarcaProducto();
	$MarcaProducto->CrearMarcaProducto($_POST['tipo_producto_id'],$_POST['nombre'],$_POST['descripcion']);
	
?>    