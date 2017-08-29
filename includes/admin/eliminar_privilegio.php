<?php
	include("../../class/admin/confMenuClass.php");

	$confMenu = new confMenu();
	$confMenu->eliminarPrivilegio($_POST['id']);

?>