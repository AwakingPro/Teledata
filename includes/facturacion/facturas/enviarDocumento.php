<?php
    require("../../../plugins/PHPMailer-master/class.phpmailer.php");
    require("../../../plugins/PHPMailer-master/class.smtp.php");
    include('../../../class/email/EmailClass.php');
    include('../../../class/facturacion/facturas/FacturaClass.php');

    $Factura = new Factura();
    $Data = array();
    if(isset($_POST['notacreditoid'])){
        $Data['notacreditoid'] = $_POST['notacreditoid'];
        $Data['UrlPdfBsale'] = $_POST['UrlPdfBsale'];
        $Data['NumeroDocumento'] = $_POST['NumeroDocumento'];
        $_POST['id'] = false;
    }
    $ToReturn = $Factura->enviarDocumento($_POST['id'], $Data);
    
    
    echo $ToReturn;
?>