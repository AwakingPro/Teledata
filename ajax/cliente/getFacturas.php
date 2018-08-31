<?php
    require_once('../../class/methods_global/methods.php');
    $Rut = $_POST['Rut'];

    $run = new Method;
    $ToReturn = array();

    $query = "  SELECT
                    facturas.Id,
                    facturas.NumeroDocumento,
                    facturas.FechaFacturacion,
                    facturas.FechaVencimiento,
                    facturas.UrlPdfBsale,
                    mantenedor_tipo_cliente.nombre AS TipoDocumento,
                    facturas.IVA,
                    facturas.EstatusFacturacion,
                    IFNULL( ( SELECT SUM( Monto ) FROM facturas_pagos WHERE FacturaId = facturas.Id ), 0 ) AS TotalSaldo 
                FROM
                    facturas
                    INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id 
                WHERE
                    facturas.Rut = '".$Rut."' 
                    AND facturas.EstatusFacturacion != '0' 
                GROUP BY
                    facturas.Id";
    $facturas = $run->select($query);

    if($facturas){
        foreach($facturas as $factura){
            $Id = $factura['Id'];
            $IVA = $factura['IVA'];       
            $EstatusFacturacion = $factura['EstatusFacturacion'];
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

            if($EstatusFacturacion != 2){
                $TotalSaldo = $factura['TotalSaldo'];
                $TotalSaldo = $TotalFactura - $TotalSaldo;
                if($TotalSaldo < 0){
                    $TotalSaldo = 0;
                }
                $Acciones = 1;
            }else{
                $TotalSaldo = 0;
                $Acciones = 0;
            }
            $Id = $factura['Id'];
            $data = array();
            $data['Id'] = $factura['Id'];
            $data['NumeroDocumento'] = $factura['NumeroDocumento'];
            $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');        
            $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');        
            $data['TotalFactura'] = $TotalFactura;
            $data['TotalSaldo'] = $TotalSaldo;
            $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
            $data['TipoDocumento'] = $factura['TipoDocumento'];
            $data['Acciones'] = $Acciones;
            $data['EstatusFacturacion'] = 1;
            array_push($ToReturn,$data);
            if($EstatusFacturacion == 2){
                $query = "SELECT Id, FechaDevolucion, NumeroDocumento, UrlPdfBsale FROM devoluciones WHERE FacturaId = '".$Id."'";
                $devoluciones = $run->select($query);
                if($devoluciones){
                    $devolucion = $devoluciones[0];
                    $TotalSaldo = $factura['TotalSaldo'];
                    $TotalSaldo = $TotalFactura - $TotalSaldo;
                    if($TotalSaldo < 0){
                        $TotalSaldo = 0;
                    }
                    $data = array();
                    $data['Id'] = $Id;
                    $data['NumeroDocumento'] = $devolucion['NumeroDocumento'];
                    $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$devolucion['FechaDevolucion'])->format('d-m-Y');        
                    $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$devolucion['FechaDevolucion'])->format('d-m-Y');        
                    $data['TotalFactura'] = $TotalFactura;
                    $data['TotalSaldo'] = $TotalSaldo;
                    $data['UrlPdfBsale'] = $devolucion['UrlPdfBsale'];
                    $data['TipoDocumento'] = 'Nota de crédito';
                    $data['EstatusFacturacion'] = 2;
                    array_push($ToReturn,$data);
                }
            }
        }
    }

    echo json_encode($ToReturn);

?>