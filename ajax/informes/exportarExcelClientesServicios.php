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
    ->setCellValue('BT2', 'Facturación del doc')

    ->setCellValue('CA1', 'AGOSTO')
    ->setCellValue('BV2', 'Nº')
    ->setCellValue('BW2', 'Razón social')
    ->setCellValue('BX2', 'RUT')
    ->setCellValue('BY2', 'Código servicio')
    ->setCellValue('BZ2', 'Fecha instalación')
    ->setCellValue('CA2', 'Tipo y Nº. Doc')
    ->setCellValue('CB2', 'Total doc')
    ->setCellValue('CC2', 'Deuda')
    ->setCellValue('CD2', 'Saldo a favor')
    ->setCellValue('CE2', 'Facturación del doc')

    ->setCellValue('CL1', 'SEPTIEMBRE')
    ->setCellValue('CG2', 'Nº')
    ->setCellValue('CH2', 'Razón social')
    ->setCellValue('CI2', 'RUT')
    ->setCellValue('CJ2', 'Código servicio')
    ->setCellValue('CK2', 'Fecha instalación')
    ->setCellValue('CL2', 'Tipo y Nº. Doc')
    ->setCellValue('CM2', 'Total doc')
    ->setCellValue('CN2', 'Deuda')
    ->setCellValue('CO2', 'Saldo a favor')
    ->setCellValue('CP2', 'Facturación del doc')

    ->setCellValue('CW1', 'OCTUBRE')
    ->setCellValue('CR2', 'Nº')
    ->setCellValue('CS2', 'Razón social')
    ->setCellValue('CT2', 'RUT')
    ->setCellValue('CU2', 'Código servicio')
    ->setCellValue('CV2', 'Fecha instalación')
    ->setCellValue('CW2', 'Tipo y Nº. Doc')
    ->setCellValue('CX2', 'Total doc')
    ->setCellValue('CY2', 'Deuda')
    ->setCellValue('CZ2', 'Saldo a favor')
    ->setCellValue('DA2', 'Facturación del doc')

    ->setCellValue('DH1', 'NOVIEMBRE')
    ->setCellValue('DC2', 'Nº')
    ->setCellValue('DD2', 'Razón social')
    ->setCellValue('DE2', 'RUT')
    ->setCellValue('DF2', 'Código servicio')
    ->setCellValue('DG2', 'Fecha instalación')
    ->setCellValue('DH2', 'Tipo y Nº. Doc')
    ->setCellValue('DI2', 'Total doc')
    ->setCellValue('DJ2', 'Deuda')
    ->setCellValue('DK2', 'Saldo a favor')
    ->setCellValue('DL2', 'Facturación del doc')

    ->setCellValue('DS1', 'DICIEMBRE')
    ->setCellValue('DN2', 'Nº')
    ->setCellValue('DO2', 'Razón social')
    ->setCellValue('DP2', 'RUT')
    ->setCellValue('DQ2', 'Código servicio')
    ->setCellValue('DR2', 'Fecha instalación')
    ->setCellValue('DS2', 'Tipo y Nº. Doc')
    ->setCellValue('DT2', 'Total doc')
    ->setCellValue('DU2', 'Deuda')
    ->setCellValue('DV2', 'Saldo a favor')
    ->setCellValue('DW2', 'Facturación del doc');

