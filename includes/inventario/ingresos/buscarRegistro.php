<?php 

	include("../../../class/inventario/ingresos/IngresoClass.php");

	$Ingreso = new Ingreso();
	$Ingreso->buscarRegistro($_POST['tipo_busqueda_ingreso'],$_POST['input_registro']);
	
?>   