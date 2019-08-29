<?php 

	include("../../../class/inventario/modelo_producto/ModeloProductoClass.php");

	$ModeloProducto = new ModeloProducto();
	$ModeloProducto->CrearModeloProducto($_POST['marca_producto_id'], $_POST['nombreMarca'], $_POST['nombre'],$_POST['descripcion']);
	
?>    