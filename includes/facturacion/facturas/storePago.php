<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
	
	
	$Factura = new Factura();
	$ToReturn = $Factura->storePago($_POST['FacturaId'],$_POST['FechaPago'],$_POST['TipoPago'],$_POST['Monto'],$_POST['FechaEmisionCheque'],$_POST['FechaVencimientoCheque']);
	echo $ToReturn;
?>