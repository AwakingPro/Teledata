<?php
    require("../../../plugins/PHPMailer-master/class.phpmailer.php");
    require("../../../plugins/PHPMailer-master/class.smtp.php");
    include('../../../class/email/EmailClass.php');
    include('../../../class/facturacion/facturas/FacturaClass.php');

    $Factura = new Factura();
    $ToReturn = $Factura->enviarDocumento($_POST['id']);
    echo $ToReturn;
?>