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
	->setTitle("Informe de Pagos Mensuales y Anuales")
	->setSubject("Informe de Pagos Mensuales y Anuales")
	->setDescription("Informe de Pagos Mensuales y Anuales")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Informe de Pagos Mensuales y Anuales");

    // Agregar Informacion
    $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'Nombre / Razón Social')
	->setCellValue('B1', 'Tipo Documento')
	->setCellValue('C1', 'Nº Doc')
	->setCellValue('D1', 'Fecha Emisión')
	->setCellValue('E1', 'Fecha de Vencimiento')
    ->setCellValue('F1', 'Total Doc')
    ->setCellValue('G1', 'Deuda')
    ->setCellValue('H1', 'Tipo De Facturación')
    ->setCellValue('I1', 'Clase Cliente');

    foreach (range(0, 10) as $col) {
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
    }


    $ToReturn = array();
    $data = array();
    $data2 = array();
    $data3 = array();
    $fecha_actual = date("Y-m-d");

    $query = " SELECT
    personaempresa.nombre AS Cliente,
    facturas.Id,
    facturas.NumeroDocumento,
    facturas.FechaFacturacion,
    facturas.FechaVencimiento,
	devoluciones.priceAdjustment,
    mantenedor_tipo_cliente.nombre AS TipoDocumento,
    facturas.IVA,
    facturas.EstatusFacturacion,
    clase_clientes.nombre AS ClaseCliente,
    IFNULL( ( SELECT SUM( Monto ) FROM facturas_pagos WHERE FacturaId = facturas.Id ), 0 ) AS TotalSaldo,
    IFNULL( ( SELECT SUM( DevolucionAmount ) FROM devoluciones WHERE FacturaId = facturas.Id ), 0 ) AS TotalDevolucion,
    mantenedor_servicios.servicio AS NombreServicio,
    mantenedor_tipo_facturacion.nombre AS TipoFacturacion
    FROM
    facturas
	INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id
	INNER JOIN personaempresa ON facturas.Rut = personaempresa.rut
    INNER JOIN clase_clientes ON clase_clientes.id = personaempresa.clase_cliente
    LEFT JOIN devoluciones ON devoluciones.FacturaId = facturas.Id
	LEFT JOIN facturas_pagos ON facturas_pagos.FacturaId = facturas.Id
	LEFT JOIN servicios ON servicios.Rut = facturas.Rut
    LEFT JOIN mantenedor_tipo_factura ON servicios.TipoFactura = mantenedor_tipo_factura.id
	LEFT JOIN mantenedor_tipo_facturacion ON mantenedor_tipo_factura.tipo_facturacion = mantenedor_tipo_facturacion.id
	LEFT JOIN mantenedor_servicios ON mantenedor_servicios.IdServicio = servicios.IdServicio
    WHERE
	facturas.EstatusFacturacion != '0'";

    $rut = '';
    $startDate = '';
    $endDate = '';
    if(isset($_GET['rut']) && $_GET['rut'] != '') {
        $rut = $_GET['rut'];
        $query .= " AND personaempresa.rut = '".$rut."' ";
    }

    if(isset($_GET['startDate']) && $_GET['startDate'] != '' && isset($_GET['endDate']) && $_GET['endDate'] != ''){
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $dt = \DateTime::createFromFormat('d-m-Y',$startDate);
        $startDate = $dt->format('Y-m-d'); 
        $dt = \DateTime::createFromFormat('d-m-Y',$endDate);
        $endDate = $dt->format('Y-m-d');
        $query .= " AND facturas.FechaFacturacion BETWEEN '".$startDate."' AND '".$endDate."'";
    }

    $query .= " GROUP BY facturas.Id
                ORDER BY Cliente";
    // print_r($query);exit;
    $run = new Method;
    $facturas = $run->select($query);
