<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$ToReturn = $Factura->deletePago($_POST['id']);
	echo $ToReturn;
?>