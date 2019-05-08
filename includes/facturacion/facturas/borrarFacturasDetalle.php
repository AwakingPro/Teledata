<?php 
    include('../../../class/methods_global/methods.php');
	include("../../../class/facturacion/facturas/FacturasDetalleClass.php");

    $FacturasDetalle = new FacturasDetalle();
    $DatosDetalle = array(
        'idDetalle' => $_POST['idDetalle'],
        'idFactura' => $_POST['idFactura'],
        'TipoFactura' => $_POST['TipoFactura']
    );
	echo $FacturasDetalle->BorrarDetalle($DatosDetalle);
	
?>