<?php 

	include("../../class/nota_venta/NotaVentaClass.php");
	include("../../class/facturacion/uf/UfClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->insertDetalle($_POST['concepto'],$_POST['cantidad'],$_POST['precio'],$_POST['moneda']);

?>    