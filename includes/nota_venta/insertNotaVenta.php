<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->insertNotaVenta($_POST['personaempresa_id'],$_POST['fecha'],$_POST['numero_oc'],$_POST['fecha_oc'],$_POST['solicitado_por'], $_POST['numero_hes'], $_POST['fecha_hes'], $_POST['ServiciosSeleccionados']);
	
?>     