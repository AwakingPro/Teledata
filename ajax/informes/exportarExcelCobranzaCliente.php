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
    ->setCellValue('G1', 'Tipo De Facturación')
    ->setCellValue('H1', 'Clase Cliente');

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
    mantenedor_tipo_cliente.nombre AS TipoDocumento,
    facturas.IVA,
    facturas.EstatusFacturacion,
    clase_clientes.nombre AS ClaseCliente,
    IFNULL( ( SELECT SUM( Monto ) FROM facturas_pagos WHERE FacturaId = facturas.Id ), 0 ) AS TotalSaldo,
    mantenedor_servicios.servicio AS NombreServicio,
    mantenedor_tipo_facturacion.nombre AS TipoFacturacion
    FROM
    facturas
	INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id
	INNER JOIN personaempresa ON facturas.Rut = personaempresa.rut
    INNER JOIN clase_clientes ON clase_clientes.id = personaempresa.clase_cliente
	LEFT JOIN facturas_pagos ON facturas_pagos.FacturaId = facturas.Id
	LEFT JOIN servicios ON servicios.Rut = facturas.Rut
    LEFT JOIN mantenedor_tipo_factura ON servicios.TipoFactura = mantenedor_tipo_factura.id
	LEFT JOIN mantenedor_tipo_facturacion ON mantenedor_tipo_factura.tipo_facturacion = mantenedor_tipo_facturacion.id
	LEFT JOIN mantenedor_servicios ON mantenedor_servicios.IdServicio = servicios.IdServicio
    WHERE
    facturas.EstatusFacturacion != '2' AND
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

    $run = new Method;
    $facturas = $run->select($query);
    $id_facturas = '';
    $razonSocial = '';
    $NumeroDocumento = '';
    $FechaFacturacion = '';
    $TipoDocumento = '';
    $fechaVencimiento = '';
    $factura_detalle_FacturaId = '';
    $factura_detalle_Total = 0;
    $contador_vencidos = 0;
    $monto_deuda = 0;
    $fp_monto = 0;
    $pagos = 0;
    $bandera = 0;
    $EstatusServicio = '';
    $TipoServicio = '';
    $claseCLiente = '';
 
 if(count($facturas) > 0) {
    $index = 2;
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
        $SaldoFavor = 0;
        $TotalSaldo = $factura['TotalSaldo'];
        $TotalSaldo = $TotalFactura - $TotalSaldo;
        $SaldoFavor = $factura['TotalSaldo'] - $TotalFactura;
        if($TotalSaldo < 0){
            $TotalSaldo = 0;
        }
        if($SaldoFavor < 0){
            $SaldoFavor = 0;
        }
        $TotalSaldoFactura = $TotalSaldo;
        if($EstatusFacturacion != 2){
            $Acciones = 1;
        }else{
            $TotalSaldo = 0;
            $Acciones = 0;
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
        //total saldo es el pago total
        $data['TotalSaldo'] = $TotalSaldo;
        $data['SaldoFavor'] = $SaldoFavor;
        $data['TipoDocumento'] = $factura['TipoDocumento'];
        $data['ClaseCliente'] = $factura['ClaseCliente'];
        // if($factura['NombreServicio'] == '')
        // $factura['NombreServicio'] = 'Otros Servicios';
        $data['NombreServicio'] = $factura['NombreServicio'];
        // if($factura['TipoFacturacion'] == '')
        // $factura['TipoFacturacion'] = 'Otros Servicios';
        $data['TipoFacturacion'] = $factura['TipoFacturacion'];
        $data['Acciones'] = $Acciones;
        $data['EstatusFacturacion'] = 1;
        array_push($ToReturn,$data);
        if($EstatusFacturacion == 2){
            $query = "SELECT Id, FechaDevolucion, NumeroDocumento, UrlPdfBsale, DevolucionAnulada, priceAdjustment, editTexts FROM devoluciones WHERE FacturaId = '".$Id."'";
            if($startDate){
                $query .= " AND FechaDevolucion BETWEEN '".$startDate."' AND '".$endDate."'";
            }
            // if($NumeroDocumento){
            //     $query .= " AND NumeroDocumento = '".$NumeroDocumento."'";
            // }
            $devoluciones = $run->select($query);
            if($devoluciones){
                $devolucion = $devoluciones[0];
                $DevolucionAnulada = $devolucion['DevolucionAnulada'];
                if($DevolucionAnulada == 0){
                    $Acciones = 1;
                }else{
                    $Acciones = 0;
                }
                
                $data = array();
                $data['Id'] = $devolucion['Id'];
                $data['DocumentoId'] = $Id;
                $data['Cliente'] = $factura['Cliente'];
                $data['NumeroDocumento'] = $devolucion['NumeroDocumento'];
                $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$devolucion['FechaDevolucion'])->format('d-m-Y');        
                $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$devolucion['FechaDevolucion'])->format('d-m-Y');        
                $data['TotalFactura'] = $TotalFactura;
                $data['TotalSaldo'] = $TotalSaldoFactura;
                $data['SaldoFavor'] = $SaldoFavor;
                $data['UrlPdfBsale'] = $devolucion['UrlPdfBsale'];
                $data['TipoDocumento'] = 'Nota de crédito';
                if($devolucion['priceAdjustment'] == 1){
                    $data['TipoDocumento'] = 'Nota de crédito por ajuste de precio';
                }
                if($devolucion['editTexts'] == 1){
                    $data['TipoDocumento'] = 'Nota de crédito por corrección de texto';
                }
                $data['ClaseCliente'] = $factura['ClaseCliente'];
                $data['NombreServicio'] = $factura['NombreServicio'];
                $data['TipoFacturacion'] = $factura['TipoFacturacion'];
                $data['Acciones'] = $Acciones;
                $data['EstatusFacturacion'] = 2;
                array_push($ToReturn,$data);
                if($DevolucionAnulada == 1){
                    $DevolucionId = $devolucion['Id'];
                    $query = "SELECT Id, FechaAnulacion, NumeroDocumento, UrlPdfBsale FROM anulaciones WHERE DevolucionId = '".$DevolucionId."'";
                    $anulaciones = $run->select($query);
                    if($anulaciones){
                        $anulacion = $anulaciones[0];
                        $data = array();
                        $data['Id'] = $anulacion['Id'];
                        $data['DocumentoId'] = $Id;
                        $data['Cliente'] = $factura['Cliente'];
                        $data['NumeroDocumento'] = $anulacion['NumeroDocumento'];
                        $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$anulacion['FechaAnulacion'])->format('d-m-Y');        
                        $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$anulacion['FechaAnulacion'])->format('d-m-Y');        
                        $data['TotalFactura'] = $TotalFactura;
                        $data['TotalSaldo'] = $TotalSaldoFactura;
                        $data['SaldoFavor'] = $SaldoFavor;
                        $data['UrlPdfBsale'] = $anulacion['UrlPdfBsale'];
                        $data['TipoDocumento'] = 'Nota de debito';
                        $data['ClaseCliente'] = $factura['ClaseCliente'];
                        $data['NombreServicio'] = $factura['NombreServicio'];
                        $data['TipoFacturacion'] = $factura['TipoFacturacion'];
                        $data['EstatusFacturacion'] = 3;
                        array_push($ToReturn,$data);
                    }
                }
            }
        }
    }
    // print_r($facturas);exit;
    foreach($ToReturn as $datos) {
    // $FechaFacturacion = \DateTime::createFromFormat('Y-m-d',$datos['FechaFacturacion'])->format('d-m-Y');
    // $fechaVencimiento = \DateTime::createFromFormat('Y-m-d',$datos['FechaVencimiento'])->format('d-m-Y');
    $objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$index, $datos['Cliente'])
    ->setCellValue('B'.$index, $datos['TipoDocumento'])
    ->setCellValue('C'.$index, $datos['NumeroDocumento'])
    ->setCellValue('D'.$index, $datos['FechaFacturacion'])
    ->setCellValue('E'.$index, $datos['FechaVencimiento'])
    ->setCellValue('F'.$index, $datos['TotalFactura'])
    ->setCellValue('G'.$index, $datos['TipoFacturacion'])
    ->setCellValue('H'.$index, $datos['ClaseCliente']);
    $index ++; 
    }
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