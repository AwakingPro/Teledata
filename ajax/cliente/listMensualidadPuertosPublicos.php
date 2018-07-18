<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		mensualidad_puertos_publicos.IdMensualidadPuertosPublicos as 'Id',
		mensualidad_puertos_publicos.PuertoTCPUDP as 'Puerto TCPUDP',
		mensualidad_puertos_publicos.Descripcion
		FROM
		mensualidad_puertos_publicos
		WHERE
		IdServicio = ".$_POST['id'];
	$run = new Method;
	$lista = $run->listViewDelete($query,$_POST['id'],1);
	echo $lista;
 ?>