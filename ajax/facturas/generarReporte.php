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
	->setTitle("Facturas")
	->setSubject("Reporte de Facturas")
	->setDescription("Reporte de Facturas.")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Reporte de Facturas");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'Numero de Documento')
	->setCellValue('B1', 'Fecha Emisión Documento')
	->setCellValue('C1', 'Tipo de Documento')
	->setCellValue('D1', 'Rut')
	->setCellValue('E1', 'Grupo')
	->setCellValue('F1', 'Cliente')
	->setCellValue('G1', 'Descripción')
	->setCellValue('H1', 'Valor');


foreach (range(0, 7) as $col) {
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
                facturas_detalle.Valor,
                facturas_detalle.Servicio,
                facturas.Id,
                facturas.Rut,
                facturas.FechaFacturacion,
                facturas.TipoDocumento,
                personaempresa.nombre AS Cliente,
                COALESCE ( grupo_servicio.Nombre, facturas.Grupo ) AS Grupo 
            FROM
                facturas_detalle
                INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id
                INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = facturas.Grupo 
            WHERE
                facturas_detalle.Valor > 0 
                AND facturas.EstatusFacturacion = '1'
                AND facturas.FechaFacturacion BETWEEN '".$startDate."' AND '".$endDate."'";

$run = new Method;
$documentos = $run->select($query);
$Total = 0;
// echo '<pre>'; print_r($ingresos); echo '</pre>';


if (count($documentos) > 0) {

	$index = 2;

	foreach($documentos as $documento){
        
        $FechaFacturacion = \DateTime::createFromFormat('Y-m-d',$documento['FechaFacturacion'])->format('d-m-Y');

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, $documento['Id'])
		->setCellValue('B'.$index, $FechaFacturacion)
		->setCellValue('C'.$index, $documento['TipoDocumento'])
		->setCellValue('D'.$index, $documento['Rut'])
		->setCellValue('E'.$index, $documento['Grupo'])
		->setCellValue('F'.$index, $documento['Cliente'])
		->setCellValue('G'.$index, $documento['Servicio'])
        ->setCellValue('H'.$index, $documento['Valor']);
        
        $Total += $documento['Valor'];

		$index++;
    }
    
    $index++;
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('H'.$index, $Total);

}

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Facturas');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=Reporte Facturas ".date("d-m-Y").".xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>