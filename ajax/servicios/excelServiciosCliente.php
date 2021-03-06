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
->setCellValue('M1', 'Código servicio')
->setCellValue('N1', 'Conexión')
->setCellValue('O1', 'Valor')
->setCellValue('P1', 'Grupo')
->setCellValue('Q1', 'Estatus')
->setCellValue('R1', 'Tipo')
->setCellValue('S1', 'Velocidad')
->setCellValue('T1', 'Plan');

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
			$query = "	SELECT
					servicios.Id AS Id,
					servicios.Codigo AS Codigo,
					servicios.Conexion AS Conexion,
					servicios.Valor,
					COALESCE ( grupo_servicio.Nombre, servicios.Grupo ) AS Grupo,
					( CASE WHEN servicios.EstatusServicio = '1' THEN 'Activo' 
						   WHEN servicios.EstatusServicio = '2' THEN 'Suspendido' 
						   WHEN servicios.EstatusServicio = '3' THEN 'Corte  comercial'
						   WHEN servicios.EstatusServicio = '4' THEN 'Cambio razón social'
						   WHEN servicios.EstatusServicio = '5' THEN 'Servicio temporal'
						   ELSE 'Término de contrato' END ) AS Estatus,
					( CASE servicios.IdServicio WHEN 7 THEN servicios.NombreServicioExtra ELSE mantenedor_servicios.servicio END ) AS 'tipoServicio',
					( CASE servicios.IdServicio WHEN 1 THEN arriendo_equipos_datos.Velocidad ELSE '' END ) AS 'Velocidad',
					( CASE servicios.IdServicio WHEN 1 THEN arriendo_equipos_datos.Plan ELSE '' END ) AS 'Plan'
				FROM
					servicios
					INNER JOIN mantenedor_tipo_factura ON mantenedor_tipo_factura.id = servicios.TipoFactura
					INNER JOIN mantenedor_tipo_facturacion ON mantenedor_tipo_facturacion.id = mantenedor_tipo_factura.tipo_facturacion
					LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio
					LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = servicios.Grupo
					LEFT JOIN arriendo_equipos_datos ON arriendo_equipos_datos.IdServicio = servicios.Id
				WHERE
					servicios.Rut = $Rut ";
            // echo $query; exit;
			$servicios = $run->select($query);
			foreach ($servicios as $servicio) {
				$servicio['Codigo'];
				$objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('M' . $index, $servicio['Codigo'])
                    ->setCellValue('N' . $index, $servicio['Conexion'])
                    ->setCellValue('O' . $index, $servicio['Valor'])
                    ->setCellValue('P' . $index, $servicio['Grupo'])
                    ->setCellValue('Q' . $index, $servicio['Estatus'])
                    ->setCellValue('R' . $index, $servicio['tipoServicio'])
                    ->setCellValue('S' . $index, $servicio['Velocidad'])
                    ->setCellValue('T' . $index, $servicio['Plan']);
				$run->cellColor('M' . $index, '7474FF');
				$index++;
			}
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
header('Content-Disposition: attachment;filename="Servicios.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>