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
	->setCellValue('B1', 'Fecha')
	->setCellValue('C1', 'Rut')
	->setCellValue('D1', 'Giro')
	->setCellValue('E1', 'Contacto')
	->setCellValue('F1', 'Direccion')
	->setCellValue('G1', 'Numero de OC')
	->setCellValue('H1', 'Solicitado Por')
	->setCellValue('H1', 'Lugar de Retiro');


foreach (range(0, 7) as $col) {
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}


$id = $_GET['id'];

require_once('../../class/methods_global/methods.php');
$query = "SELECT * FROM nota_venta where id = '$id'";
$run = new Method;
$nota_venta = $run->select($query);

if (count($nota_venta) > 0) {

	$rut = $nota_venta[0][1];

	$query = "SELECT * FROM personaempresa where rut = '$rut'";
	$run = new Method;
	$cliente = $run->select($query);

	if (count($cliente) > 0) {
		$index = 2;

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, $cliente[0][3])
		->setCellValue('B'.$index, $nota_venta[0][2])
		->setCellValue('C'.$index, $rut)
		->setCellValue('D'.$index, $cliente[0][4])
		->setCellValue('E'.$index, $cliente[0][7])
		->setCellValue('F'.$index, $cliente[0][5])
		->setCellValue('G'.$index, $nota_venta[0][3])
		->setCellValue('H'.$index, $nota_venta[0][4])
		->setCellValue('H'.$index, $nota_venta[0][5]);
	}

	$index = 5;

	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, 'Código')
		->setCellValue('B'.$index, 'Servicio')
		->setCellValue('C'.$index, 'Cantidad')
		->setCellValue('D'.$index, 'Precio')
		->setCellValue('E'.$index, 'Indic Exención')
		->setCellValue('F'.$index, 'Total');

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

            if($detalle['exencion'] == 1){
                $imp_exencion = 'Afecto';
                $iva = $iva + $impuesto;
            }else{
                $imp_exencion = 'No Afecto';
            }

            $precio = floatval($detalle['precio']);
            $total_tmp = floatval($detalle['total']);
            $total = $total + $total_tmp;

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$index, $detalle['codigo'])
			->setCellValue('B'.$index, $detalle['servicio'])
			->setCellValue('C'.$index, $detalle['cantidad'])
			->setCellValue('D'.$index, floatval($detalle['precio']))
			->setCellValue('E'.$index, $imp_exencion)
			->setCellValue('F'.$index, floatval($detalle['total']));
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