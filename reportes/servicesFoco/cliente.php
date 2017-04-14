<?php 
include('libs/nusoap-0.9.5/lib/nusoap.php');
$client = new nusoap_client('http://201.217.248.19/reportes/servicesFoco/inicioServicesReportesFoco.php?wsdl','wsdl');

$err = $client->getError();
if ($err) {	echo 'Error en Constructor' . $err ; }


$param = array('nombre' => 'nelson','param_txt' => 'DVD');
$result = $client->call('login', $param);

if ($client->fault) {
	echo 'Fallo';
	print_r($result);
} else {	// Chequea errores
	$err = $client->getError();
	if ($err) {		// Muestra el error
		echo 'Error' . $err ;
	} else {		// Muestra el resultado
		echo 'Resultado';
		print_r ($result);
	}
}
?>