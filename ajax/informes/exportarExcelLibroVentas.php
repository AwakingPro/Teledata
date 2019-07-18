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
	->setTitle("Informe de Pagos Mensuales y Anuales")
	->setSubject("Informe de Pagos Mensuales y Anuales")
	->setDescription("Informe de Pagos Mensuales y Anuales")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Informe de Pagos Mensuales y Anuales");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'Nombre De Cliente')
    ->setCellValue('B1', 'Documento')
    ->setCellValue('C1', 'RUT Receptor')
	->setCellValue('D1', 'Nº Doc')
    ->setCellValue('E1', 'Fecha Doc')
    ->setCellValue('F1', 'Monto Neto')
    ->setCellValue('G1', 'IVA')
	->setCellValue('H1', 'Monto total')
    ->setCellValue('I1', 'Nº Relación')
    ->setCellValue('J1', 'Informe SII');
    
    // filtros
    $objPHPExcel->getActiveSheet()->setAutoFilter("A1:J1");

foreach (range(0, 12) as $col) {
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}

if(isset($_GET['startDate']) && isset($_GET['endDate'])){
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
}
$Rut = '';
if(isset($_GET['rut']) && $_GET['rut'] != '') {
    $Rut = $_GET['rut'];
}

$run = new Method;
$ToReturn = array();
$query = "  SELECT
    personaempresa.nombre AS Cliente,
    personaempresa.rut AS RUT,
    personaempresa.dv AS DV,
    personaempresa.posee_pac AS PAC,
    facturas.Id,
    facturas.DocumentoIdBsale,
    facturas.NumeroDocumento,
    facturas.FechaFacturacion,
    facturas.FechaVencimiento,
    facturas.UrlPdfBsale,
    facturas.CountDTE,
    mantenedor_tipo_cliente.nombre AS TipoDocumento,
    facturas.IVA,
    facturas.EstatusFacturacion,
    facturas.informedSiiBsale AS InformeSII,
    IFNULL( ( SELECT SUM( Valor ) FROM facturas_detalle WHERE FacturaId = facturas.Id ), 0 ) AS MontoNeto,
    IFNULL( ( SELECT SUM( Monto ) FROM facturas_pagos WHERE FacturaId = facturas.Id ), 0 ) AS TotalSaldo,
    facturas_pagos.Detalle as Detalle
FROM
    facturas
    INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id
    INNER JOIN personaempresa ON facturas.Rut = personaempresa.rut 
    LEFT JOIN facturas_pagos ON facturas_pagos.FacturaId = facturas.Id
WHERE
    facturas.EstatusFacturacion != '0' AND facturas.EstatusFacturacion != '3' AND facturas.EstatusFacturacion != '4' ";
if($startDate){
    $dt = \DateTime::createFromFormat('d-m-Y',$startDate);
    $startDate = $dt->format('Y-m-d'); 
    $dt = \DateTime::createFromFormat('d-m-Y',$endDate);
    $endDate = $dt->format('Y-m-d');
    $query .= " AND facturas.FechaFacturacion BETWEEN '".$startDate."' AND '".$endDate."'";
}
if($Rut){
    $query .= " AND facturas.Rut = '".$Rut."'";
}

$query .= " ORDER BY Cliente";

$facturas = $run->select($query);
$NumRelacion = '';

