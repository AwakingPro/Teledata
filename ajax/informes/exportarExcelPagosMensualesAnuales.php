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
	->setCellValue('A1', 'Nº')
	->setCellValue('B1', 'Nombre De Cliente')
	->setCellValue('C1', 'Documento')
	->setCellValue('D1', 'Nº Doc')
	->setCellValue('E1', 'Fecha Doc')
	->setCellValue('F1', 'Total Doc')
	->setCellValue('G1', 'Saldo Doc')
    ->setCellValue('H1', 'Saldo a favor')
    ->setCellValue('I1', 'Fecha de Pago')
    ->setCellValue('J1', 'Glosa')
    ->setCellValue('K1', 'Nº Relación');

// filtros
$objPHPExcel->getActiveSheet()->setAutoFilter("A1:K1");

foreach (range(0, 10) as $col) {
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
                facturas.Id,
                facturas.NumeroDocumento,
                facturas.FechaFacturacion,
                facturas.FechaVencimiento,
                facturas.UrlPdfBsale,
                mantenedor_tipo_cliente.nombre AS TipoDocumento,
                facturas.IVA,
                facturas.EstatusFacturacion,
                IFNULL( ( SELECT SUM( Monto ) FROM facturas_pagos WHERE FacturaId = facturas.Id ), 0 ) AS TotalSaldo,
                -- facturas_pagos.Detalle as Detalle 
                mantenedor_tipo_pago.nombre as Detalle 
                -- ( SELECT Detalle FROM facturas_pagos WHERE FacturaId = facturas.Id ) AS Detalle 
            FROM
                facturas
                INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id
                INNER JOIN personaempresa ON facturas.Rut = personaempresa.rut 
                LEFT JOIN facturas_pagos ON facturas_pagos.FacturaId = facturas.Id
                LEFT JOIN mantenedor_tipo_pago ON mantenedor_tipo_pago.id = facturas_pagos.TipoPago
            WHERE
                facturas.EstatusFacturacion != '0' ";
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
                    $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
                    $data['TipoDocumento'] = $factura['TipoDocumento'];
                    if($factura['Detalle'] == '' || $factura['Detalle'] == null)
                    $factura['Detalle'] = 'Sin Detalle';

                    $data['Detalle'] = $factura['Detalle'];
                    $data['Acciones'] = $Acciones;
                    $data['EstatusFacturacion'] = 1;
                    $data['NumRelacion'] = $NumRelacion;
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
                                    $data['EstatusFacturacion'] = 3;
                                    $data['NumRelacion'] = $FNumeroDocumento;
                                    array_push($ToReturn,$data);
                                }
                            }
                        }
                    }
                }
                
                foreach($ToReturn as $datos) {
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$index, $datos['Id'])
                    ->setCellValue('B'.$index, $datos['Cliente'])
                    ->setCellValue('C'.$index, $datos['TipoDocumento'])
                    ->setCellValue('D'.$index, $datos['NumeroDocumento'])
                    ->setCellValue('E'.$index, $datos['FechaFacturacion'])
                    ->setCellValue('F'.$index, $datos['TotalFactura'])
                    ->setCellValue('G'.$index, $datos['TotalSaldo'])
                    ->setCellValue('H'.$index, $datos['SaldoFavor'])
                    ->setCellValue('I'.$index, $datos['FechaVencimiento'])
                    ->setCellValue('J'.$index, $datos['Detalle'])
                    ->setCellValue('K'.$index, $datos['NumRelacion']);
                    // $Total += $data['TotalSaldo'];
            
                    $index++;
                }
                // $objPHPExcel->setActiveSheetIndex(0)
                // ->setCellValue('H'.$index, $Total);
            }else{
                echo 'No existen datos para esta consulta';
                return;
            }
            

            // Renombrar Hoja
            $objPHPExcel->getActiveSheet()->setTitle('Informe de Pagos');

            // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment; filename=Informe de Pagos Mensuales y Anuales ".$FechaExcel.' '.$Rut.".xlsx");
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
            ?>