<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		trafico_generado.IdTraficoGenerado as 'Id',
		trafico_generado.LineaTelefonica as 'Linea Telefonica',
		trafico_generado.Descripcion
		FROM
		trafico_generado
		WHERE
		IdServicio = ".$_POST['id'];
	$run = new Method;
	$lista = $run->listViewDelete($query,$_POST['id'],1);
	echo $lista;
 ?>