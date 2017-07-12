<?php
	session_start();
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