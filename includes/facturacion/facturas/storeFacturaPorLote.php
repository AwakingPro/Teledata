<?php 

	include("../../../class/facturacion/facturas/FacturaClass.php");
	require("../../../plugins/PHPMailer-master/class.phpmailer.php");
    require("../../../plugins/PHPMailer-master/class.smtp.php");
    include('../../../class/email/EmailClass.php');

	$Factura = new Factura();
	$Factura->storeFacturaPorLote($_POST['facturas']);
	
?>