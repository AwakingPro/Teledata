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
	->setCellValue('B1', 'Nombre de cliente')
	->setCellValue('C1', 'Documento')
	->setCellValue('D1', 'Nº doc')
    ->setCellValue('E1', 'Fecha doc')
    ->setCellValue('F1', 'Fecha de pago')
	->setCellValue('G1', 'Total doc')
	->setCellValue('H1', 'Saldo doc')
    ->setCellValue('I1', 'Saldo a favor')
    ->setCellValue('J1', 'Glosa');

// filtros
$objPHPExcel->getActiveSheet()->setAutoFilter("A1:J1");

foreach (range(0, 9) as $col) {
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

            
            $ToReturn = array();
            $query = "  SELECT
            (SELECT ROUND(SUM( Total )) FROM facturas_detalle WHERE FacturaId = facturas.Id ) AS totalDoc,
            facturas.NumeroDocumento,
            facturas.FechaFacturacion,
            facturas_pagos.Detalle as Detalle,
            personaempresa.nombre AS Cliente,
            facturas_pagos.FechaPago AS FechaPago,
            ROUND(facturas_pagos.Monto) AS Pagado,
            mt.nombre AS tipo_Factura

            FROM
                facturas
                LEFT JOIN facturas_pagos ON facturas_pagos.FacturaId = facturas.Id
                LEFT JOIN personaempresa ON personaempresa.rut = facturas.Rut
                INNER JOIN mantenedor_tipo_cliente mt ON facturas.TipoDocumento = mt.id
            WHERE
                facturas.EstatusFacturacion = '1' ";

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

            $run = new Method;
            $documentos = $run->select($query);
            $saldo_doc = 0;
            $saldo_favor = 0;
            // echo '<pre>'; print_r($documentos); echo '</pre>'; return;
            if (count($documentos) > 0) {
                $index = 2;
                foreach($documentos as $documento){
                    $FechaFacturacion = \DateTime::createFromFormat('Y-m-d',$documento['FechaFacturacion'])->format('d-m-Y');
                    if($documento['FechaPago']){
                        $FechaPago = \DateTime::createFromFormat('Y-m-d',$documento['FechaPago'])->format('d-m-Y');
                    }else{
                        $FechaPago = $documento['FechaPago'];
                    }
                    $saldo_doc = $documento['totalDoc'] - $documento['Pagado'];
                    $saldo_favor = $documento['Pagado'] - $documento['totalDoc'];
                    if($saldo_doc < 0){
                        $saldo_doc = 0;
                    }
                    if($saldo_favor < 0){
                        $saldo_favor = 0;
                    }
                    //si es mayor es porque pago
                    if($documento['totalDoc'] > $saldo_doc) {
                        $data['Cliente'] = $documento['Cliente'];
                        $data['NumeroDocumento'] = $documento['NumeroDocumento'];
                        $data['TipoDocumento'] = $documento['tipo_Factura'];
                        $data['FechaFacturacion'] = $FechaFacturacion;
                        $data['FechaPago'] = $FechaPago;
                        $data['totalDoc'] = $documento['totalDoc'];
                        $data['saldo_doc'] = $saldo_doc;
                        $data['SaldoFavor'] = $saldo_favor;
                        $data['pagos'] = $documento['Pagado'];
                        $data['Detalle'] = $documento['Detalle'];
                        array_push($ToReturn, $data ); 
                    }
                }
                $numero = 1;
                $totalDoc = 0;
                $totalSaldoDoc = 0;
                $totalSaldoFavor = 0;
                foreach($ToReturn as $datos) {
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$index, $numero)
                    ->setCellValue('B'.$index, $datos['Cliente'])
                    ->setCellValue('C'.$index, $datos['TipoDocumento'])
                    ->setCellValue('D'.$index, $datos['NumeroDocumento'])
                    ->setCellValue('E'.$index, $datos['FechaFacturacion'])
                    ->setCellValue('F'.$index, $datos['FechaPago'])
                    ->setCellValue('G'.$index, $datos['totalDoc'])
                    ->setCellValue('H'.$index, $datos['saldo_doc'])
                    ->setCellValue('I'.$index, $datos['SaldoFavor'])
                    ->setCellValue('J'.$index, $datos['Detalle']);
                    $totalDoc += $datos['totalDoc'];
                    $totalSaldoDoc += $datos['saldo_doc'];
                    $totalSaldoFavor += $datos['SaldoFavor'];
                    $numero++;
                    $index++;
                }
                $index+=2;
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('G'.$index, 'Total doc')
                ->setCellValue('H'.$index, 'Total saldo doc')
                ->setCellValue('I'.$index, 'Total saldo favor doc');
                
                $index+=1;
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('G'.$index, $totalDoc)
                ->setCellValue('H'.$index, $totalSaldoDoc)
                ->setCellValue('I'.$index, $totalSaldoFavor);
                
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