<?php

    $conexion = new mysqli('192.168.1.122','root','s9q7l5.,777','foco',3306);
	if (mysqli_connect_errno()) 
	{
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}
	//Constantes
	$empresa = 'COBRANDING';

	$consulta = "SELECT g.fecha_gestion,g.hora_gestion,g.rut_cliente , p.Digito_Verificador,g.resultado ,g.resultado_n2,g.resultado_n3 , g.cedente FROM gestion_ult_semestre   g , Persona p  WHERE g.fecha_gestion = '2017-03-03' AND cedente IN (45,44,48,49) AND g.rut_cliente = p.Rut ";
	$resultado = $conexion->query($consulta);
	if($resultado->num_rows > 0 )
	{			
		date_default_timezone_set('America/Santiago');
		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once '../reporteexcel/lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Luis Ponce") //Autor
		 ->setLastModifiedBy("Luis Ponce") //Ultimo usuario que lo modificó
		 ->setTitle("Reporte de Trafico")
		 ->setSubject("Reporte de Trafico")
		 ->setDescription("Reporte de Trafico")
		 ->setKeywords("Reporte de Trafico")
		 ->setCategory("Reporte de Trafico");

		$tituloReporte = "Reporte de Trafico";
		$titulosColumnas = array('EMPRESA','FECHA GESTION','BUENA');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',  $titulosColumnas[0])
                    ->setCellValue('B1',  $titulosColumnas[1])
                    ->setCellValue('C1',  $titulosColumnas[2]);
						
		
		//Se agregan los datos de los alumnos
		$i = 2;
		while ($fila = $resultado->fetch_array()) 
		{
			$rut = $fila['2'];
			$q2 = "SELECT Tramo_Dias_Mora,Monto_Mora,Saldo_Mora FROM Deuda WHERE Rut = $rut AND Id_Cedente IN (45,44,48,49) GROUP BY Rut LIMIT 1";
						$resultado2 = $conexion->query($q2);
            while ($fila2 = $resultado2->fetch_array()) 
			{
                $tramo = $fila2[0];
            } 
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$i,  $empresa)
						->setCellValue('B'.$i,  $fila['0'])
                        ->setCellValue('C'.$i,  $tramo);

			$i++;
		}

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('REPORTE 11');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=reportedetrafico.xlsx");
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
	}
	else
	{
		print_r('No hay resultados para mostrar');
	}

?>