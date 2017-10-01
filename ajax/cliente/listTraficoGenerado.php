<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		trafico_generado.IdTraficoGenerado,
		trafico_generado.LineaTelefonica,
		trafico_generado.Descripcion
		FROM
		trafico_generado
		WHERE
		IdServivio = ".$_POST['id'];
	$run = new Method;
	$lista = $run->listViewDelete($query);
	echo $lista;
 ?>