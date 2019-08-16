<?php 

    /** Incluir la libreria PHPExcel */
    include("../../../plugins/PHPExcel-1.8/Classes/PHPExcel.php");
    include("../../../class/facturacion/facturas/FacturaClass.php");
    
	if(isset($_GET['documentType'])){
		$documentType = $_GET['documentType'];
	}else{
		$documentType = '';
	}
	if(isset($_GET['startDate'])){
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
	}else{
		$startDate = '';
		$endDate = '';
	}
	if(isset($_GET['rut'])){
		$Rut = $_GET['rut'];
	}else{
		$Rut = '';
	}
	if(isset($_GET['NumeroDocumento'])){
		$NumeroDocumento = $_GET['NumeroDocumento'];
	}else{
		$NumeroDocumento = '';
	}
	$Factura = new Factura();
	$Factura->excelDocumentosCliente($startDate, $endDate, $Rut, $documentType, $NumeroDocumento);
	
?>