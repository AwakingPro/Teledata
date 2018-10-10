<?php
/** Incluir la libreria PHPExcel */
require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';
require_once('../../class/methods_global/methods.php');

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
	->setCreator("Teledata")
	->setLastModifiedBy("Teledata")
	->setTitle("Informe de Pagos Mensuales y Anuales")
	->setSubject("Informe de Pagos Mensuales y Anuales")
	->setDescription("Informe de Pagos Mensuales y Anuales")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Informe de Pagos Mensuales y Anuales");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'Nº')
	->setCellValue('B1', 'Nombre De Cliente')
	->setCellValue('C1', 'Documento')
	->setCellValue('D1', 'Nº Doc')
	->setCellValue('E1', 'Fecha Doc')
	->setCellValue('F1', 'Monto')
	->setCellValue('G1', 'Glosa')
    ->setCellValue('H1', 'Monto Pagado')
    ->setCellValue('I1', 'Fecha De Pago');


foreach (range(0, 7) as $col) {
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}

if(isset($_GET['startDate']) && isset($_GET['endDate'])){
    $startDate = $_GET['startDate'];
    $dt = \DateTime::createFromFormat('d-m-Y',$startDate);
    $startDate = $dt->format('Y-m-d');
    $endDate = $_GET['endDate'];
    $dt = \DateTime::createFromFormat('d-m-Y',$endDate);
    $endDate = $dt->format('Y-m-d');
}else{
    echo 'Debe seleccionar un rango de fecha';
    return;
}

$query = "  SELECT
                facturas_detalle.Total,
                facturas_detalle.Concepto,
                facturas.Id,
                facturas.NumeroDocumento,
                facturas.FechaFacturacion,
                personaempresa.nombre AS Cliente,
                facturas_pagos.FechaPago as FechaPago,
                facturas_pagos.Monto as Pagado,
                mt.nombre as tipo_Factura
                
            FROM
                facturas_detalle
                INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id
                INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                INNER JOIN facturas_pagos ON facturas_pagos.FacturaId = facturas_detalle.FacturaId
                INNER JOIN mantenedor_tipo_cliente mt ON facturas.TipoDocumento = mt.id
    
            WHERE
                facturas_detalle.Total > 0 
                AND facturas.EstatusFacturacion = '1'
                AND facturas.FechaFacturacion BETWEEN '".$startDate."' AND '".$endDate."'";

$run = new Method;
$documentos = $run->select($query);
$Total = 0;
// echo '<pre>'; print_r($ingresos); echo '</pre>';


if (count($documentos) > 0) {
    // var_dump($documentos); return;
	$index = 2;

	foreach($documentos as $documento){
        
        $FechaFacturacion = \DateTime::createFromFormat('Y-m-d',$documento['FechaFacturacion'])->format('d-m-Y');
        $FechaPago = \DateTime::createFromFormat('Y-m-d',$documento['FechaPago'])->format('d-m-Y');
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, $documento['Id'])
		->setCellValue('B'.$index, $documento['Cliente'])
		->setCellValue('C'.$index, $documento['tipo_Factura'])
		->setCellValue('D'.$index, $documento['NumeroDocumento'])
		->setCellValue('E'.$index, $FechaFacturacion)
		->setCellValue('F'.$index, $documento['Total'])
		->setCellValue('G'.$index, $documento['Concepto'])
        ->setCellValue('H'.$index, $documento['Pagado'])
        ->setCellValue('I'.$index, $FechaPago);
        
        $Total += $documento['Total'];

		$index++;
    }
    
    $index++;
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('H'.$index, $Total);

}else{
    echo 'No existen datos para esta consulta';
    return;
}

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Informe de Pagos');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=Informe de Pagos ".$_GET['startDate']." al ".$_GET['endDate'].".xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>