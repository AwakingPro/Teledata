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
->setCellValue('Q1', 'Cliente Extranjero')
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
->setCellValue('AG1', 'Impuesto');

foreach (range(0, 33) as $col) {
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}


require_once('../../class/methods_global/methods.php');
$query = 'SELECT
servicios.Id,
servicios.Rut,
COALESCE ( grupo_servicio.Nombre, servicios.Grupo ) AS Grupo,
servicios.TipoFactura,
servicios.Valor,
servicios.Descuento,
servicios.IdServicio,
servicios.TiepoFacturacion,
servicios.Codigo,
servicios.Descripcion,
personaempresa.id,
personaempresa.rut,
personaempresa.dv,
personaempresa.nombre,
personaempresa.giro,
personaempresa.direccion,
personaempresa.correo,
personaempresa.contacto,
personaempresa.comentario,
personaempresa.telefono,
mantenedor_servicios.IdServicio,
mantenedor_servicios.servicio
FROM
	servicios
	INNER JOIN personaempresa ON servicios.Rut = personaempresa.rut
	INNER JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio
	LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = servicios.Grupo ';
$run = new Method;
$data = $run->select($query);
if (count($data) > 0) {
	
	$index = 2;
	for ($i=0; $i < count($data) ; $i++) {

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, 'D')
		->setCellValue('B'.$index, '1')
		->setCellValue('C'.$index, $data[$i][4])
		->setCellValue('D'.$index, '0')
		->setCellValue('E'.$index, '0')
		->setCellValue('F'.$index, '0')
		->setCellValue('G'.$index, '0')
		->setCellValue('H'.$index, $data[$i][10])
		->setCellValue('I'.$index, date("d-m-Y"))
		->setCellValue('J'.$index, '')
		->setCellValue('K'.$index, '')
		->setCellValue('L'.$index, '')
		->setCellValue('M'.$index, 'Efectivo')
		->setCellValue('N'.$index, $data[$i][17])
		->setCellValue('O'.$index, $data[$i][1])
		->setCellValue('P'.$index, '')
		->setCellValue('Q'.$index, '')
		->setCellValue('R'.$index, $data[$i][16])
		->setCellValue('S'.$index, $data[$i][15])
		->setCellValue('T'.$index, $data[$i][14])
		->setCellValue('U'.$index, '')
		->setCellValue('V'.$index, $data[$i][17])
		->setCellValue('W'.$index, $data[$i][20])
		->setCellValue('X'.$index, $data[$i][16])
		->setCellValue('Y'.$index, '')
		->setCellValue('Z'.$index, '')
		->setCellValue('AA'.$index, '')
		->setCellValue('AB'.$index, '')
		->setCellValue('AC'.$index, '')
		->setCellValue('AD'.$index, '')
		->setCellValue('AE'.$index, '')
		->setCellValue('AF'.$index, $data[$i][5])
		->setCellValue('AG'.$index, '');
		$index ++;
	}
}


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Facturas mensuales');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../../reportes/reporteFacturasAnual/Factura Anual '.date("d-m-Y").'.xlsx');
exit;
?>