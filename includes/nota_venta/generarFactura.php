<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$Radio = new NotaVenta();
	$Radio->generarFactura($_POST['id']);
	
?>