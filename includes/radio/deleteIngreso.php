<?php 

	include("../../class/radio/RadioClass.php");

	$Radio = new Radio();
	$Radio->deleteIngreso($_POST['id']);
	
?>      