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
				echo "listArriendoEquipos.php";
				break;
			case 5:
				echo "listMantecionRed.php";
				break;
			case 4:
				echo "listMensualidIPFija.php";
				break;
			case 3:
				echo "listMensualidadPuertosPublicos.php";
				break;
			case 2:
				echo "listServicioInternet.php";
				break;
			case 6:
				echo "listTraficoGenerado.php";
				break;
			default:
       			echo "404.html";
		}
	}else{
		echo 'false';
	}






?>