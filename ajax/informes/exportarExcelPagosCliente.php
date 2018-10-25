<?php
/** Incluir la libreria PHPExcel */
require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';
require_once ('../../class/methods_global/methods.php');

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
	->setCreator("Teledata")
	->setLastModifiedBy("Teledata")
	->setTitle("Informe de Pagos por Cliente")
	->setSubject("Informe de Pagos por Cliente")
	->setDescription("Informe de Pagos Mensuales y Anuales")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Informe de Pagos por Cliente");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'Nº')
	->setCellValue('B1', 'Nombre De Cliente')
	->setCellValue('C1', 'Documento')
	->setCellValue('D1', 'Nº Doc')
	->setCellValue('E1', 'Fecha Doc')
    ->setCellValue('F1', 'Monto')
    ->setCellValue('G1', 'Saldo')
    ->setCellValue('H1', 'Modalidad de Pago')
	->setCellValue('I1', 'Glosa')
    ->setCellValue('J1', 'Monto Pagado')
    ->setCellValue('K1', 'Fecha De Pago');


foreach (range(0, 10) as $col) {
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}

$rut = '';


$query = "  SELECT
                (SELECT SUM( Total ) FROM facturas_detalle WHERE FacturaId = facturas.Id ) AS Total,
                facturas.Id,
                facturas.NumeroDocumento, 
                facturas.FechaFacturacion,
                facturas_pagos.Detalle as Detalle,
                personaempresa.nombre AS Cliente,
                facturas_pagos.FechaPago AS FechaPago,
                facturas_pagos.Monto AS Pagado,
                mt.nombre AS tipo_Factura
            FROM
                facturas
                INNER JOIN facturas_pagos ON facturas_pagos.FacturaId = facturas.Id
                LEFT JOIN personaempresa ON personaempresa.rut = facturas.Rut
                INNER JOIN mantenedor_tipo_cliente mt ON facturas.TipoDocumento = mt.id
            WHERE
                facturas.EstatusFacturacion = '1' ";

if(isset($_GET['rut']) && $_GET['rut'] != '') {
    $rut = $_GET['rut'];
    $query .= "AND personaempresa.rut = '".$rut."' ";
}else{
    echo 'Debe seleccionar un Cliente';
    return;
}
                
$run = new Method;
$documentos = $run->select($query);
$Total = 0;

if (count($documentos) > 0) {
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
        ->setCellValue('G'.$index, 'Saldo')
        ->setCellValue('H'.$index, 'Modalidad Pago')
        ->setCellValue('I'.$index, $documento['Detalle'])
        ->setCellValue('J'.$index, $documento['Pagado'])
        ->setCellValue('K'.$index, $FechaPago);
        
        $Total += $documento['Pagado'];

		$index++;
    }
    
    $index++;
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('J'.$index, $Total);

}else{
    echo 'No existen datos para esta consulta';
    return;
}

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Informe de Pagos por Cliente');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=Informe de Pagos por Cliente.xlsx');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>