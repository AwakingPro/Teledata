<?php 

	include("../../class/tareas/TareaClass.php");
	include("../../class/facturacion/uf/UfClass.php");

	$Tarea = new Tarea();
	$Tarea->updateEstatusServicio($_POST['Id'], $_POST['EstatusServicio']);
	
?>     