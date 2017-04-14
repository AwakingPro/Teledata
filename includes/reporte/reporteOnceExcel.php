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
		require_once '../../reporteexcel/lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Luis Ponce") //Autor
		 ->setLastModifiedBy("Luis Ponce") //Ultimo usuario que lo modificó
		 ->setTitle("Reporte 11")
		 ->setSubject("Reporte 11")
		 ->setDescription("Reporte 11")
		 ->setKeywords("Reporte 11")
		 ->setCategory("Reporte 11");

		$tituloReporte = "Reporte 11";
		$titulosColumnas = array('EECC','CICLO','FECHA','HORA','CUENTA','PRODUCTO','RUT','TRAMO CEDENTE','SALDO INI');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',  $titulosColumnas[0])
                    ->setCellValue('B1',  $titulosColumnas[1])
                    ->setCellValue('C1',  $titulosColumnas[2])
                    ->setCellValue('D1',  $titulosColumnas[3])
                    ->setCellValue('E1',  $titulosColumnas[4])
                    ->setCellValue('F1',  $titulosColumnas[5])
                    ->setCellValue('G1',  $titulosColumnas[6])
                    ->setCellValue('H1',  $titulosColumnas[7])
                    ->setCellValue('I1',  $titulosColumnas[8]);
						
		
		//Se agregan los datos de los alumnos
		$i = 2;
		while ($fila = $resultado->fetch_array()) 
		{
			$rut = $fila['2'];
			$dv = $fila['3'];
			$fechaGestion = $fila['0'];
			$horaGestion = $fila['1'];
			$q2 = "SELECT Tramo_Dias_Mora,Monto_Mora,Saldo_Mora,Personalizado5,Cuenta,Id_Cedente FROM Deuda WHERE Rut = $rut AND Id_Cedente IN (45,44,48,49) GROUP BY Rut LIMIT 1";
						$resultado2 = $conexion->query($q2);
            while ($fila2 = $resultado2->fetch_array()) 
			{
                $tramo = $fila2[0];
                $cuenta = $fila2[4];
                $ced = $fila2[5];
                if($ced=='45')
                {
                	$producto ='FIJO';
                }	
                else
                {
                	$producto='MOVIL';
                }	
                $p5 = $fila2[3];
                if($p5=='')
                {
                	$p5=0;
                }
                else
                {
                	$p5=$p5;
                }	
            } 
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$i,  $empresa)
						->setCellValue('B'.$i,  $p5)
						->setCellValue('C'.$i,  $fechaGestion)
						->setCellValue('D'.$i,  $horaGestion)
						->setCellValue('E'.$i,  $cuenta)
						->setCellValue('F'.$i,  $producto)
						->setCellValue('G'.$i,  $rut."-".$dv)
						->setCellValue('H'.$i,  $tramo)
						->setCellValue('I'.$i,  $tramo);
                        

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