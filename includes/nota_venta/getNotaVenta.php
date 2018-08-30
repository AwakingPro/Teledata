<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->getNotaVenta($_POST['id']);
	
?>      