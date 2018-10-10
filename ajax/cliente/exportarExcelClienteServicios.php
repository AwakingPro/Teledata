<?php
/** Incluir la libreria PHPExcel */
require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Teledata")
->setLastModifiedBy("Teledata")
->setTitle("Documento Excel de Clientes Teledata")
->setSubject("Documento Excel de Clientes Teledata")
->setDescription("Informe de Clientes y Servicios de Teledata.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Informe Clientes");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'id')
->setCellValue('B1', 'Rut')
->setCellValue('C1', 'DV')
->setCellValue('D1', 'Razon Social')
->setCellValue('E1', 'Teléfono')
->setCellValue('F1', 'Tipo de Cliente')
->setCellValue('G1', 'Fecha de Instalacion')
->setCellValue('H1', 'Estado De Cliente');

foreach (range(0, 33) as $col) {
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}


require_once('../../class/methods_global/methods.php');
	$query = '	SELECT
					p.id,
					p.rut,
					p.dv,
					p.nombre,
					p.telefono,
                    mt.nombre as tipo_cliente,
                    s.FechaInstalacion as fecha,
                    s.EstatusServicio as estatus
                     
				FROM
					personaempresa p 
                INNER JOIN 
					mantenedor_tipo_cliente mt 
				ON 
					p.tipo_cliente = mt.id
				INNER JOIN 
					servicios s 
				ON 
					p.rut = s.Rut
				ORDER BY
					p.nombre';
$run = new Method;
$data = $run->select($query);
if (count($data) > 0) {
    // echo var_dump($data); return;
	$index = 2;
	for ($i=0; $i < count($data) ; $i++) {
        if($data[$i][7] == 1)
        $data[$i][7] = 'Activo';
        else
        $data[$i][7] = 'Inactivo';
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, $data[$i][0])
		->setCellValue('B'.$index, $data[$i][1])
		->setCellValue('C'.$index, $data[$i][2])
		->setCellValue('D'.$index, $data[$i][3])
		->setCellValue('E'.$index, $data[$i][4])
		->setCellValue('F'.$index, $data[$i][5])
		->setCellValue('G'.$index, $data[$i][6])
		->setCellValue('H'.$index, $data[$i][7]);
		$index ++;
	}
}


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Lista de clientes y Servicios');



// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="clientes.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>