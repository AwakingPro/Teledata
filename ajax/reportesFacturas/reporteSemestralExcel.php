<?php
/** Incluir la libreria PHPExcel */
require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Cattivo")
->setLastModifiedBy("Cattivo")
->setTitle("Documento Excel de Prueba")
->setSubject("Documento Excel de Prueba")
->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Pruebas de Excel");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Tipo de Linea')
->setCellValue('B1', 'Nº de Documento')
->setCellValue('C1', 'Monto Neto')
->setCellValue('D1', 'Monto Impuesto')
->setCellValue('E1', 'Monto Total')
->setCellValue('F1', 'Monto Exento')
->setCellValue('G1', 'Lista de Precios')
->setCellValue('H1', 'Tipo de Cambio')
->setCellValue('I1', 'Fecha Emision')
->setCellValue('J1', 'Condicion de Venta')
->setCellValue('K1', 'Fecha de Vencimiento')
->setCellValue('L1', 'Despacho Unimark')
->setCellValue('M1', 'Forma de Pago')
->setCellValue('N1', 'Email Automatico')
->setCellValue('O1', 'Rut Cliente')
->setCellValue('P1', 'Tipo Cliente')
->setCellValue('Q1', 'Clinete Extranjero')
->setCellValue('R1', 'Razon Social')
->setCellValue('S1', 'Giro')
->setCellValue('T1', 'Nombre')
->setCellValue('U1', 'Apellido')
->setCellValue('V1', 'Email')
->setCellValue('W1', 'Telefono')
->setCellValue('X1', 'Direccion')
->setCellValue('Y1', 'Ciudad')
->setCellValue('Z1', 'Comuna')
->setCellValue('AA1', 'Cantidad')
->setCellValue('AB1', 'SKU')
->setCellValue('AC1', 'Glosa')
->setCellValue('AD1', 'Atributos adicionales')
->setCellValue('AE1', 'Valor Unitario')
->setCellValue('AF1', '% Descuento')
->setCellValue('AG1', 'Impuesto')
->setCellValue('AH1', 'Impuesto');

foreach (range(0, 34) as $col) {
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Facturas mensuales');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../../reportes/reporteFacturasSemestral/Factura Semestral '.date("d-m-Y").'.xlsx');
exit;
?>