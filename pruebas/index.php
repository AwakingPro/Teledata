<?php

$ruta = "/var/www/html/Teledata/facturacion/facturas/3071.pdf";
$tamano = filesize($ruta);
if( $tamano > 0)
	echo 'Existe su tamano es:'.$tamano;
else
    echo 'Su tamano es '.$tamano;

?>