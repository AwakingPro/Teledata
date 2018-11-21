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
->setCellValue('A1', 'Rut')
->setCellValue('B1', 'DV')
->setCellValue('C1', 'Razon Social')
->setCellValue('D1', 'Teléfono')
->setCellValue('E1', 'Tipo de Cliente')
->setCellValue('F1', 'Fecha de Instalacion')
->setCellValue('G1', 'Estado Del Servicio');

foreach (range(0, 33) as $col) {
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}

require_once('../../class/methods_global/methods.php');
	$query = "SELECT
				p.rut,
				p.dv,
				p.nombre AS 'Razón Social',
				p.telefono,
				mt.nombre AS tipo_cliente,
				s.FechaInstalacion AS fechaInstalacion
			FROM
				personaempresa p
				INNER JOIN mantenedor_tipo_cliente mt ON p.tipo_cliente = mt.id
				LEFT JOIN servicios s ON s.Rut = p.rut ";

$rut = '';
if(isset($_GET['rut']) && $_GET['rut'] != '') {
    $rut = $_GET['rut'];
	$query .= " WHERE p.rut = '".$rut."' ";
}

if(isset($_GET['startDate']) && $_GET['startDate'] != '' && isset($_GET['endDate']) && $_GET['endDate'] != ''){
    $startDate = $_GET['startDate'];
    $dt = \DateTime::createFromFormat('d-m-Y',$startDate);
    $startDate = $dt->format('Y-m-d');
    $endDate = $_GET['endDate'];
    $dt = \DateTime::createFromFormat('d-m-Y',$endDate);
	$endDate = $dt->format('Y-m-d');
	if($rut != '')
	$query .=" AND s.FechaInstalacion BETWEEN '".$startDate."' AND '".$endDate."' ";
	else
	$query .=" WHERE s.FechaInstalacion BETWEEN '".$startDate."' AND '".$endDate."' ";
}


$query .= " GROUP BY p.rut ORDER BY p.nombre ";

$run = new Method;
$data = $run->select($query);
if (count($data) > 0) {
	// print_r($data[10]); exit;
	$index = 2;
	for ($i=0; $i < count($data) ; $i++) {
		
		$FechaInstalacion = \DateTime::createFromFormat('Y-m-d', $data[$i][5])->format('d-m-Y');
		
        // if($data[$i][6] == 1)
        // $data[$i][6] = 'Activo';
        // else if($data[$i][6] == 2)
        // $data[$i][6] = 'Suspendido';
        // else if($data[$i][6] == 0)
        // $data[$i][6] = 'Inactivo';
		// else
        $data[$i][6] = 'En proceso...';
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, $data[$i][0])
		->setCellValue('B'.$index, $data[$i][1])
		->setCellValue('C'.$index, $data[$i][2])
		->setCellValue('D'.$index, $data[$i][3])
		->setCellValue('E'.$index, $data[$i][4])
		->setCellValue('F'.$index, $FechaInstalacion)
		->setCellValue('G'.$index, $data[$i][6]);
		$index ++;
	}
}else {
	echo "No existen datos para esta consulta";
	return;
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