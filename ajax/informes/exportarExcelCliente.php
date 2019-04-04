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
->setCellValue('F1', 'correo')
->setCellValue('G1', 'Fecha de Instalacion')
->setCellValue('H1', 'Estado Del Cliente');

foreach (range(0, 33) as $col) {
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}

require_once('../../class/methods_global/methods.php');
	$query = "SELECT
				p.rut,
				p.dv,
				p.nombre AS RazonSocial,
				p.telefono,
				p.correo,
				p.state,
				mt.nombre AS tipo_cliente,
				s.FechaInstalacion  AS fechaInstalacion
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
	$index = 2;
	foreach ($data as $dato) {
		if($dato['fechaInstalacion'] != '' || $dato['fechaInstalacion'] != NULL)
			$dato['fechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $dato['fechaInstalacion'])->format('d-m-Y');
		else {
			$dato['fechaInstalacion'] = 'Sin Datos';
		}
		
		if($dato['state'] == NULL || $dato['state'] == '')
			$dato['EstadoCliente'] = 'Sin estado en la BD...';
		else if($dato['state'] == 0){
			$dato['EstadoCliente'] = 'Activo';
		}else if($dato['state'] == 1){
			$dato['EstadoCliente'] = 'Inactivo';
		}else{
			$dato['EstadoCliente'] = 'Otro';
		}
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$index, $dato['rut'])
			->setCellValue('B'.$index, $dato['dv'])
			->setCellValue('C'.$index, $dato['RazonSocial'])
			->setCellValue('D'.$index, $dato['telefono'])
			->setCellValue('E'.$index, $dato['tipo_cliente'])
			->setCellValue('F'.$index, $dato['correo'])
			->setCellValue('G'.$index, $dato['fechaInstalacion'])
			->setCellValue('H'.$index, $dato['EstadoCliente']);
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