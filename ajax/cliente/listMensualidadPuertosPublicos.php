<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		mensualidad_puerdo_publicos.IdMensualidadPuertosPublicos as 'Id',
		mensualidad_puerdo_publicos.PuertoTCPUDP as 'Puerto TCPUDP',
		mensualidad_puerdo_publicos.Descripcion
		FROM
		mensualidad_puerdo_publicos
		WHERE
		IdServivio = ".$_POST['id'];
	$run = new Method;
	$lista = $run->listViewDelete($query);
	echo $lista;
 ?>