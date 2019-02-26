<?php 

	include("../../../class/facturacion/facturas/FacturasDetalleClass.php");

    $FacturasDetalle = new FacturasDetalle();
    $DatosDetalle = array(
        'idDetalle' => $_POST['idDetalle'],
        'idFactura' => $_POST['idFactura'],
        'TipoFactura' => $_POST['TipoFactura']
    );
    // print_r($DatosDetalle); exit;
	echo $FacturasDetalle->BorrarDetalle($DatosDetalle);
	
?>