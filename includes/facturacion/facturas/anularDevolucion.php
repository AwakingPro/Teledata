<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$ToReturn = $Factura->anularDevolucion($_POST['id']);
	echo $ToReturn;
?>