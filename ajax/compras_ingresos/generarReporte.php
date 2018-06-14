<?php
/** Incluir la libreria PHPExcel */
require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';
require_once('../../class/methods_global/methods.php');

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
	->setCreator("Teledata")
	->setLastModifiedBy("Teledata")
	->setTitle("Compras")
	->setSubject("Reporte de Ingresos")
	->setDescription("Reporte de Ingresos.")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Reporte de Ingresos");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'Proveedor')
	->setCellValue('B1', 'Numero de Factura')
	->setCellValue('C1', 'Fecha Emisión Factura')
	->setCellValue('D1', 'Descripción')
	->setCellValue('E1', 'Monto')
	->setCellValue('F1', 'Estado de Pago')
	->setCellValue('G1', 'Detalle')
	->setCellValue('H1', 'Fecha de Pago')
	->setCellValue('I1', 'Centro de Costos');


foreach (range(0, 8) as $col) {
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}

if(isset($_GET['startDate']) && isset($_GET['endDate'])){
    $startDate = $_GET['startDate'];
    $dt = \DateTime::createFromFormat('d-m-Y',$startDate);
    $startDate = $dt->format('Y-m-d');
    $endDate = $_GET['endDate'];
    $dt = \DateTime::createFromFormat('d-m-Y',$endDate);
    $endDate = $dt->format('Y-m-d');
}else{
    echo 'Debe seleccionar un rango de fecha';
    return;
}

$query = "  SELECT 
                compras_ingresos.*, 
                mantenedor_estado_pago.nombre as estado, 
                mantenedor_proveedores.nombre as proveedor,
                mantenedor_costos.nombre as centro_costo 
            FROM 
                compras_ingresos 
            INNER JOIN 
                mantenedor_estado_pago 
            ON 
                compras_ingresos.estado_id = mantenedor_estado_pago.id 
            INNER JOIN 
                mantenedor_costos 
            ON 
                compras_ingresos.centro_costo_id = mantenedor_costos.id 
            INNER JOIN 
                mantenedor_proveedores 
            ON 
                compras_ingresos.proveedor_id = mantenedor_proveedores.id
            WHERE
                compras_ingresos.fecha_emision_factura BETWEEN '".$startDate."' AND '".$endDate."'";

$run = new Method;
$ingresos = $run->select($query);

// echo '<pre>'; print_r($ingresos); echo '</pre>';


if (count($ingresos) > 0) {

	$index = 2;

	foreach($ingresos as $ingreso){

		if($ingreso['fecha_detalle'] && $ingreso['fecha_detalle'] != '0000-00-00'){
            $fecha_detalle = \DateTime::createFromFormat('Y-m-d',$ingreso['fecha_detalle'])->format('d-m-Y');
        }else{
            $fecha_detalle = '';
        }
        
        $fecha_emision_factura = \DateTime::createFromFormat('Y-m-d',$ingreso['fecha_emision_factura'])->format('d-m-Y');

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, $ingreso['proveedor'])
		->setCellValue('B'.$index, $ingreso['numero_factura'])
		->setCellValue('C'.$index, $fecha_emision_factura)
		->setCellValue('D'.$index, $ingreso['detalle_factura'])
		->setCellValue('E'.$index, $ingreso['monto'])
		->setCellValue('F'.$index, $ingreso['estado'])
		->setCellValue('G'.$index, $ingreso['numero_detalle'])
		->setCellValue('H'.$index, $fecha_detalle)
		->setCellValue('I'.$index, $ingreso['centro_costo']);

		$index++;
	}

}

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Ingresos');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=Reporte Ingresos ".date("d-m-Y").".xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>