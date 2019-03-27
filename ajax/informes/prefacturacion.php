<?php
/** Incluir la libreria PHPExcel */
require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';
require_once '../../class/methods_global/methods.php';
require_once '../../class/facturacion/uf/UfClass.php';
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
    ->setCellValue('B5', 'Razón Social:')
    ->setCellValue('B6', 'Rut:')
    ->setCellValue('B7', 'Giro:')

    ->setCellValue('C5', 'Teledata Chile SpA')
    ->setCellValue('C6', '76.722.248-3')
    ->setCellValue('C7', 'Proveedores de internet')

    ->setCellValue('B8', 'DATOS CLIENTE')

    ->setCellValue('B9', 'Razón Social:')
    ->setCellValue('B10', 'Rut:')
    ->setCellValue('B11', 'Dirección:')
    ->setCellValue('B12', 'Teléfono:')

    ->setCellValue('E1', 'PREFACTURACIÓN SERVICIOS MENSUALES')
    ->setCellValue('E2', 'N°')
    ->setCellValue('F2', time())

    ->setCellValue('E4', 'Fono:')
    ->setCellValue('E5', 'Mail:')

    ->setCellValue('F4', '652566600:')
    ->setCellValue('F5', 'pagos@teledata.cl')

    ->setCellValue('A13', ' ')
	->setCellValue('B13', 'Nº')
	->setCellValue('C13', 'CENTRO')
	->setCellValue('D13', 'DESCRIPCIÓN')
    ->setCellValue('E13', 'FECHA UF')
    ->setCellValue('F13', 'VALOR PLAN UF')
    ->setCellValue('G13', 'VALOR UF')
    ->setCellValue('H13', 'Total Neto');
    // ->setCellValue('D19', 'Notas:');

foreach (range(0, 4) as $col) {
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
                personaempresa.dv AS DV,
                personaempresa.telefono,
                facturas_detalle.Codigo,
                facturas_detalle.Concepto,
                facturas.Id AS facturaId,
                facturas.IVA,
                facturas.FechaFacturacion,
                servicios.Valor AS ValorPlanUf,
                servicios.Descripcion,
                servicios.Conexion,
                servicios.Direccion
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
    personaempresa.dv AS DV,
    personaempresa.telefono,
    facturas_detalle.Codigo,
    facturas_detalle.Concepto,
    facturas.Id AS facturaId,
    facturas.IVA,
    facturas.FechaFacturacion,
    servicios.Valor AS ValorPlanUf,
    servicios.Descripcion,
    servicios.Conexion,
    servicios.Direccion
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
    $run->cellColor('B13:H13', '318691');
    $index = 14;
    $contador = 0;
    $totalDetalles = count($facturas);
    $UfClass = new Uf();
    foreach($facturas as $factura){
        $data = $factura;
        if($data['Descripcion']){
            // $data['Concepto'] .=  ' - '.$data['Descripcion'];
        }
        $FechaFacturacion = \DateTime::createFromFormat('Y-m-d',$data['FechaFacturacion'])->format('Y/m/d');
        $FechaFacturacionEs = \DateTime::createFromFormat('Y-m-d',$data['FechaFacturacion'])->format('d/M/Y');
        $data['FechaFacturacionEs'] = $FechaFacturacionEs;
        $FechaUfApi = $run->fechaApiSbif($FechaFacturacion);
        $valorUF = $UfClass->getValue($FechaUfApi);
        $data['valorUF'] = $valorUF;
        $data['totalDetalles'] = $totalDetalles;
        array_push($ToReturn,$data);
    }
    
    foreach($ToReturn as $datos) {
        $contador++;
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('B'.$index, $contador)
        ->setCellValue('C'.$index, $datos['Conexion'])
        ->setCellValue('D'.$index, $datos['Concepto'])
        ->setCellValue('E'.$index, $datos['FechaFacturacionEs'])
        ->setCellValue('F'.$index, $datos['ValorPlanUf'])
        ->setCellValue('G'.$index, $datos['valorUF'])
        ->setCellValue('H'.$index, "$ ".$datos['Valor']);
        // $run->cellColor('A'.$index.':E'.$index, 'A6A6FF');
        $index++;
    }
    //datos cliente
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('C9', $data['Nombre'])
    ->setCellValue('C10', $Rut.'-'.$data['DV'])
    ->setCellValue('C11',$data['Direccion'])
    ->setCellValue('C12', $data['telefono']);
    // ->setCellValue('D20', 'Valor UF del '.$data['FechaFacturacion'].' - '.$valorUF);

}else{
    echo 'Disculpe, no existen datos para esta consulta';
    return;
}           

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Prefacturación');
$objDrawing = new PHPExcel_Worksheet_Drawing();
// create object for Worksheet drawing 
$objDrawing->setName('Logo Teledata'); 
// set name to image 
$objDrawing->setDescription('Logo de Teledata para prefacturas');
// set description to image 
$signature = '../../img/logo-teledata-200.png'; 
// Path to signature .jpg file 
$objDrawing->setPath($signature); 
$objDrawing->setOffsetX(20);
// setOffsetX works properly 
$objDrawing->setOffsetY(0);
// setOffsetY works properly 
$objDrawing->setCoordinates('B1');
// set image to cell 
$objDrawing->setWidth(62); 
// set width, height 
$objDrawing->setHeight(62); 
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 
// save 
// echo "<pre>"; print_r($objDrawing); echo "</pre>"; exit;
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=Prefacturación ".$FechaExcel.' RUT '.$Rut.".xlsx");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

$objWriter->save('php://output');
exit;
?>