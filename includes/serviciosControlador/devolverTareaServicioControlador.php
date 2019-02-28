<?php 

	include("../../class/servicios/serviciosClass.php");

    $Servicio = new Servicio();
    $DatosServicio = array(
        'idServicio' => $_POST['idServicio'],
        'idFactura' => $_POST['idFactura'],
        'TipoFactura' => $_POST['TipoFactura']
    );
	echo $Servicio->devolverTareaServicio($DatosServicio);
	
?>