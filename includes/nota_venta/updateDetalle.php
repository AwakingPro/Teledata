<?php 

	include("../../class/nota_venta/NotaVentaClass.php");
	include("../../class/facturacion/uf/UfClass.php");

	$NotaVenta = new NotaVenta();
	$NotaVenta->updateDetalle($_POST['concepto_update'],$_POST['cantidad_update'],$_POST['precio_update'],$_POST['moneda_update'],$_POST['detalle_id']);

?>    