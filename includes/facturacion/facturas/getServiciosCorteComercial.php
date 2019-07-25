<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");

    $Servicios = new Factura();
    
    if(isset($_POST['Rut'])){
		$Rut = $_POST['Rut'];
	}else{
		$Rut = '';
    }

    $ToReturn = $Servicios->getServiciosCorteComercial($Rut);
    echo $ToReturn;
	
?>