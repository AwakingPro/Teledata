<?php
	include("../../class/admin/confMenuClass.php");

	$confMenu = new confMenu();
	$confMenu->crearPrivilegio($_POST['id']);

?>