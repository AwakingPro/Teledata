<?php
    include('../../../class/facturacion/facturas/FacturaClass.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }else{
        $id = $argv[0];
    }

    $Factura = new Factura();
    $ToReturn = $Factura->descargarDocumentoBsale($id);
    echo $ToReturn;
?>