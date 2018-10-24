<?php
	require_once('../class/methods_global/methods.php');
	$run = new Method;
	switch ($_SESSION['idNivel']) {
	    case 1:
	        echo "administrador";
	        break;
	    case 2:
	        echo "soporte";
	        break;
	    case 3:
	        echo "terreno";
	        break;
	}
?>