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
	->setTitle("Informe clientes con servicios")
	->setSubject("Informe clientes con servicios")
	->setDescription("Informe clientes con servicios")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Informe clientes con servicios");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('F1', 'ENERO')
	->setCellValue('A2', 'Nº')
	->setCellValue('B2', 'Razón social')
    ->setCellValue('C2', 'RUT')
    ->setCellValue('D2', 'Código servicio')
    ->setCellValue('E2', 'Fecha instalación')
	->setCellValue('F2', 'Tipo y Nº. Doc')
	->setCellValue('G2', 'Total doc')
	->setCellValue('H2', 'Deuda')
    ->setCellValue('I2', 'Saldo a favor')
    ->setCellValue('J2', 'Facturación del doc')

    ->setCellValue('P1', 'FEBRERO')
	->setCellValue('K2', 'Nº')
	->setCellValue('L2', 'Razón social')
    ->setCellValue('M2', 'RUT')
    ->setCellValue('N2', 'Código servicio')
    ->setCellValue('O2', 'Fecha instalación')
	->setCellValue('P2', 'Tipo y Nº. Doc')
	->setCellValue('Q2', 'Total doc')
	->setCellValue('R2', 'Deuda')
    ->setCellValue('S2', 'Saldo a favor')
    ->setCellValue('T2', 'Facturación del doc')

    ->setCellValue('Z1', 'MARZO')
	->setCellValue('U2', 'Nº')
	->setCellValue('V2', 'Razón social')
    ->setCellValue('W2', 'RUT')
    ->setCellValue('X2', 'Código servicio')
    ->setCellValue('Y2', 'Fecha instalación')
	->setCellValue('Z2', 'Tipo y Nº. Doc')
	->setCellValue('AA2', 'Total doc')
	->setCellValue('AB2', 'Deuda')
    ->setCellValue('AC2', 'Saldo a favor')
    ->setCellValue('AD2', 'Facturación del doc')

    ->setCellValue('AJ1', 'ABRIL')
	->setCellValue('AE2', 'Nº')
	->setCellValue('AF2', 'Razón social')
    ->setCellValue('AG2', 'RUT')
    ->setCellValue('AH2', 'Código servicio')
    ->setCellValue('AI2', 'Fecha instalación')
	->setCellValue('AJ2', 'Tipo y Nº. Doc')
	->setCellValue('AK2', 'Total doc')
	->setCellValue('AL2', 'Deuda')
    ->setCellValue('AM2', 'Saldo a favor')
    ->setCellValue('AN2', 'Facturación del doc')

    ->setCellValue('AT1', 'MAYO')
	->setCellValue('AO2', 'Nº')
	->setCellValue('AP2', 'Razón social')
    ->setCellValue('AQ2', 'RUT')
    ->setCellValue('AR2', 'Código servicio')
    ->setCellValue('AS2', 'Fecha instalación')
	->setCellValue('AT2', 'Tipo y Nº. Doc')
	->setCellValue('AU2', 'Total doc')
	->setCellValue('AV2', 'Deuda')
    ->setCellValue('AW2', 'Saldo a favor')
    ->setCellValue('AX2', 'Facturación del doc')

    ->setCellValue('BE1', 'JUNIO')
	->setCellValue('AZ2', 'Nº')
	->setCellValue('BA2', 'Razón social')
    ->setCellValue('BB2', 'RUT')
    ->setCellValue('BC2', 'Código servicio')
    ->setCellValue('BD2', 'Fecha instalación')
	->setCellValue('BE2', 'Tipo y Nº. Doc')
	->setCellValue('BF2', 'Total doc')
	->setCellValue('BG2', 'Deuda')
    ->setCellValue('BH2', 'Saldo a favor')
    ->setCellValue('BI2', 'Facturación del doc')

    ->setCellValue('BP1', 'JULIO')
	->setCellValue('BK2', 'Nº')
	->setCellValue('BL2', 'Razón social')
    ->setCellValue('BM2', 'RUT')
    ->setCellValue('BN2', 'Código servicio')
    ->setCellValue('BO2', 'Fecha instalación')
	->setCellValue('BP2', 'Tipo y Nº. Doc')
	->setCellValue('BQ2', 'Total doc')
	->setCellValue('BR2', 'Deuda')
    ->setCellValue('BS2', 'Saldo a favor')
    ->setCellValue('BT2', 'Facturación del doc');