// echo "<pre>";  print_r($facturas); echo "</pre>"; exit;
 if(count($facturas) > 0) {
    $index = 2;
     $priceAdjustment = '';
     $TotalDevolucion = '';
    // echo "<pre>"; print_r($facturas); echo "</pre>"; exit;
    foreach($facturas as $factura){
        $Id = $factura['Id'];
        $IVA = $factura['IVA'];
        $EstatusFacturacion = $factura['EstatusFacturacion'];
        $FNumeroDocumento = $factura['NumeroDocumento'];
        $TotalFactura = 0;

        $query = "SELECT Total, (Descuento + IFNULL((SELECT SUM(Porcentaje) FROM descuentos_aplicados WHERE IdDetalle = facturas_detalle.Id),0)) as Descuento FROM facturas_detalle WHERE FacturaId = '".$Id."'";
        $detalles = $run->select($query);
        foreach($detalles as $detalle){
            $Total = $detalle['Total'];
            $Descuento = floatval($detalle['Descuento']) / 100;
            $Descuento = $Total * $Descuento;
            $Total -= $Descuento;
            $TotalFactura += round($Total,0);
        }
        $TotalSaldo = $factura['TotalSaldo'];
        $Deuda = $TotalFactura - $TotalSaldo;

        $priceAdjustment = $factura['priceAdjustment'];
        $TotalDevolucion = $factura['TotalDevolucion'];
        if($priceAdjustment == 1){
            $Deuda -= $TotalDevolucion ;
        }


        $Id = $factura['Id'];
        $data = array();
        $data['Id'] = $Id;
        $data['DocumentoId'] = $Id;
        $data['Cliente'] = $factura['Cliente'];
        $data['NumeroDocumento'] = $factura['NumeroDocumento'];
        $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');
        $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');
        $data['TotalFactura'] = $TotalFactura;
        //total saldo es el pago total - el saldo del doc
        $data['Deuda'] = $Deuda;
        $data['TipoDocumento'] = $factura['TipoDocumento'];
        $data['ClaseCliente'] = $factura['ClaseCliente'];
        // if($factura['NombreServicio'] == '')
        // $factura['NombreServicio'] = 'Otros Servicios';
        $data['NombreServicio'] = $factura['NombreServicio'];
        // if($factura['TipoFacturacion'] == '')
        // $factura['TipoFacturacion'] = 'Otros Servicios';
        $data['TipoFacturacion'] = $factura['TipoFacturacion'];
        $data['EstatusFacturacion'] = 1;
        array_push($ToReturn,$data);
    }
    $TotalDocAcumulado = 0;
    $TotalDeudaAcumulada = 0;
    // echo "<pre>"; print_r($ToReturn); echo "</pre>"; exit;
    foreach($ToReturn as $datos) {
    if($datos['Deuda'] > 0){
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$index, $datos['Cliente'])
        ->setCellValue('B'.$index, $datos['TipoDocumento'])
        ->setCellValue('C'.$index, $datos['NumeroDocumento'])
        ->setCellValue('D'.$index, $datos['FechaFacturacion'])
        ->setCellValue('E'.$index, $datos['FechaVencimiento'])
        ->setCellValue('F'.$index, $datos['TotalFactura'])
        ->setCellValue('G'.$index, $datos['Deuda'])
        ->setCellValue('H'.$index, $datos['TipoFacturacion'])
        ->setCellValue('I'.$index, $datos['ClaseCliente']);
        $TotalDocAcumulado += $datos['TotalFactura'];
        $TotalDeudaAcumulada += $datos['Deuda'];
        $index ++; 
        }
    }
    if($index == 2){
        echo "No existen deudas para este cliente";
        exit;
    }
    
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('F'.++$index, 'Total doc acumulado')
    ->setCellValue('G'.$index, 'Deuda acumulada')
    ->setCellValue('F'.++$index, $TotalDocAcumulado)
    ->setCellValue('G'.$index, $TotalDeudaAcumulada);

    
}else{
    echo 'No existen datos para esta consulta';
    return;
}

// print_r($facturas);exit;
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Cobranza Clientes');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=cobranzaClientes.xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>