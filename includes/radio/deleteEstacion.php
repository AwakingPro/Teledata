<?php 

	include("../../class/radio/RadioClass.php");

	$Radio = new Radio();
	$Radio->deleteEstacion($_POST['id']);
	
?>      