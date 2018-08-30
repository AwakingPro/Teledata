<?php 

	include("../../class/nota_venta/NotaVentaClass.php");
	include("../../class/facturacion/uf/UfClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->insertDetalleTmp($_POST['concepto_tmp'],$_POST['cantidad_tmp'],$_POST['precio_tmp'],$_POST['moneda_tmp']);

?>    