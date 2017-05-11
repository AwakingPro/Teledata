<?php 

	include("../../../class/inventario/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->storeIngreso($_POST['fecha_compra'],$_POST['fecha_ingreso'],$_POST['numero_factura'], $_POST['modelo_producto_id'],$_POST['proveedor_id'],$_POST['valor'],$_POST['cantidad'], $_POST['bodega_id']);
	
?>    