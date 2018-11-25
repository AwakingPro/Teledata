<?php

$ruta = "/var/www/html/Teledata/facturacion/facturas/3072.pdf";
$tamano = filesize($ruta);
if( $ruta)
	echo 'Existe su tamano es:'.$tamano;
else
    echo 'No Existe la ruta'.$ruta;

?>