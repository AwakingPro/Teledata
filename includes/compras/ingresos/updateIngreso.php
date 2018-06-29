<?php 

	include("../../../class/compras/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->updateIngreso($_POST['tipo_documento_id'],$_POST['numero_documento'],$_POST['fecha_emision'],$_POST['fecha_vencimiento'],$_POST['proveedor_id'],$_POST['centro_costo_id'],$_POST['detalle'],$_POST['total_documento'],$_POST['id']);
	
?>    