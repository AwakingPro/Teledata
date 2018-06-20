<?php 

    include("../../../class/facturacion/uf/UfClass.php");

    $Uf = new Uf();
    $Fecha = date('d-m-Y');
	echo $Uf->getValue($Fecha);
	
?>   