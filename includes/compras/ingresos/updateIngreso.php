<?php 

	include("../../../class/compras/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->updateIngreso($_POST['numero_factura'],$_POST['fecha_emision_factura'],$_POST['proveedor_id'],$_POST['estado_id'],$_POST['centro_costo_id'],$_POST['id']);
	
?>    