// filtros Y estilo centrado ENERO
$objPHPExcel->getActiveSheet()->mergeCells('F1:G1');
$objPHPExcel->getActiveSheet()->getStyle('F1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// $objPHPExcel->getActiveSheet()->setAutoFilter("D2:E2,N2:O2");
// $objPHPExcel->getActiveSheet()->setAutoFilter(
//     $objPHPExcel->getActiveSheet()
//         ->calculateWorksheetDimension()
// );
// filtros Y estilo centrado FEBRERO
$objPHPExcel->getActiveSheet()->mergeCells('P1:Q1');
$objPHPExcel->getActiveSheet()->getStyle('P1:Q1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// $objPHPExcel->getActiveSheet()->setAutoFilter("N2:O2");
// // filtros Y estilo centrado MARZO
$objPHPExcel->getActiveSheet()->mergeCells('Z1:AA1');
$objPHPExcel->getActiveSheet()->getStyle('Z1:AA1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// $objPHPExcel->getActiveSheet()->setAutoFilter("X2:Y2");
// // filtros Y estilo centrado ABRIL
$objPHPExcel->getActiveSheet()->mergeCells('AJ1:AK1');
$objPHPExcel->getActiveSheet()->getStyle('AJ1:AK1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// $objPHPExcel->getActiveSheet()->setAutoFilter("AH2:AI2");
// // filtros Y estilo centrado MAYO
$objPHPExcel->getActiveSheet()->mergeCells('AT1:AU1');
$objPHPExcel->getActiveSheet()->getStyle('AT1:AU1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// $objPHPExcel->getActiveSheet()->setAutoFilter("AR2:AS2");
// // filtros Y estilo centrado JUNIO
$objPHPExcel->getActiveSheet()->mergeCells('BE1:BF1');
$objPHPExcel->getActiveSheet()->getStyle('BE1:BF1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// // filtros Y estilo centrado JULIO
$objPHPExcel->getActiveSheet()->mergeCells('BP1:BQ1');
$objPHPExcel->getActiveSheet()->getStyle('BP1:BQ1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);







foreach (range(0, 40) as $col) {
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}
$FechaExcel = '';
$startDate = '';
$endDate = '';
if(isset($_GET['startDate']) && $_GET['startDate'] != '' && isset($_GET['endDate']) && $_GET['endDate'] != ''){
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $FechaExcel .= $startDate.' al '.$endDate;
}else{
    $FechaExcel = 'Al '.date('d/m/Y');
}
$Rut = '';
if(isset($_GET['rut']) && $_GET['rut'] != '') {
    $Rut = $_GET['rut'];

}

$run = new Method;
            $ToReturn = array();
            $query = "  SELECT
                personaempresa.nombre AS Cliente,
                personaempresa.dv as DV,
                facturas.Id,
                facturas.Rut,
                facturas.NumeroDocumento,
                facturas.FechaFacturacion,
                mantenedor_tipo_cliente.nombre AS TipoDocumento,
                facturas.IVA,
                facturas.EstatusFacturacion,
                IFNULL( ( SELECT SUM( Monto ) FROM facturas_pagos WHERE FacturaId = facturas.Id ), 0 ) AS TotalSaldo,
                mantenedor_tipo_pago.nombre as Detalle
            FROM
                facturas
                INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id
                INNER JOIN personaempresa ON facturas.Rut = personaempresa.rut 
                LEFT JOIN facturas_pagos ON facturas_pagos.FacturaId = facturas.Id
                LEFT JOIN mantenedor_tipo_pago ON mantenedor_tipo_pago.id = facturas_pagos.TipoPago ";
                // facturas.TipoFactura != '3' AND facturas.EstatusFacturacion != '2'
                // AND facturas.EstatusFacturacion != '0' ";
            if($startDate){
                $dt = \DateTime::createFromFormat('d-m-Y',$startDate);
                $startDate = $dt->format('Y-m-d'); 
                $dt = \DateTime::createFromFormat('d-m-Y',$endDate);
                $endDate = $dt->format('Y-m-d');
                $query .= " WHERE facturas.FechaFacturacion BETWEEN '".$startDate."' AND '".$endDate."'";
            }
            if($Rut){
                if($startDate)
                $query .= " AND facturas.Rut = '".$Rut."'";
                else
                $query .= " WHERE facturas.Rut = '".$Rut."'";
            }

            $query .= "GROUP BY facturas.Id ORDER BY Cliente, FechaFacturacion";
           
            // if($documentType){
            //     $query .= " AND facturas.TipoDocumento = '".$documentType."'";
            // }
            // if($NumeroDocumento){
            //     $query .= " AND facturas.NumeroDocumento = '".$NumeroDocumento."'";
            // }
            $facturas = $run->select($query);
            $NumRelacion = ''; 
            if($facturas){
                // echo '<pre>'; print_r($facturas); echo '</pre>'; exit;
                $index = 3;
                foreach($facturas as $factura){
                    $data = array();
                    $Id = $factura['Id'];
                    $IVA = $factura['IVA'];  
                    $EstatusFacturacion = $factura['EstatusFacturacion'];
                    $FNumeroDocumento = $factura['NumeroDocumento'];
                    $TotalFactura = 0;
                    $query = "SELECT Total, (facturas_detalle.Descuento + IFNULL((SELECT SUM(descuentos_aplicados.Porcentaje) FROM descuentos_aplicados
                     WHERE IdDetalle = facturas_detalle.Id),0)) as Descuento, facturas_detalle.Codigo, servicios.FechaInstalacion FROM facturas_detalle
                     INNER JOIN servicios ON servicios.Id = facturas_detalle.IdServicio
                     WHERE FacturaId = '".$Id."' AND facturas_detalle.Codigo != '' ";
                    $detalles = $run->select($query);
                    if(count($detalles)){
                        // echo '<pre>'; print_r($detalles); echo '</pre>'; exit;
                        foreach($detalles as $detalle){
                            $Total = $detalle['Total'];
                            $Descuento = floatval($detalle['Descuento']) / 100;
                            $Descuento = $Total * $Descuento;
                            $Total -= $Descuento;
                            $TotalFactura += round($Total,0);
                        }
                        // echo '<pre>'; print_r($detalles); echo '</pre>'; exit;
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
                        $Id = $factura['Id'];
                        $data['facturas_detalle'] = $detalles;
                        $data['Id'] = $Id;
                        $data['DocumentoId'] = $Id;
                        $data['Cliente'] = $factura['Cliente'];
                        $data['RUT'] = $factura['Rut'];
                        $data['DV'] =  $factura['DV'];
                        if($factura['NumeroDocumento'] == ''){
                            $factura['NumeroDocumento'] = 'No emitida';
                        }else{
                            $factura['NumeroDocumento'] = $FNumeroDocumento;
                        }
                        $data['NumeroDocumento'] = $factura['NumeroDocumento'];
                        $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');       
                        $data['TotalFactura'] = $TotalFactura;
                        //total saldo es el pago total
                        $data['TotalSaldo'] = $TotalSaldo;
                        $data['SaldoFavor'] = $SaldoFavor;
                        $data['TipoDocumento'] = $factura['TipoDocumento'];
                        if($factura['Detalle'] == '' || $factura['Detalle'] == null)
                        $factura['Detalle'] = 'Sin Detalle';
                        $data['Detalle'] = $factura['Detalle'];
                        $data['EstatusFacturacion'] = 1;
                        $data['NumRelacion'] = $NumRelacion;
                        // echo '<pre>'; print_r($data); echo '</pre>'; exit;
                        array_push($ToReturn,$data);
                        if($EstatusFacturacion == 2){
                            $query = "SELECT Id, NumeroDocumento, DevolucionAnulada, priceAdjustment, editTexts FROM devoluciones WHERE FacturaId = '".$Id."'";
                            $devoluciones = $run->select($query);
                            if($devoluciones){
                                $devolucion = $devoluciones[0];
                                $DevolucionAnulada = $devolucion['DevolucionAnulada'];
                                $data = array();
                                $data['facturas_detalle'] = $detalles;
                                $data['Id'] = $devolucion['Id'];
                                $data['DocumentoId'] = $Id;
                                $data['Cliente'] = $factura['Cliente'];
                                $data['RUT'] = $factura['Rut'];
                                $data['DV'] =  $factura['DV'];
                                $data['NumeroDocumento'] = $FNumeroDocumento;
                                $data['FechaFacturacion'] = $factura['FechaFacturacion'];        
                                $data['TotalFactura'] = $TotalFactura;
                                $data['TotalSaldo'] = $TotalSaldoFactura;
                                $data['SaldoFavor'] = $SaldoFavor;
                                $data['TipoDocumento'] = 'NC-'.$devolucion['NumeroDocumento'].' | Doc. Ref';
                                if($devolucion['priceAdjustment'] == 1){
                                    $data['TipoDocumento'] = 'NC por ajuste de precio-'.$devolucion['NumeroDocumento'];
                                }
                                if($devolucion['editTexts'] == 1){
                                    $data['TipoDocumento'] = 'NC por corrección de texto-'.$devolucion['NumeroDocumento'];
                                }
                                $data['Detalle'] = $factura['Detalle'];
                                $data['EstatusFacturacion'] = 2;
                                $data['NumRelacion'] = $FNumeroDocumento;
                                // echo '<pre>'; print_r($data); echo '</pre>'; exit;
                                array_push($ToReturn,$data);
                                if($DevolucionAnulada == 1){
                                    $DevolucionId = $devolucion['Id'];
                                    $query = "SELECT Id, NumeroDocumento FROM anulaciones WHERE DevolucionId = '".$DevolucionId."'";
                                    $anulaciones = $run->select($query);
                                    if($anulaciones){
                                        $anulacion = $anulaciones[0];
                                        $data = array();
                                        $data['facturas_detalle'] = $detalles;
                                        $data['Id'] = $anulacion['Id'];
                                        $data['DocumentoId'] = $Id;
                                        $data['Cliente'] = $factura['Cliente'];
                                        $data['RUT'] = $factura['Rut'];
                                        $data['DV'] =  $factura['DV'];
                                        $data['NumeroDocumento'] = $anulacion['NumeroDocumento'];
                                        $data['FechaFacturacion'] = 'No corresponde';           
                                        $data['TotalFactura'] = $TotalFactura;
                                        $data['TotalSaldo'] = $TotalSaldoFactura;
                                        $data['SaldoFavor'] = $SaldoFavor;
                                        $data['TipoDocumento'] = 'Nota de debito';
                                        $data['EstatusFacturacion'] = 3;
                                        $data['NumRelacion'] = $FNumeroDocumento;
                                        array_push($ToReturn,$data);
                                    }
                                }
                            }
                        }
                    }
                }
                $contador = 0;
                if(!count($ToReturn)){
                    echo 'No existen datos' . count($ToReturn);
                    exit;
                }
                foreach($ToReturn as $datos) {
                    $contador++;
                    if($datos['TipoDocumento'] == 'Boleta')
                    $datos['TipoDocumento'] = 'B';
                    if($datos['TipoDocumento'] == 'Factura')
                    $datos['TipoDocumento'] = 'F';
                    if($datos['TipoDocumento'] == 'Canje')
                    $datos['TipoDocumento'] = 'C';
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$index, $contador)
                    ->setCellValue('B'.$index, $datos['Cliente'])
                    ->setCellValue('C'.$index, $datos['RUT'].'-'.$datos['DV'])
                    ->setCellValue('F'.$index, $datos['TipoDocumento'].'-'.$datos['NumeroDocumento'])
                    ->setCellValue('G'.$index, $datos['TotalFactura'])
                    ->setCellValue('H'.$index, $datos['TotalSaldo'])
                    ->setCellValue('I'.$index, $datos['SaldoFavor'])
                    ->setCellValue('J'.$index, date('d-F-Y', strtotime($datos['FechaFacturacion'])));
                    
                    // $Total += $data['TotalSaldo'];
                    $run->cellColor('A'.$index.':J'.$index, 'A6A6FF');
                    if($datos['TotalSaldo'] > 0){
                        $run->cellColor('H'.$index, 'F28A8C');
                    }
                    if($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']){
                        $run->cellColor('H'.$index, 'FFFF00');
                    }
                    if($datos['TotalSaldo'] == 0){
                        $run->cellColor('H'.$index, '92D050');
                    }
                    foreach($datos['facturas_detalle'] as $detalle) {
                        $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d',$detalle['FechaInstalacion'])->format('d-m-Y');
                        $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D'.$index, $detalle['Codigo'])
                        ->setCellValue('E'.$index, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                        $run->cellColor('D'.$index.':E'.$index, '7474FF');
                        $index++;
                        
                    }
                    $index++;
                }
                // $objPHPExcel->setActiveSheetIndex(0)
                // ->setCellValue('H'.$index, $Total);
            }else{
                echo 'No existen datos para esta consulta';
                return;
            }
            
            // echo '<pre>'; print_r($ToReturn); echo '</pre>'; exit;
            // Renombrar Hoja
            $objPHPExcel->getActiveSheet()->setTitle('Informe de clientes y servicios');

            // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment; filename=Informe clientes con servicios ".$FechaExcel.' '.$Rut.".xlsx");
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
            ?>