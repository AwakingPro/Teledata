<?php
/** Incluir la libreria PHPExcel */
require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';
require_once '../../class/methods_global/methods.php';

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
	->setCreator("Teledata")
	->setLastModifiedBy("Teledata")
	->setTitle("Prefacturación")
	->setSubject(" cliente")
	->setDescription("Informe clientes con servicios")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Informe clientes con servicios");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A13', ' ')
	->setCellValue('B13', 'Nº')
	->setCellValue('C13', 'CENTRO')
	->setCellValue('D13', 'DESCRIPCIÓN')
	->setCellValue('E13', 'VALOR PLAN UF')
    ->setCellValue('F13', 'VALOR UF')
    ->setCellValue('G13', 'Total Neto');

foreach (range(0, 8) as $col) {
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}
$FechaExcel = '';
$startDate = '';
$endDate = '';

$FechaExcel = date('d/m/Y');
$Grupo = $_GET['grupo'];
$Rut = '';
if(isset($_GET['rut']) && $_GET['rut'] != '') {
    $Rut = $_GET['rut'];

}
if($Grupo == 1000){
    $query = "  SELECT
                facturas_detalle.Id AS detalleId,
                facturas_detalle.Valor AS Valor_Uf,
                ROUND((
                    facturas_detalle.Total
                ),0) AS Valor,
                facturas_detalle.IdServicio as idServicio,
                facturas_detalle.documentDetailIdBsale AS detalleIdBsale,
                personaempresa.nombre AS Nombre,
                facturas_detalle.Codigo,
                facturas_detalle.Concepto,
                facturas.Id AS facturaId,
                facturas.IVA,
                servicios.Valor AS ValorPlanUf,
                servicios.Descripcion,
                servicios.Conexion
            FROM
                facturas
            INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id
            INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
            INNER JOIN servicios ON servicios.Id = facturas_detalle.IdServicio
            WHERE
                facturas.TipoFactura = '2'
            AND facturas.id = '".$Rut."'
            AND facturas.Grupo = '".$Grupo."'
            AND facturas.EstatusFacturacion = 0
            AND facturas_detalle.Valor > 0"; 
}else{
    $query = "  SELECT
    facturas_detalle.Id AS detalleId,
    facturas_detalle.Valor AS Valor_Uf,
    ROUND((
        facturas_detalle.Total
    ),0) AS Valor,
    facturas_detalle.IdServicio as idServicio,
    facturas_detalle.documentDetailIdBsale AS detalleIdBsale,
    personaempresa.nombre AS Nombre,
    facturas_detalle.Codigo,
    facturas_detalle.Concepto,
    facturas.Id AS facturaId,
    facturas.IVA,
    servicios.Valor AS ValorPlanUf,
    servicios.Descripcion,
    servicios.Conexion
FROM
    facturas
INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id
INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
INNER JOIN servicios ON servicios.Id = facturas_detalle.IdServicio
WHERE
    facturas.TipoFactura = '2'
AND facturas.Rut = '".$Rut."'
AND facturas.Grupo = '".$Grupo."'
AND facturas.EstatusFacturacion = 0
AND facturas_detalle.Valor > 0"; 
}
$run = new Method;
$facturas = $run->select($query);
$ToReturn = array();
if($facturas){
    $run->cellColor('B13:G13', '318691');
    $index = 14;
    $contador = 0;
    $totalDetalles = count($facturas);
    foreach($facturas as $factura){
        $data = $factura;
        if($data['Descripcion']){
            // $data['Concepto'] .=  ' - '.$data['Descripcion'];
        }
        $data['totalDetalles'] = $totalDetalles;
        array_push($ToReturn,$data);
    }

    foreach($ToReturn as $datos) {
        $contador++;
        
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('B'.$index, $contador)
        ->setCellValue('C'.$index, $datos['Conexion'])
        ->setCellValue('D'.$index, $datos['Concepto'])
        ->setCellValue('E'.$index, $datos['ValorPlanUf'])
        ->setCellValue('F'.$index, $datos['Valor_Uf']/$datos['ValorPlanUf'])
        ->setCellValue('G'.$index, "$ ".$datos['Valor_Uf']);
        // $run->cellColor('A'.$index.':E'.$index, 'A6A6FF');
        $index++;
    }
}else{
    echo 'Disculpe, no existen datos para esta consulta';
    return;
}           

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Prefacturación');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=Prefacturación ".$FechaExcel.' RUT '.$Rut.".xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>