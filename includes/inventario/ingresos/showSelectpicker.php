<?php 

	include("../../../class/inventario/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->showSelectpicker($_POST['tipo_busqueda_ingreso']);
	
?>   