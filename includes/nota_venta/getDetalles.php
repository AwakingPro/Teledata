<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->getDetalles($_POST['id']);
	
?>      