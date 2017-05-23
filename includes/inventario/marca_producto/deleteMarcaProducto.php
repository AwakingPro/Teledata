<?php 

	include("../../../class/inventario/marca_producto/MarcaProductoClass.php");

	$MarcaProducto = new MarcaProducto();
	$MarcaProducto->deleteMarcaProducto($_POST['id']);
	
?>    