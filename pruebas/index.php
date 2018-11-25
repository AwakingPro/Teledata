<?php

$ruta = 'http://app2.bsale.cl/view/15057/10a523a59113.pdf?sfd=99';

if(  $fileExist)
	echo 'Existe su tamano es:'.filesize($ruta);
else
    echo 'No Existe su tamano es: 0';

?>