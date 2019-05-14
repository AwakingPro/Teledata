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
	->setCellValue('A1', 'Nº')
	->setCellValue('B1', 'Razón social')
	->setCellValue('C1', 'Rut')
	->setCellValue('D1', 'DV')
	->setCellValue('E1', 'Documento')
	->setCellValue('F1', 'Nº doc')
	->setCellValue('G1', 'Total doc')
	->setCellValue('H1', 'Deuda')
    ->setCellValue('I1', 'Saldo a favor')
    ->setCellValue('J1', 'Vencimiento del doc')
    ->setCellValue('K1', 'Código servicio')
    ->setCellValue('L1', 'Fecha instalación');

// filtros
$objPHPExcel->getActiveSheet()->setAutoFilter("K1:L1");

foreach (range(0, 11) as $col) {
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
                facturas.FechaVencimiento,
                facturas.UrlPdfBsale,
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
                $index = 2;
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
                        if($EstatusFacturacion != 2){
                            $Acciones = 1;
                        }else{
                            $TotalSaldo = 0;
                            $Acciones = 0;
                        }
                        $Id = $factura['Id'];
                        $data['facturas_detalle'] = $detalles;
                        $data['Id'] = $Id;
                        $data['DocumentoId'] = $Id;
                        $data['Cliente'] = $factura['Cliente'];
                        $data['RUT'] = $factura['Rut'];
                        $data['DV'] =  $factura['DV'];
                        if($factura['NumeroDocumento'] == ''){
                            $factura['NumeroDocumento'] = 'No generado';
                        }else{
                            $factura['NumeroDocumento'] = $FNumeroDocumento;
                        }
                        $data['NumeroDocumento'] = $factura['NumeroDocumento'];
                        $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');        
                        $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');        
                        $data['TotalFactura'] = $TotalFactura;
                        //total saldo es el pago total
                        $data['TotalSaldo'] = $TotalSaldo;
                        $data['SaldoFavor'] = $SaldoFavor;
                        $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
                        $data['TipoDocumento'] = $factura['TipoDocumento'];
                        if($factura['Detalle'] == '' || $factura['Detalle'] == null)
                        $factura['Detalle'] = 'Sin Detalle';

                        $data['Detalle'] = $factura['Detalle'];
                        $data['Acciones'] = $Acciones;
                        $data['EstatusFacturacion'] = 1;
                        $data['NumRelacion'] = $NumRelacion;
                        array_push($ToReturn,$data);
                        // echo '<pre>'; print_r($data); echo '</pre>'; exit;
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
                                $data['facturas_detalle'] = $detalles;
                                $data['Id'] = $devolucion['Id'];
                                $data['DocumentoId'] = $Id;
                                $data['Cliente'] = $factura['Cliente'];
                                $data['RUT'] = $factura['Rut'];
                                $data['DV'] =  $factura['DV'];
                                $data['NumeroDocumento'] = $FNumeroDocumento;
                                $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$devolucion['FechaDevolucion'])->format('d-m-Y');        
                                $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$devolucion['FechaDevolucion'])->format('d-m-Y');        
                                $data['TotalFactura'] = $TotalFactura;
                                $data['TotalSaldo'] = $TotalSaldoFactura;
                                $data['SaldoFavor'] = $SaldoFavor;
                                $data['UrlPdfBsale'] = $devolucion['UrlPdfBsale'];
                                $data['TipoDocumento'] = 'Nota de crédito Nº '.$devolucion['NumeroDocumento'];
                                if($devolucion['priceAdjustment'] == 1){
                                    $data['TipoDocumento'] = 'Nota de crédito por ajuste de precio Nº '.$devolucion['NumeroDocumento'];
                                }
                                if($devolucion['editTexts'] == 1){
                                    $data['TipoDocumento'] = 'Nota de crédito por corrección de texto Nº '.$devolucion['NumeroDocumento'];
                                }
                                $data['Detalle'] = $factura['Detalle'];
                                $data['Acciones'] = $Acciones;
                                $data['EstatusFacturacion'] = 2;
                                $data['NumRelacion'] = $FNumeroDocumento;
                                array_push($ToReturn,$data);
                                if($DevolucionAnulada == 1){
                                    $DevolucionId = $devolucion['Id'];
                                    $query = "SELECT Id, FechaAnulacion, NumeroDocumento, UrlPdfBsale FROM anulaciones WHERE DevolucionId = '".$DevolucionId."'";
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
                                        $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$anulacion['FechaAnulacion'])->format('d-m-Y');        
                                        $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$anulacion['FechaAnulacion'])->format('d-m-Y');        
                                        $data['TotalFactura'] = $TotalFactura;
                                        $data['TotalSaldo'] = $TotalSaldoFactura;
                                        $data['SaldoFavor'] = $SaldoFavor;
                                        $data['UrlPdfBsale'] = $anulacion['UrlPdfBsale'];
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
                // echo '<pre>'; print_r($ToReturn); echo '</pre>';
                // exit;
                foreach($ToReturn as $datos) {
                    $contador++;
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$index, $contador)
                    ->setCellValue('B'.$index, $datos['Cliente'])
                    ->setCellValue('C'.$index, $datos['RUT'])
                    ->setCellValue('D'.$index, $datos['DV'])
                    ->setCellValue('E'.$index, $datos['TipoDocumento'])
                    ->setCellValue('F'.$index, $datos['NumeroDocumento'])
                    ->setCellValue('G'.$index, $datos['TotalFactura'])
                    ->setCellValue('H'.$index, $datos['TotalSaldo'])
                    ->setCellValue('I'.$index, $datos['SaldoFavor'])
                    ->setCellValue('J'.$index, $datos['FechaVencimiento']);
                    // $Total += $data['TotalSaldo'];
                    $run->cellColor('A'.$index.':J'.$index, 'A6A6FF');
                    if($datos['TotalSaldo'] > 0){
                        $run->cellColor('H'.$index, 'F28A8C');
                    }else{
                        $run->cellColor('H'.$index, '92D050');
                    }
                    foreach($datos['facturas_detalle'] as $detalle) {
                        $detalle['FechaInstalacion'] = \DateTime::createFromFormat('Y-m-d',$detalle['FechaInstalacion'])->format('d-m-Y');   ;
                        $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K'.$index, $detalle['Codigo'])
                        ->setCellValue('L'.$index, $detalle['FechaInstalacion']);
                        $run->cellColor('K'.$index.':L'.$index, '7474FF');
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