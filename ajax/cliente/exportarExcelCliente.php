<?php
/** Incluir la libreria PHPExcel */
require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Cattivo")
->setLastModifiedBy("Cattivo")
->setTitle("Clientes")
->setSubject("Documento Excel de clientes")
->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Pruebas de Excel");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'id')
->setCellValue('B1', 'Rut')
->setCellValue('C1', 'DV')
->setCellValue('D1', 'Nombre')
->setCellValue('E1', 'Giro')
->setCellValue('F1', 'Direccion')
->setCellValue('G1', 'Correo')
->setCellValue('H1', 'Contacto')
->setCellValue('I1', 'Comentario')
->setCellValue('J1', 'Teléfono')
->setCellValue('K1', 'Tipo de Cliente')
->setCellValue('L1', 'Ciudad');

foreach (range(0, 33) as $col) {
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}


require_once('../../class/methods_global/methods.php');
	$query = '	SELECT
					p.id,
					p.rut,
					p.dv,
					p.nombre,
					p.giro,
					p.direccion,
					p.correo,
					p.contacto,
					p.comentario,
					p.telefono,
					mt.nombre as tipo_cliente,
					ciudades.nombre as ciudad_nombre
				FROM
					personaempresa p 
				INNER JOIN 
					mantenedor_tipo_cliente mt 
				ON 
					p.tipo_cliente = mt.id
				INNER JOIN 
					ciudades
				ON
					p.ciudad = ciudades.id
				ORDER BY
					p.nombre';
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
		->setCellValue('J'.$index, $data[$i][9])
		->setCellValue('K'.$index, $data[$i][10])
		->setCellValue('L'.$index, $data[$i][11]);
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