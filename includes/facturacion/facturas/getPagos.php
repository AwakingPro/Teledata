<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$ToReturn = $Factura->getPagos($_POST['id']);
	echo json_encode($ToReturn);
?>