<?php 

	include("../../class/tareas/TareaClass.php");

	$Tarea = new Tarea();
	$Tarea->showTarea($_POST['id']);
	
?>     