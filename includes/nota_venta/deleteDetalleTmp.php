<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->deleteDetalleTmp($_POST['id']);
	
?>      