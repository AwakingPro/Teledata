<?php
	include("../../class/radio/RadioClass.php");

	$Radio = new Radio();
	$Radio->buscarRegistro($_POST['tipo_busqueda_ingreso'],$_POST['input_registro']);

?>