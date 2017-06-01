<?php 

	include("../../../class/inventario/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->showReporte($_POST['bodega_tipo'],$_POST['bodega_id'],$_POST['modelo_producto_id']);
	
?>    