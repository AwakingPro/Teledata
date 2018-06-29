<?php
    require_once('../../class/methods_global/methods.php');
    $Rut = $_POST['Rut'];

    $run = new Method;
    $ToReturn = array();

    $query = "  SELECT
                    facturas.Id,
                    facturas.FechaFacturacion,
                    facturas.FechaVencimiento,
                    facturas.UrlPdfBsale,
                    mantenedor_tipo_cliente.nombre AS TipoDocumento,
                    facturas.IVA,
                    IFNULL( ( SELECT SUM( Monto ) FROM facturas_pagos WHERE FacturaId = facturas.Id ), 0 ) AS TotalAbono 
                FROM
                    facturas
                    INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id 
                WHERE
                    facturas.Rut = '".$Rut."' 
                    AND facturas.EstatusFacturacion = '1' 
                GROUP BY
                    facturas.Id";
    $facturas = $run->select($query);

    if($facturas){
        foreach($facturas as $factura){
            $Id = $factura['Id'];
            $IVA = $factura['IVA'];       
            $TotalAbono = $factura['TotalAbono'];
            $TotalFactura = 0;
            $query = "SELECT Valor, (Descuento + IFNULL((SELECT SUM(Porcentaje) FROM descuentos_aplicados WHERE IdDetalle = facturas_detalle.Id),0)) as Descuento FROM facturas_detalle WHERE FacturaId = '".$Id."'";
            $detalles = $run->select($query);
            foreach($detalles as $detalle){
                $Valor = $detalle['Valor'];
                $Descuento = floatval($detalle['Descuento']) / 100;
                $Descuento = $Valor * $Descuento;
                $Valor -= $Descuento;
                $IvaSumatoria = $Valor * $IVA;
                $Valor += $IvaSumatoria;
                $TotalFactura += $Valor;
            }

            $TotalAbono = $TotalFactura - $TotalAbono;
            if($TotalAbono < 0){
                $TotalAbono = 0;
            }

            $data = array();
            $data['Id'] = $factura['Id'];
            $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');        
            $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');        
            $data['TotalFactura'] = number_format($TotalFactura, 2);
            $data['TotalAbono'] = number_format($TotalAbono, 2);
            $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
            $data['TipoDocumento'] = $factura['TipoDocumento'];
            array_push($ToReturn,$data);
        }
    }

    echo json_encode($ToReturn);

?>