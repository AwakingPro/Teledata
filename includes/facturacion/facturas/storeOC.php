<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

	$Factura = new Factura();
	$FechaOC = '';
	$FechaHES = '';
	if($_POST['FechaOC']){
		$FechaOC = $_POST['FechaOC'];
		$dt = \DateTime::createFromFormat('d-m-Y',$FechaOC);
		$FechaOC = $dt->format('Y-m-d'); 
	}
	if($_POST['FechaHES']){
		$FechaHES = $_POST['FechaHES'];
		$dt = \DateTime::createFromFormat('d-m-Y',$FechaHES);
		$FechaHES = $dt->format('Y-m-d'); 
	}
	$ToReturn = $Factura->storeOC($_POST['rutidOC'],$_POST['grupoOC'],$_POST['tipoOC'],$_POST['NumeroOC'],$FechaOC, $_POST['NumeroHES'], $FechaHES);
	echo $ToReturn;
?>