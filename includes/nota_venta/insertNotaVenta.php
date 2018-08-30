<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->insertNotaVenta($_POST['personaempresa_id'],$_POST['fecha_tmp'],$_POST['numero_oc_tmp'],$_POST['fecha_oc_tmp'],$_POST['solicitado_por_tmp']);
	
?>     