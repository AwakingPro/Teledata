<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	mensualidad_direccion_ip_fija.IdMensualidadDireccionIPFija as 'Id',
	mensualidad_direccion_ip_fija.DireccionIPFija as 'Direccion de IP Fija',
	mensualidad_direccion_ip_fija.Descripcion
	FROM
	mensualidad_direccion_ip_fija
	WHERE
	mensualidad_direccion_ip_fija.IdServicio = ".$_POST['id'];
	$run = new Method;
	$lista = $run->listViewDelete($query,$_POST['id'],1);
	echo $lista;
 ?>