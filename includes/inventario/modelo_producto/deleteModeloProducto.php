<?php 

	include("../../../class/inventario/modelo_producto/ModeloProductoClass.php");

	$ModeloProducto = new ModeloProducto();
	$ModeloProducto->deleteModeloProducto($_POST['id']);
	
?>    