if($facturas){
    $index = 2;
    foreach($facturas as $factura){
        $Id = $factura['Id'];
        $DocumentoIdBsale = $factura['DocumentoIdBsale'];
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
        $data['NumeroDocumento'] = $factura['NumeroDocumento'];
        $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');        
        // $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');        
        $data['TotalFactura'] = $TotalFactura;
        //total saldo es el pago total
        $data['MontoNeto'] = $factura['MontoNeto'];
        $data['IVA'] = $factura['MontoNeto'] * $IVA;
        $data['TotalSaldo'] = $TotalSaldo;
        $data['TipoDocumento'] = $factura['TipoDocumento'];
        $data['Cliente'] = $factura['Cliente'];
        $data['RUT'] = $factura['RUT'].'-'.$factura['DV'];
        if($factura['Detalle'] == '' || $factura['Detalle'] == null)
        $factura['Detalle'] = 'Sin Detalle';

        $data['Detalle'] = $factura['Detalle'];
        $data['Acciones'] = $Acciones;
        $data['EstatusFacturacion'] = 1;
        // informedSii, indica si el documento fue informado al SII, 0 es correcto, 1 es enviado, 2 es rechazado (Integer).
        if($factura['InformeSII'] == 0)
        $data['InformeSII'] = 'Correcto';
        if($factura['InformeSII'] == 1)
        $data['InformeSII'] = 'Enviado';
        if($factura['InformeSII'] == 2)
        $data['InformeSII'] = 'Rechazado';
        $data['NumRelacion'] = $NumRelacion;
        array_push($ToReturn,$data);
        if($EstatusFacturacion == 2){
            $query = "SELECT Id, FechaDevolucion, NumeroDocumento, UrlPdfBsale, DevolucionAnulada, DevolucionAmount FROM devoluciones WHERE FacturaId = '".$Id."'";
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
                $data['RUT'] = $factura['RUT'].'-'.$factura['DV'];
                $data['PAC'] = $factura['PAC'];
                $data['NumeroDocumento'] = $devolucion['NumeroDocumento'];
                $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$devolucion['FechaDevolucion'])->format('d-m-Y');        
                // $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$devolucion['FechaDevolucion'])->format('d-m-Y');   
                $neto = $devolucion['DevolucionAmount'] / 1.19;     
                $data['MontoNeto'] = $neto;
                $data['IVA'] = $data['MontoNeto'] * $IVA;
                $data['TotalFactura'] = $devolucion['DevolucionAmount'];
                $data['TotalSaldo'] = $TotalSaldoFactura - $devolucion['DevolucionAmount'];
                $data['TipoDocumento'] = 'Nota de crédito';
                $data['Detalle'] = $factura['Detalle'];
                $data['Acciones'] = $Acciones;
                $data['EstatusFacturacion'] = 2;
                if($factura['InformeSII'] == 0)
                $data['InformeSII'] = 'Correcto';
                if($factura['InformeSII'] == 1)
                $data['InformeSII'] = 'Enviado';
                if($factura['InformeSII'] == 2)
                $data['InformeSII'] = 'Rechazado';
                $data['NumRelacion'] = $FNumeroDocumento;
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
                        $data['RUT'] = $factura['RUT'].'-'.$factura['DV'];
                        $data['NumeroDocumento'] = $anulacion['NumeroDocumento'];
                        $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$anulacion['FechaAnulacion'])->format('d-m-Y');        
                        // $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$anulacion['FechaAnulacion'])->format('d-m-Y');        
                        $data['MontoNeto'] = $factura['MontoNeto'];
                        $data['IVA'] = $factura['MontoNeto'] * $IVA;
                        $data['TotalFactura'] = $TotalFactura;
                        $data['TotalSaldo'] = $TotalSaldoFactura;
                        $data['TipoDocumento'] = 'Nota de debito';
                        $data['EstatusFacturacion'] = 3;
                        if($factura['InformeSII'] == 0)
                        $data['InformeSII'] = 'Correcto';
                        if($factura['InformeSII'] == 1)
                        $data['InformeSII'] = 'Enviado';
                        if($factura['InformeSII'] == 2)
                        $data['InformeSII'] = 'Rechazado';
                        $data['NumRelacion'] = $FNumeroDocumento;
                        array_push($ToReturn, $data);
                    }
                }
            }
        }
    }
    $TotalNeto = 0;
    $TotalIVA = 0;
    $TotalTotal = 0;
    $TotalSaldo = 0;
    // echo '<pre>'; print_r($ToReturn); echo '</pre>';exit;
    foreach($ToReturn as $datos) {

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$index, $datos['Cliente'])
        ->setCellValue('B'.$index, $datos['TipoDocumento'])
        ->setCellValue('C'.$index, $datos['RUT'])
        ->setCellValue('D'.$index, $datos['NumeroDocumento'])
        ->setCellValue('E'.$index, $datos['FechaFacturacion'])
        // ->setCellValue('F'.$index, '$datos['FechaVencimiento']')
        ->setCellValue('F'.$index, round($datos['MontoNeto']))
        ->setCellValue('G'.$index, round($datos['IVA']))
        ->setCellValue('H'.$index, $datos['TotalFactura'])
        // ->setCellValue('I'.$index, $datos['TotalSaldo'])
        // ->setCellValue('K'.$index, $datos['Detalle'])
        ->setCellValue('I'.$index, $datos['NumRelacion'])
        ->setCellValue('J'.$index, $datos['InformeSII']);
        $TotalNeto += $datos['MontoNeto'];
        $TotalIVA += $datos['IVA'];
        $TotalTotal += $datos['TotalFactura'];
        // $TotalSaldo += $datos['TotalSaldo'];
        // $TotalSaldoFavor += $datos['SaldoFavor'];
        $index++;
    } 
    // echo '<pre>'; print_r($ToReturn); echo '</pre>';exit;
    // Agregar Informacion
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('F'.$index, 'Total Neto')
    ->setCellValue('G'.$index, 'Total IVA')
    ->setCellValue('H'.$index, 'Total');
    // ->setCellValue('J'.$index, 'Total Doc')
    // ->setCellValue('K'.$index, 'Total Saldo Favor');
    $index++;
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('F'.$index, round($TotalNeto))
    ->setCellValue('G'.$index, round($TotalIVA))
    ->setCellValue('H'.$index, round($TotalTotal));
    // ->setCellValue('J'.$index, $TotalSaldo)
    // ->setCellValue('K'.$index, $TotalSaldoFavor);
    
}else{
    echo 'No existen datos para esta consulta';
    return;
}

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Informe de Cobranza');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=Libro de Ventas.xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>