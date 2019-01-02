<?php 

    include("../../class/personaempresa/PersonaEmpresa.php");

    $clientes = new PersonaEmpresa();
	echo $clientes->SincronizarConBsale();
	
?>   