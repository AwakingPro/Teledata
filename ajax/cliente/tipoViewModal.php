<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
		servicios.IdServicio
		FROM
		servicios
		WHERE
		servicios.Id = '.$_POST['id'];
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		switch ($data[0][0]) {
			case 1:
				echo "arriendoEquipos.php";
				break;
			case 2:
				echo "mantencionRed.php";
				break;
			case 3:
				echo "mensualidadIPFija.php";
				break;
			case 4:
				echo "mensualidadPuertoPublicos.php";
				break;
			case 5:
				echo "servicioInternet.php";
				break;
			case 6:
				echo "traficoGenerado.php";
				break;
			default:
       			echo "404.html";
		}
	}else{
		echo 'false';
	}






?>