$run = new Method;
// filtros Y estilo centrado ENERO
$objPHPExcel->getActiveSheet()->mergeCells('F1:G1');
$objPHPExcel->getActiveSheet()->getStyle('F1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('F1:G1', '7474FF');

// $objPHPExcel->getActiveSheet()->setAutoFilter("D2:E2,N2:O2");
// $objPHPExcel->getActiveSheet()->setAutoFilter(
//     $objPHPExcel->getActiveSheet()
//         ->calculateWorksheetDimension()
// );
// filtros Y estilo centrado FEBRERO
$objPHPExcel->getActiveSheet()->mergeCells('P1:Q1');
$objPHPExcel->getActiveSheet()->getStyle('P1:Q1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('P1:Q1', '7474FF');
// $objPHPExcel->getActiveSheet()->setAutoFilter("N2:O2");
// filtros Y estilo centrado MARZO
$objPHPExcel->getActiveSheet()->mergeCells('Z1:AA1');
$objPHPExcel->getActiveSheet()->getStyle('Z1:AA1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('Z1:AA1', '7474FF');
// $objPHPExcel->getActiveSheet()->setAutoFilter("X2:Y2");
// filtros Y estilo centrado ABRIL
$objPHPExcel->getActiveSheet()->mergeCells('AJ1:AK1');
$objPHPExcel->getActiveSheet()->getStyle('AJ1:AK1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('AJ1:AK1', '7474FF');
// $objPHPExcel->getActiveSheet()->setAutoFilter("AH2:AI2");
// filtros Y estilo centrado MAYO
$objPHPExcel->getActiveSheet()->mergeCells('AT1:AU1');
$objPHPExcel->getActiveSheet()->getStyle('AT1:AU1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('AT1:AU1', '7474FF');
// $objPHPExcel->getActiveSheet()->setAutoFilter("AR2:AS2");
// filtros Y estilo centrado JUNIO
$objPHPExcel->getActiveSheet()->mergeCells('BE1:BF1');
$objPHPExcel->getActiveSheet()->getStyle('BE1:BF1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('BE1:BF1', '7474FF');
// filtros Y estilo centrado JULIO
$objPHPExcel->getActiveSheet()->mergeCells('BP1:BQ1');
$objPHPExcel->getActiveSheet()->getStyle('BP1:BQ1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('BP1:BQ1', '7474FF');
// filtros Y estilo centrado AGOSTO
$objPHPExcel->getActiveSheet()->mergeCells('CA1:CB1');
$objPHPExcel->getActiveSheet()->getStyle('CA1:CB1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('CA1:CB1', '7474FF');
// // filtros Y estilo centrado SEPTIEMBRE
$objPHPExcel->getActiveSheet()->mergeCells('CL1:CM1');
$objPHPExcel->getActiveSheet()->getStyle('CL1:CM1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('CL1:CM1', '7474FF');
// filtros Y estilo centrado OCTUBRE
$objPHPExcel->getActiveSheet()->mergeCells('CW1:CX1');
$objPHPExcel->getActiveSheet()->getStyle('CW1:CX1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('CW1:CX1', '7474FF');
// filtros Y estilo centrado NOVIEMBRE
$objPHPExcel->getActiveSheet()->mergeCells('DH1:DI1');
$objPHPExcel->getActiveSheet()->getStyle('DH1:DI1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('DH1:DI1', '7474FF');
// filtros Y estilo centrado DICIEMBRE
$objPHPExcel->getActiveSheet()->mergeCells('DS1:DT1');
$objPHPExcel->getActiveSheet()->getStyle('DS1:DT1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$run->cellColor('DS1:DT1', '7474FF');

foreach (range(0, 138) as $col) {
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}
$FechaExcel = '';
$startDate = '';
$endDate = '';
if (isset($_GET['startDate']) && $_GET['startDate'] != '' && isset($_GET['endDate']) && $_GET['endDate'] != '') {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $FechaExcel .= $startDate . ' al ' . $endDate;
} else {
    $FechaExcel = 'Al ' . date('d/m/Y');
}
$Rut = '';
if (isset($_GET['rut']) && $_GET['rut'] != '') {
    $Rut = $_GET['rut'];
}

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
                LEFT JOIN mantenedor_tipo_pago ON mantenedor_tipo_pago.id = facturas_pagos.TipoPago  WHERE deleted_at IS NULL ";
// facturas.TipoFactura != '3' AND facturas.EstatusFacturacion != '2'
// AND facturas.EstatusFacturacion != '0' ";
if ($startDate) {
    $dt = \DateTime::createFromFormat('d-m-Y', $startDate);
    $startDate = $dt->format('Y-m-d');
    $dt = \DateTime::createFromFormat('d-m-Y', $endDate);
    $endDate = $dt->format('Y-m-d');
    $query .= " AND facturas.FechaFacturacion BETWEEN '" . $startDate . "' AND '" . $endDate . "'";
}
if ($Rut) {
    $query .= " AND facturas.Rut = '" . $Rut . "'";
}

$query .= "GROUP BY facturas.Id ORDER BY facturas.FechaFacturacion, Cliente";

// if($documentType){
//     $query .= " AND facturas.TipoDocumento = '".$documentType."'";
// }
// if($NumeroDocumento){
//     $query .= " AND facturas.NumeroDocumento = '".$NumeroDocumento."'";
// }
$facturas = $run->select($query);
$NumRelacion = '';
if ($facturas) {
    // echo '<pre>'; print_r($facturas); echo '</pre>'; exit;
    $indexEnero = 3;
    $indexFebrero = 3;
    $indexMarzo = 3;
    $indexAbril = 3;
    $indexMayo = 3;
    $indexJunio = 3;
    $indexJulio = 3;
    $indexAgosto = 3;
    $indexSeptiembre = 3;
    $indexOctubre = 3;
    $indexNoviembre = 3;
    $indexDiciembre = 3;

    foreach ($facturas as $factura) {
        $data = array();
        $Id = $factura['Id'];
        $IVA = $factura['IVA'];
        $EstatusFacturacion = $factura['EstatusFacturacion'];
        $FNumeroDocumento = $factura['NumeroDocumento'];
        $TotalFactura = 0;
        $query = "SELECT Total, (facturas_detalle.Descuento + IFNULL((SELECT SUM(descuentos_aplicados.Porcentaje) FROM descuentos_aplicados
                     WHERE IdDetalle = facturas_detalle.Id),0)) as Descuento, facturas_detalle.Codigo, servicios.FechaInstalacion FROM facturas_detalle
                     INNER JOIN servicios ON servicios.Id = facturas_detalle.IdServicio
                     WHERE FacturaId = '" . $Id . "' AND facturas_detalle.Codigo != '' ";
        $detalles = $run->select($query);
        if (count($detalles)) {
            // echo '<pre>'; print_r($detalles); echo '</pre>'; exit;
            foreach ($detalles as $detalle) {
                $Total = $detalle['Total'];
                $Descuento = floatval($detalle['Descuento']) / 100;
                $Descuento = $Total * $Descuento;
                $Total -= $Descuento;
                $TotalFactura += round($Total, 0);
            }
            // echo '<pre>'; print_r($detalles); echo '</pre>'; exit;
            $SaldoFavor = 0;
            $TotalSaldo = $factura['TotalSaldo'];
            $TotalSaldo = $TotalFactura - $TotalSaldo;
            $SaldoFavor = $factura['TotalSaldo'] - $TotalFactura;
            if ($TotalSaldo < 0) {
                $TotalSaldo = 0;
            }
            if ($SaldoFavor < 0) {
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
            if ($factura['NumeroDocumento'] == '' || $EstatusFacturacion == 0) {
                $factura['NumeroDocumento'] = 'No emitida';
            } else {
                $factura['NumeroDocumento'] = $FNumeroDocumento;
            }
            $data['NumeroDocumento'] = $factura['NumeroDocumento'];
            $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d', $factura['FechaFacturacion'])->format('d-m-Y');
            $data['TotalFactura'] = $TotalFactura;
            //total saldo es el pago total
            $data['TotalSaldo'] = $TotalSaldo;
            $data['SaldoFavor'] = $SaldoFavor;
            $data['TipoDocumento'] = $factura['TipoDocumento'];
            if ($factura['Detalle'] == '' || $factura['Detalle'] == null)
                $factura['Detalle'] = 'Sin Detalle';
            $data['Detalle'] = $factura['Detalle'];
            $data['EstatusFacturacion'] = 1;
            $data['NumRelacion'] = $NumRelacion;
            // echo '<pre>'; print_r($data); echo '</pre>'; exit;
            array_push($ToReturn, $data);
            if ($EstatusFacturacion == 2) {
                $query = "SELECT Id, NumeroDocumento, DevolucionAnulada, priceAdjustment, editTexts FROM devoluciones WHERE FacturaId = '" . $Id . "'";
                $devoluciones = $run->select($query);
                if ($devoluciones) {
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
                    $data['TipoDocumento'] = 'NC-' . $devolucion['NumeroDocumento'] . ' | Doc. Ref';
                    if ($devolucion['priceAdjustment'] == 1) {
                        $data['TipoDocumento'] = 'NC por ajuste de precio-' . $devolucion['NumeroDocumento']. ' | Doc. Ref';
                    }
                    if ($devolucion['editTexts'] == 1) {
                        $data['TipoDocumento'] = 'NC por corrección de texto-' . $devolucion['NumeroDocumento']. ' | Doc. Ref';
                    }
                    $data['Detalle'] = $factura['Detalle'];
                    $data['EstatusFacturacion'] = 2;
                    $data['NumRelacion'] = $FNumeroDocumento;
                    // echo '<pre>'; print_r($data); echo '</pre>'; exit;
                    array_push($ToReturn, $data);
                    if ($DevolucionAnulada == 1) {
                        $DevolucionId = $devolucion['Id'];
                        $query = "SELECT Id, NumeroDocumento FROM anulaciones WHERE DevolucionId = '" . $DevolucionId . "'";
                        $anulaciones = $run->select($query);
                        if ($anulaciones) {
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
                            array_push($ToReturn, $data);
                        }
                    }
                }
            }
        }
    }
    $contadorEnero = 0;
    $contadorFebrero = 0;
    $contadorMarzo = 0;
    $contadorAbril = 0;
    $contadorMayo = 0;
    $contadorJunio = 0;
    $contadorJulio = 0;
    $contadorAgosto = 0;
    $contadorSeptiembre = 0;
    $contadorOctubre = 0;
    $contadorNoviembre = 0;
    $contadorDiciembre = 0;
    if (!count($ToReturn)) {
        echo 'No existen datos' . count($ToReturn);
        exit;
    }
    foreach ($ToReturn as $datos) {

        if ($datos['TipoDocumento'] == 'Boleta')
            $datos['TipoDocumento'] = 'B';
        if ($datos['TipoDocumento'] == 'Factura')
            $datos['TipoDocumento'] = 'F';
        if ($datos['TipoDocumento'] == 'Canje')
            $datos['TipoDocumento'] = 'C';

        $mesEmision = date('m', strtotime($datos['FechaFacturacion']));
        switch ($mesEmision) {
            case 01: {
                    $contadorEnero++;
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $indexEnero, $contadorEnero)
                        ->setCellValue('B' . $indexEnero, $datos['Cliente'])
                        ->setCellValue('C' . $indexEnero, $datos['RUT'] . '-' . $datos['DV'])
                        ->setCellValue('F' . $indexEnero, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                        ->setCellValue('G' . $indexEnero, $datos['TotalFactura'])
                        ->setCellValue('H' . $indexEnero, $datos['TotalSaldo'])
                        ->setCellValue('I' . $indexEnero, $datos['SaldoFavor'])
                        ->setCellValue('J' . $indexEnero, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                    // $Total += $data['TotalSaldo'];
                    $run->cellColor('A' . $indexEnero . ':J' . $indexEnero, 'A6A6FF');
                    if ($datos['TotalSaldo'] > 0) {
                        $run->cellColor('H' . $indexEnero, 'F28A8C');
                    }
                    if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                        $run->cellColor('H' . $indexEnero, 'FFFF00');
                    }
                    if ($datos['TotalSaldo'] == 0) {
                        $run->cellColor('H' . $indexEnero, '92D050');
                    }
                    foreach ($datos['facturas_detalle'] as $detalle) {
                        $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                        $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('D' . $indexEnero, $detalle['Codigo'])
                            ->setCellValue('E' . $indexEnero, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                        $run->cellColor('D' . $indexEnero . ':E' . $indexEnero, '7474FF');
                        $indexEnero++;
                    }
                    $indexEnero++;
                    break;
                }
            case 02: {
                    $contadorFebrero++;
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $indexFebrero, $contadorFebrero)
                        ->setCellValue('L' . $indexFebrero, $datos['Cliente'])
                        ->setCellValue('M' . $indexFebrero, $datos['RUT'] . '-' . $datos['DV'])
                        ->setCellValue('P' . $indexFebrero, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                        ->setCellValue('Q' . $indexFebrero, $datos['TotalFactura'])
                        ->setCellValue('R' . $indexFebrero, $datos['TotalSaldo'])
                        ->setCellValue('S' . $indexFebrero, $datos['SaldoFavor'])
                        ->setCellValue('T' . $indexFebrero, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                    // $Total += $data['TotalSaldo'];
                    $run->cellColor('K' . $indexFebrero . ':T' . $indexFebrero, 'A6A6FF');
                    if ($datos['TotalSaldo'] > 0) {
                        $run->cellColor('R' . $indexFebrero, 'F28A8C');
                    }
                    if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                        $run->cellColor('R' . $indexFebrero, 'FFFF00');
                    }
                    if ($datos['TotalSaldo'] == 0) {
                        $run->cellColor('R' . $indexFebrero, '92D050');
                    }
                    foreach ($datos['facturas_detalle'] as $detalle) {
                        $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                        $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('N' . $indexFebrero, $detalle['Codigo'])
                            ->setCellValue('O' . $indexFebrero, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                        $run->cellColor('N' . $indexFebrero . ':O' . $indexFebrero, '7474FF');
                        $indexFebrero++;
                    }
                    $indexFebrero++;
                    break;
                }
            case 03: {
                $contadorMarzo++;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('U' . $indexMarzo, $contadorMarzo)
                    ->setCellValue('V' . $indexMarzo, $datos['Cliente'])
                    ->setCellValue('W' . $indexMarzo, $datos['RUT'] . '-' . $datos['DV'])
                    ->setCellValue('Z' . $indexMarzo, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                    ->setCellValue('AA' . $indexMarzo, $datos['TotalFactura'])
                    ->setCellValue('AB' . $indexMarzo, $datos['TotalSaldo'])
                    ->setCellValue('AC' . $indexMarzo, $datos['SaldoFavor'])
                    ->setCellValue('AD' . $indexMarzo, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                // $Total += $data['TotalSaldo'];
                $run->cellColor('U' . $indexMarzo . ':AD' . $indexMarzo, 'A6A6FF');
                if ($datos['TotalSaldo'] > 0) {
                    $run->cellColor('AB' . $indexMarzo, 'F28A8C');
                }
                if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                    $run->cellColor('AB' . $indexMarzo, 'FFFF00');
                }
                if ($datos['TotalSaldo'] == 0) {
                    $run->cellColor('AB' . $indexMarzo, '92D050');
                }
                foreach ($datos['facturas_detalle'] as $detalle) {
                    $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('X' . $indexMarzo, $detalle['Codigo'])
                        ->setCellValue('Y' . $indexMarzo, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                    $run->cellColor('X' . $indexMarzo . ':Y' . $indexMarzo, '7474FF');
                    $indexMarzo++;
                }
                $indexMarzo++;
                break;
            }
            case 04: {
                $contadorAbril++;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AE' . $indexAbril, $contadorAbril)
                    ->setCellValue('AF' . $indexAbril, $datos['Cliente'])
                    ->setCellValue('AG' . $indexAbril, $datos['RUT'] . '-' . $datos['DV'])
                    ->setCellValue('AJ' . $indexAbril, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                    ->setCellValue('AK' . $indexAbril, $datos['TotalFactura'])
                    ->setCellValue('AL' . $indexAbril, $datos['TotalSaldo'])
                    ->setCellValue('AM' . $indexAbril, $datos['SaldoFavor'])
                    ->setCellValue('AN' . $indexAbril, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                // $Total += $data['TotalSaldo'];
                $run->cellColor('AE' . $indexAbril . ':AN' . $indexAbril, 'A6A6FF');
                if ($datos['TotalSaldo'] > 0) {
                    $run->cellColor('AL' . $indexAbril, 'F28A8C');
                }
                if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                    $run->cellColor('AL' . $indexAbril, 'FFFF00');
                }
                if ($datos['TotalSaldo'] == 0) {
                    $run->cellColor('AL' . $indexAbril, '92D050');
                }
                foreach ($datos['facturas_detalle'] as $detalle) {
                    $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('AH' . $indexAbril, $detalle['Codigo'])
                        ->setCellValue('AI' . $indexAbril, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                    $run->cellColor('AH' . $indexAbril . ':AI' . $indexAbril, '7474FF');
                    $indexAbril++;
                }
                $indexAbril++;
                break;
            }
            case 05: {
                $contadorMayo++;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AO' . $indexMayo, $contadorMayo)
                    ->setCellValue('AP' . $indexMayo, $datos['Cliente'])
                    ->setCellValue('AQ' . $indexMayo, $datos['RUT'] . '-' . $datos['DV'])
                    ->setCellValue('AT' . $indexMayo, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                    ->setCellValue('AU' . $indexMayo, $datos['TotalFactura'])
                    ->setCellValue('AV' . $indexMayo, $datos['TotalSaldo'])
                    ->setCellValue('AW' . $indexMayo, $datos['SaldoFavor'])
                    ->setCellValue('AX' . $indexMayo, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                // $Total += $data['TotalSaldo'];
                $run->cellColor('AO' . $indexMayo . ':AX' . $indexMayo, 'A6A6FF');
                if ($datos['TotalSaldo'] > 0) {
                    $run->cellColor('AV' . $indexMayo, 'F28A8C');
                }
                if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                    $run->cellColor('AV' . $indexMayo, 'FFFF00');
                }
                if ($datos['TotalSaldo'] == 0) {
                    $run->cellColor('AV' . $indexMayo, '92D050');
                }
                foreach ($datos['facturas_detalle'] as $detalle) {
                    $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('AR' . $indexMayo, $detalle['Codigo'])
                        ->setCellValue('AS' . $indexMayo, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                    $run->cellColor('AR' . $indexMayo . ':AS' . $indexMayo, '7474FF');
                    $indexMayo++;
                }
                $indexMayo++;
                break;
            }
            case '06': {
                $contadorJunio++;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AZ' . $indexJunio, $contadorJunio)
                    ->setCellValue('BA' . $indexJunio, $datos['Cliente'])
                    ->setCellValue('BB' . $indexJunio, $datos['RUT'] . '-' . $datos['DV'])
                    ->setCellValue('BE' . $indexJunio, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                    ->setCellValue('BF' . $indexJunio, $datos['TotalFactura'])
                    ->setCellValue('BG' . $indexJunio, $datos['TotalSaldo'])
                    ->setCellValue('BH' . $indexJunio, $datos['SaldoFavor'])
                    ->setCellValue('BI' . $indexJunio, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                // $Total += $data['TotalSaldo'];
                $run->cellColor('AZ' . $indexJunio . ':BI' . $indexJunio, 'A6A6FF');
                if ($datos['TotalSaldo'] > 0) {
                    $run->cellColor('BG' . $indexJunio, 'F28A8C');
                }
                if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                    $run->cellColor('BG' . $indexJunio, 'FFFF00');
                }
                if ($datos['TotalSaldo'] == 0) {
                    $run->cellColor('BG' . $indexJunio, '92D050');
                }
                foreach ($datos['facturas_detalle'] as $detalle) {
                    $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('BC' . $indexJunio, $detalle['Codigo'])
                        ->setCellValue('BD' . $indexJunio, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                    $run->cellColor('BC' . $indexJunio . ':BD' . $indexJunio, '7474FF');
                    $indexJunio++;
                }
                $indexJunio++;
                break;
            }
            case '07': {
                $contadorJulio++;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BK' . $indexJulio, $contadorJulio)
                    ->setCellValue('BL' . $indexJulio, $datos['Cliente'])
                    ->setCellValue('BM' . $indexJulio, $datos['RUT'] . '-' . $datos['DV'])
                    ->setCellValue('BP' . $indexJulio, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                    ->setCellValue('BQ' . $indexJulio, $datos['TotalFactura'])
                    ->setCellValue('BR' . $indexJulio, $datos['TotalSaldo'])
                    ->setCellValue('BS' . $indexJulio, $datos['SaldoFavor'])
                    ->setCellValue('BT' . $indexJulio, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                // $Total += $data['TotalSaldo'];
                $run->cellColor('BK' . $indexJulio . ':BT' . $indexJulio, 'A6A6FF');
                if ($datos['TotalSaldo'] > 0) {
                    $run->cellColor('BR' . $indexJulio, 'F28A8C');
                }
                if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                    $run->cellColor('BR' . $indexJulio, 'FFFF00');
                }
                if ($datos['TotalSaldo'] == 0) {
                    $run->cellColor('BR' . $indexJulio, '92D050');
                }
                foreach ($datos['facturas_detalle'] as $detalle) {
                    $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('BN' . $indexJulio, $detalle['Codigo'])
                        ->setCellValue('BO' . $indexJulio, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                    $run->cellColor('BN' . $indexJulio . ':BO' . $indexJulio, '7474FF');
                    $indexJulio++;
                }
                $indexJulio++;
                break;
            }
            case '08': {
                $contadorAgosto++;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BV' . $indexAgosto, $contadorAgosto)
                    ->setCellValue('BW' . $indexAgosto, $datos['Cliente'])
                    ->setCellValue('BX' . $indexAgosto, $datos['RUT'] . '-' . $datos['DV'])
                    ->setCellValue('CA' . $indexAgosto, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                    ->setCellValue('CB' . $indexAgosto, $datos['TotalFactura'])
                    ->setCellValue('CC' . $indexAgosto, $datos['TotalSaldo'])
                    ->setCellValue('CD' . $indexAgosto, $datos['SaldoFavor'])
                    ->setCellValue('CE' . $indexAgosto, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                // $Total += $data['TotalSaldo'];
                $run->cellColor('BV' . $indexAgosto . ':CE' . $indexAgosto, 'A6A6FF');
                if ($datos['TotalSaldo'] > 0) {
                    $run->cellColor('CC' . $indexAgosto, 'F28A8C');
                }
                if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                    $run->cellColor('CC' . $indexAgosto, 'FFFF00');
                }
                if ($datos['TotalSaldo'] == 0) {
                    $run->cellColor('CC' . $indexAgosto, '92D050');
                }
                foreach ($datos['facturas_detalle'] as $detalle) {
                    $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('BY' . $indexAgosto, $detalle['Codigo'])
                        ->setCellValue('BZ' . $indexAgosto, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                    $run->cellColor('BY' . $indexAgosto . ':BZ' . $indexAgosto, '7474FF');
                    $indexAgosto++;
                }
                $indexAgosto++;
                break;
            }
            case '09': {
                $contadorSeptiembre++;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CG' . $indexSeptiembre, $contadorSeptiembre)
                    ->setCellValue('CH' . $indexSeptiembre, $datos['Cliente'])
                    ->setCellValue('CI' . $indexSeptiembre, $datos['RUT'] . '-' . $datos['DV'])
                    ->setCellValue('CL' . $indexSeptiembre, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                    ->setCellValue('CM' . $indexSeptiembre, $datos['TotalFactura'])
                    ->setCellValue('CN' . $indexSeptiembre, $datos['TotalSaldo'])
                    ->setCellValue('CO' . $indexSeptiembre, $datos['SaldoFavor'])
                    ->setCellValue('CP' . $indexSeptiembre, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                // $Total += $data['TotalSaldo'];
                $run->cellColor('CG' . $indexSeptiembre . ':CP' . $indexSeptiembre, 'A6A6FF');
                if ($datos['TotalSaldo'] > 0) {
                    $run->cellColor('CN' . $indexSeptiembre, 'F28A8C');
                }
                if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                    $run->cellColor('CN' . $indexSeptiembre, 'FFFF00');
                }
                if ($datos['TotalSaldo'] == 0) {
                    $run->cellColor('CN' . $indexSeptiembre, '92D050');
                }
                foreach ($datos['facturas_detalle'] as $detalle) {
                    $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('CJ' . $indexSeptiembre, $detalle['Codigo'])
                        ->setCellValue('CK' . $indexSeptiembre, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                    $run->cellColor('CJ' . $indexSeptiembre . ':CK' . $indexSeptiembre, '7474FF');
                    $indexSeptiembre++;
                }
                $indexSeptiembre++;
                break;
            }
            case 10: {
                $contadorOctubre++;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CR' . $indexOctubre, $contadorOctubre)
                    ->setCellValue('CS' . $indexOctubre, $datos['Cliente'])
                    ->setCellValue('CT' . $indexOctubre, $datos['RUT'] . '-' . $datos['DV'])
                    ->setCellValue('CW' . $indexOctubre, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                    ->setCellValue('CX' . $indexOctubre, $datos['TotalFactura'])
                    ->setCellValue('CY' . $indexOctubre, $datos['TotalSaldo'])
                    ->setCellValue('CZ' . $indexOctubre, $datos['SaldoFavor'])
                    ->setCellValue('DA' . $indexOctubre, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                // $Total += $data['TotalSaldo'];
                $run->cellColor('CR' . $indexOctubre . ':DA' . $indexOctubre, 'A6A6FF');
                if ($datos['TotalSaldo'] > 0) {
                    $run->cellColor('CY' . $indexOctubre, 'F28A8C');
                }
                if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                    $run->cellColor('CY' . $indexOctubre, 'FFFF00');
                }
                if ($datos['TotalSaldo'] == 0) {
                    $run->cellColor('CY' . $indexOctubre, '92D050');
                }
                foreach ($datos['facturas_detalle'] as $detalle) {
                    $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('CU' . $indexOctubre, $detalle['Codigo'])
                        ->setCellValue('CV' . $indexOctubre, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                    $run->cellColor('CU' . $indexOctubre . ':CV' . $indexOctubre, '7474FF');
                    $indexOctubre++;
                }
                $indexOctubre++;
                break;
            }
            case 11: {
                $contadorNoviembre++;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('DC' . $indexNoviembre, $contadorNoviembre)
                    ->setCellValue('DD' . $indexNoviembre, $datos['Cliente'])
                    ->setCellValue('DE' . $indexNoviembre, $datos['RUT'] . '-' . $datos['DV'])
                    ->setCellValue('DH' . $indexNoviembre, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                    ->setCellValue('DI' . $indexNoviembre, $datos['TotalFactura'])
                    ->setCellValue('DJ' . $indexNoviembre, $datos['TotalSaldo'])
                    ->setCellValue('DK' . $indexNoviembre, $datos['SaldoFavor'])
                    ->setCellValue('DL' . $indexNoviembre, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                // $Total += $data['TotalSaldo'];
                $run->cellColor('DC' . $indexNoviembre . ':DL' . $indexNoviembre, 'A6A6FF');
                if ($datos['TotalSaldo'] > 0) {
                    $run->cellColor('DJ' . $indexNoviembre, 'F28A8C');
                }
                if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                    $run->cellColor('DJ' . $indexNoviembre, 'FFFF00');
                }
                if ($datos['TotalSaldo'] == 0) {
                    $run->cellColor('DJ' . $indexNoviembre, '92D050');
                }
                foreach ($datos['facturas_detalle'] as $detalle) {
                    $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('DF' . $indexNoviembre, $detalle['Codigo'])
                        ->setCellValue('DG' . $indexNoviembre, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                    $run->cellColor('DF' . $indexNoviembre . ':DG' . $indexNoviembre, '7474FF');
                    $indexNoviembre++;
                }
                $indexNoviembre++;
                break;
            }
            case 12: {
                $contadorDiciembre++;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('DN' . $indexDiciembre, $contadorDiciembre)
                    ->setCellValue('DO' . $indexDiciembre, $datos['Cliente'])
                    ->setCellValue('DP' . $indexDiciembre, $datos['RUT'] . '-' . $datos['DV'])
                    ->setCellValue('DS' . $indexDiciembre, $datos['TipoDocumento'] . '-' . $datos['NumeroDocumento'])
                    ->setCellValue('DT' . $indexDiciembre, $datos['TotalFactura'])
                    ->setCellValue('DU' . $indexDiciembre, $datos['TotalSaldo'])
                    ->setCellValue('DV' . $indexDiciembre, $datos['SaldoFavor'])
                    ->setCellValue('DW' . $indexDiciembre, date('d-F-Y', strtotime($datos['FechaFacturacion'])));

                // $Total += $data['TotalSaldo'];
                $run->cellColor('DN' . $indexDiciembre . ':DW' . $indexDiciembre, 'A6A6FF');
                if ($datos['TotalSaldo'] > 0) {
                    $run->cellColor('DU' . $indexDiciembre, 'F28A8C');
                }
                if ($datos['TotalSaldo'] > 0 && $datos['TotalSaldo'] < $datos['TotalFactura']) {
                    $run->cellColor('DU' . $indexDiciembre, 'FFFF00');
                }
                if ($datos['TotalSaldo'] == 0) {
                    $run->cellColor('DU' . $indexDiciembre, '92D050');
                }
                foreach ($datos['facturas_detalle'] as $detalle) {
                    $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d', $detalle['FechaInstalacion'])->format('d-m-Y');
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('DQ' . $indexDiciembre, $detalle['Codigo'])
                        ->setCellValue('DR' . $indexDiciembre, date('d-F-Y', strtotime($detalle['FechaInstalacion'])));
                    $run->cellColor('DQ' . $indexDiciembre . ':DR' . $indexDiciembre, '7474FF');
                    $indexDiciembre++;
                }
                $indexDiciembre++;
                break;
            }
        }
    }
    // $objPHPExcel->setActiveSheetIndex(0)
    // ->setCellValue('H'.$indexEnero, $Total);
} else {
    echo 'No existen datos para esta consulta';
    return;
}

// echo '<pre>'; print_r($ToReturn); echo '</pre>'; exit;
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Informe de clientes y servicios');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=Informe clientes con servicios " . $FechaExcel . ' ' . $Rut . ".xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
