<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->updateNotaVenta($_POST['fecha'],$_POST['numero_oc'],$_POST['fecha_oc'],$_POST['solicitado_por'],$_POST['nota_venta_id']);
	
?>     