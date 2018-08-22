<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$Factura->showPrefactura($_POST['rutid'],$_POST['grupo'],$_POST['tipo']);
	
?>