<?php 

	include("../../../class/compras/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->storeIngreso($_POST['numero_factura'],$_POST['fecha_emision_factura'],$_POST['proveedor_id'],$_POST['estado_id'],$_POST['centro_costo_id'],$_POST['numero_detalle'],$_POST['fecha_detalle'],$_POST['detalle_factura'],$_POST['monto']);
	
?>    