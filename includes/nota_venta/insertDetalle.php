<?php 

	include("../../class/nota_venta/NotaVentaClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->insertDetalle($_POST['concepto'],$_POST['cantidad'],$_POST['precio'],$_POST['rut_tmp']);

?>    