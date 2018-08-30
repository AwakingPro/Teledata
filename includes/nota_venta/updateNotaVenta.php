<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->updateNotaVenta($_POST['personaempresa_id_update'],$_POST['fecha_update'],$_POST['numero_oc_update'],$_POST['fecha_oc_update'],$_POST['solicitado_por_update'],$_POST['nota_venta_id']);
	
?>     