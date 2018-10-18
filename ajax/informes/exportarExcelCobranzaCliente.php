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
	->setCellValue('A1', 'Nº')
	->setCellValue('B1', 'Nombre / Razón Social')
	->setCellValue('C1', 'Documento')
	->setCellValue('D1', 'Nº Doc')
	->setCellValue('E1', 'Fecha Emisión')
	->setCellValue('F1', 'Fecha Vencimiento')
	->setCellValue('G1', 'Monto')
    ->setCellValue('H1', 'Pagado');



foreach (range(0, 7) as $col) {
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}


$ToReturn = array();
$data = array();
$data2 = array();
$data3 = array();
$fecha_actual = date("Y-m-d");

$query = "SELECT
facturas.Id,
facturas.NumeroDocumento,
facturas.FechaFacturacion,
mantenedor_tipo_cliente.nombre AS TipoDocumento,
personaempresa.nombre AS Cliente,
facturas.FechaVencimiento
FROM facturas
INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id
LEFT JOIN personaempresa ON personaempresa.rut = facturas.Rut
WHERE EstatusFacturacion = 1 AND FechaVencimiento < '".$fecha_actual."' ";
$run = new Method;
$FacturasVencidas = $run->select($query);

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

if (count($FacturasVencidas) > 0) {
    
    $index = 2;
    foreach($FacturasVencidas as $factura) {
        $factura_detalle_Total = 0;
        $id_facturas = $factura['Id'];
        $razonSocial = $factura['Cliente'];
        $NumeroDocumento = $factura['NumeroDocumento'];
        $TipoDocumento = $factura['TipoDocumento'];

        
        $FechaFacturacion = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');
        $fechaVencimiento = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');
        
        $query_facturas_detalle = "SELECT
        Id,
        FacturaId,
        Total
        FROM facturas_detalle
        WHERE FacturaId = $id_facturas ";
        $facturas_detalle = $run->select($query_facturas_detalle);
        $total_facturas_detalle = count($facturas_detalle);
        if($total_facturas_detalle > 0) {
            foreach($facturas_detalle as $factura_detalle) {
                $factura_detalle_FacturaId = $factura_detalle['FacturaId'];
                $factura_detalle_Total += $factura_detalle['Total'];
                $monto_deuda += $factura_detalle['Total'];
                
                // query para consultar si pago
                $query_facturas_pagos = "SELECT
                Id,
                FacturaId,
                Monto
                FROM facturas_pagos
                WHERE FacturaId = $factura_detalle_FacturaId ";
                
                $facturas_pagos = $run->select($query_facturas_pagos);
                $total_facturas_pagos = count($facturas_pagos);
                if($total_facturas_pagos > 0) {
                
                    foreach($facturas_pagos as $factura_pago) {
                        $fp_facturaId = $factura_pago['FacturaId'];    
                        $fp_monto = $factura_pago['Monto'];
                        $monto_deuda = $factura_detalle_Total - $fp_monto;
                        if($fp_monto < $factura_detalle_Total) {
                            $factura_detalle_Total;
                            $data['pagos'] = $fp_monto;
                            $bandera = 0;
                        }  else {
                            $bandera = 1;
                        } 
                    } //else significa que no ha pagado nada
                } else {
                    $bandera = 0;
                    $fp_monto = 0;
                    $monto_deuda = $factura_detalle_Total;
                }
            }
        }
        if($bandera != 1) {
        //    echo $TipoDocumento;

		    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$index, $id_facturas)
            ->setCellValue('B'.$index, $razonSocial)
            ->setCellValue('C'.$index, $TipoDocumento)
            ->setCellValue('D'.$index, $NumeroDocumento)
            ->setCellValue('E'.$index, $FechaFacturacion)
            ->setCellValue('F'.$index, $fechaVencimiento)
            ->setCellValue('G'.$index, $factura_detalle_Total)
            // ->setCellValue('G'.$index, $fp_monto)
            ->setCellValue('H'.$index, $fp_monto);
            $index ++; 
        }
       
    }
    // return;
    // $index++;
    // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
    $objPHPExcel->setActiveSheetIndex(0);

}else{
    echo 'No existen datos para esta consulta';
    return;
}


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