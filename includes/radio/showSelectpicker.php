<?php
	include("../../class/radio/RadioClass.php");

	$Radio = new Radio();
	$Radio->showSelectpicker($_POST['tipo_busqueda_ingreso']);

?>