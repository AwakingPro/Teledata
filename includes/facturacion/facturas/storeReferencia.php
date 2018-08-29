<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$ToReturn = $Factura->storeReferencia($_POST['rutidReferencia'],$_POST['grupoReferencia'],$_POST['tipoReferencia'],$_POST['Referencia']);
	echo $ToReturn;
?>