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
->setCellValue('H1', 'Estado Del Cliente')
->setCellValue('I1', 'Región')
->setCellValue('J1', 'Región ordinal')
->setCellValue('K1', 'Ciudad')
->setCellValue('L1', 'Provincia')
->setCellValue('M1', 'Servicios')
->setCellValue('N1', 'Estado servicio')
->setCellValue('O1', 'Valor UF');

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
				s.FechaInstalacion  AS fechaInstalacion,
				regiones.nombre as region,
				regiones.region_ordinal as region_ordinal,
				ciudades.nombre as ciudad,
				provincias.nombre as provincia,
				s.Codigo
			FROM
				personaempresa p
				INNER JOIN mantenedor_tipo_cliente mt ON p.tipo_cliente = mt.id
				INNER JOIN regiones ON p.region = regiones.id
				INNER JOIN ciudades ON p.ciudad = ciudades.id
				INNER JOIN provincias ON ciudades.provincia_id = provincias.id
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

// echo $query;

$query .= " GROUP BY p.rut ORDER BY p.nombre ";

$run = new Method;
$data = $run->select($query);

// echo '<pre>'; print_r($data); '</pre>'; exit;
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
			->setCellValue('H'.$index, $dato['EstadoCliente'])
			->setCellValue('I'.$index, $dato['region'])
			->setCellValue('J'.$index, $dato['region_ordinal'])
			->setCellValue('K'.$index, $dato['ciudad'])
			->setCellValue('L'.$index, $dato['provincia']);

			$Rut = $dato['rut'];
			$query = "SELECT Codigo, Valor, EstatusServicio FROM servicios s
						WHERE s.Rut = '".$Rut."'  ";
			$servicios = $run->select($query);
//            echo count($servicios);
//            exit;
			if(count($servicios) >= 1){

                foreach ($servicios as $servicio) {
                    $EstatusServicio = $servicio['EstatusServicio'];
                    if ($EstatusServicio == 0){
                        $run->cellColor('N' . $index, 'FF0000');
                        $EstatusServicio = 'Término de Contrato';
                    }
                    if($EstatusServicio == 1){
                        $run->cellColor('N' . $index, 'ffffff');
                        $EstatusServicio = 'Activo';
                    }
                    if($EstatusServicio == 2){
                        $run->cellColor('N' . $index, 'ffff00');
                        $EstatusServicio = 'Suspendido';
                    }
                    if($EstatusServicio == 3){
                        $run->cellColor('N' . $index, 'de4c8a');
                        $EstatusServicio = 'Corte comercial';
                    }
                    if($EstatusServicio == 4){
                        $run->cellColor('N' . $index, 'ff8000');
                        $EstatusServicio = 'Cambio razón social';
                    }
                    if($EstatusServicio == 5){
                        $run->cellColor('N' . $index, '00FF00');
                        $EstatusServicio = 'Servicio temporal';
                    }
                    if($EstatusServicio == ''){
                        $run->cellColor('N' . $index, '454545');
                        $EstatusServicio = 'Estado no encontrado';
                    }

                    $servicio['Codigo'];
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('M' . $index, $servicio['Codigo']);
//
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('N' . $index, $EstatusServicio);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('O' . $index, $servicio['Valor']);

                    $index++;
                }

            }else{
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('M' . $index, 'Sin servicio');

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('N' . $index, 'Sin estado');
                    $run->cellColor('N' . $index, 'F44611');
                $index++;
            }
//            $index ++;

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