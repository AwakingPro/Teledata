<?php 

	// include("/var/www/html/Teledata/class/facturacion/facturas/FacturaClass.php");
	require("../../../plugins/PHPMailer-master/class.phpmailer.php");
    require("../../../plugins/PHPMailer-master/class.smtp.php");
    include('../../../class/email/EmailClass.php');
	include("../../../class/facturacion/facturas/FacturaClass.php");
	$Factura = new Factura();
	echo $Factura->verificarDocumentosEmitidos();
?>