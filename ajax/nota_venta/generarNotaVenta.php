<?php
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header("Content-Disposition: attachment; filename=\"Nota de Venta ".date('d-m-Y').".xlsx\"");
	header("Cache-Control: max-age=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Description: File Transfer");
	header("Content-Transfer-Encoding: Binary");

	/** Incluir la libreria PHPExcel */
	require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';

	require_once('../../class/methods_global/methods.php');
	$run = new Method;

	$id = $_GET['id'];
	if(!$id){
		echo 'No hay ID definido';
		return;
	}
	$query = "SELECT * FROM nota_venta where id = '$id'";
	$nota_venta = $run->select($query);

	if (count($nota_venta) > 0) {

		// Crea un nuevo objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Establecer propiedades
		$objPHPExcel->getProperties()
			->setCreator("Teledata")
			->setLastModifiedBy("Teledata")
			->setTitle("Nota de Venta")
			->setSubject("Nota de Venta")
			->setDescription("Nota de Venta.")
			->setKeywords("Excel Office 2007 openxml php")
			->setCategory("Nota de Venta");

		// Agregar Informacion
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'Cliente')
			->setCellValue('B1', 'Rut')
			->setCellValue('C1', 'Giro')
			->setCellValue('D1', 'Contacto')
			->setCellValue('E1', 'Direccion')
			->setCellValue('F1', 'Fecha')
			->setCellValue('G1', 'Numero de OC')
			->setCellValue('H1', 'Solicitado Por');

		foreach (range(0, 7) as $col) {
			$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
		}

		$rut = $nota_venta[0]['rut'];
		$query = "SELECT * FROM personaempresa where rut = '$rut'";
		$run = new Method;
		$cliente = $run->select($query);

		if (count($cliente) > 0) {
			$index = 2;

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$index, $cliente[0]['nombre'])
			->setCellValue('B'.$index, $cliente[0]['rut'])
			->setCellValue('C'.$index, $cliente[0]['giro'])
			->setCellValue('D'.$index, $cliente[0]['contacto'])
			->setCellValue('E'.$index, $cliente[0]['direccion'])
			->setCellValue('F'.$index, $nota_venta[0]['fecha'])
			->setCellValue('G'.$index, $nota_venta[0]['numero_oc'])
			->setCellValue('H'.$index, $nota_venta[0]['solicitado_por']);
		}

		$index = 5;

		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$index, 'Concepto')
			->setCellValue('B'.$index, 'Cantidad')
			->setCellValue('C'.$index, 'Precio')
			->setCellValue('D'.$index, 'Total');

		$index = 7;

		$query = "SELECT * FROM nota_venta_detalle where nota_venta_id = '$id'";
		$run = new Method;
		$nota_venta_detalle = $run->select($query);

		if (count($nota_venta_detalle) > 0) {

			$neto = 0;
			$exencion = 0;
			$iva = 0;
			$total = 0;

			foreach($nota_venta_detalle as $detalle){

				$cantidad = intval($detalle['cantidad']);
				$neto_tmp = floatval($detalle['precio']);
				$neto_tmp = $neto_tmp * $cantidad;
				$impuesto = $neto_tmp * floatval(0.19);
				$neto = $neto + $neto_tmp;
				$iva = $iva + $impuesto;

				$precio = floatval($detalle['precio']);
				$total_tmp = floatval($detalle['total']);
				$total = $total + $total_tmp;

				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$index, $detalle['concepto'])
				->setCellValue('B'.$index, $detalle['cantidad'])
				->setCellValue('C'.$index, floatval($detalle['precio']))
				->setCellValue('D'.$index, floatval($detalle['total']));
				$index++;
			}

			$index = $index + 2;

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('E'.$index, 'Neto')
			->setCellValue('F'.$index, $neto);

			$index++;

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('E'.$index, 'I.V.A.')
			->setCellValue('F'.$index, $iva);

			$index++;

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('E'.$index, 'Total')
			->setCellValue('F'.$index, $total);

			$index++;
		}
		
	}else{
		echo 'Error, nota de venta no existe';
		return;
	}

	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('Nota de Venta');

	// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
	$objPHPExcel->setActiveSheetIndex(0);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	// $objWriter->save('../../reportes/nota_venta/Nota de Venta '.date("d-m-Y").'.xlsx');
	$objWriter->save('php://output');
	exit;
?>