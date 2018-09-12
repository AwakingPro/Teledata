<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
	
	if(isset($_POST['Rut'])){
		$Rut = $_POST['Rut'];
	}else{
		$Rut = '';
	}
	

	$Factura = new Factura();
	$Factura->filtrarDocEmitidos($Rut);
	
?>