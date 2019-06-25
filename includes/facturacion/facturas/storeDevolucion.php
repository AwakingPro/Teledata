<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
	require("../../../plugins/PHPMailer-master/class.phpmailer.php");
    require("../../../plugins/PHPMailer-master/class.smtp.php");
    include('../../../class/email/EmailClass.php');

	$Factura = new Factura();
	$tipoNotaCredito = $_POST['tipoNotaCredito'];
	$DetallesSeleccionados = false;
	if(isset($tipoNotaCredito) && $tipoNotaCredito == 2){
		if ( !empty($_POST["DetallesSeleccionados"]) ) {

			$DetallesSeleccionados = $_POST["DetallesSeleccionados"];				
		}
	}
	$Factura->storeDevolucion($_POST['FacturaIdDevolucion'],$_POST['Motivo'], $tipoNotaCredito, $DetallesSeleccionados);
	
?>