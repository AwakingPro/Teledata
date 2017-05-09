<?php 

	include("../../../class/inventario/modelo_producto/ModeloProductoClass.php");

	$ModeloProducto = new ModeloProducto();
	$ModeloProducto->updateModeloProducto($_POST['marca_producto_id'],$_POST['nombre'],$_POST['descripcion'], $_POST['id']);
	
?>    