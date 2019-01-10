<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$ToReturn = $Factura->getPagoNotaCredito($_POST['id']);
	echo json_encode($ToReturn);
?>