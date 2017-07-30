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
->setCellValue('A1', 'id')
->setCellValue('B1', 'rut')
->setCellValue('C1', 'dv')
->setCellValue('D1', 'nombre')
->setCellValue('E1', 'giro')
->setCellValue('F1', 'direccion')
->setCellValue('G1', 'correo')
->setCellValue('H1', 'contacto')
->setCellValue('I1', 'comentario')
->setCellValue('J1', 'telefono');

foreach (range(0, 33) as $col) {
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}


require_once('../../class/methods_global/methods.php');
$query = 'SELECT
personaempresa.id,
personaempresa.rut,
personaempresa.dv,
personaempresa.nombre,
personaempresa.giro,
personaempresa.direccion,
personaempresa.correo,
personaempresa.contacto,
personaempresa.comentario,
personaempresa.telefono
FROM
personaempresa';
$run = new Method;
$data = $run->select($query);
if (count($data) > 0) {

	$index = 2;
	for ($i=0; $i < count($data) ; $i++) {

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, $data[$i][0])
		->setCellValue('B'.$index, $data[$i][1])
		->setCellValue('C'.$index, $data[$i][2])
		->setCellValue('D'.$index, $data[$i][3])
		->setCellValue('E'.$index, $data[$i][4])
		->setCellValue('F'.$index, $data[$i][5])
		->setCellValue('G'.$index, $data[$i][6])
		->setCellValue('H'.$index, $data[$i][7])
		->setCellValue('I'.$index, $data[$i][8])
		->setCellValue('J'.$index, $data[$i][9]);
		$index ++;
	}
}


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Lista de clientes');



// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="clientes.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>