<?php
    require_once('../../class/methods_global/methods.php');
    $Rut = $_POST['Rut'];

    $run = new Method;
    $ToReturn = array();

    $query = "  SELECT facturas.Id, facturas.FechaFacturacion, facturas.FechaVencimiento, facturas.UrlPdfBsale, mantenedor_tipo_cliente.nombre as TipoDocumento,
                ((SELECT SUM(Valor) FROM facturas_detalle WHERE FacturaId = facturas.Id) * facturas.IVA + (SELECT SUM(Valor) FROM facturas_detalle WHERE FacturaId = facturas.Id)) as TotalFactura,
                (((SELECT SUM(Valor) FROM facturas_detalle WHERE FacturaId = facturas.Id) * facturas.IVA + (SELECT SUM(Valor) FROM facturas_detalle WHERE FacturaId = facturas.Id)) - IFNULL((SELECT SUM(Monto) FROM facturas_pagos WHERE FacturaId = facturas.Id),0)) as TotalAbono
                FROM facturas
                INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id 
                WHERE facturas.Rut = '".$Rut."'
                AND facturas.EstatusFacturacion = '1'
                GROUP BY
                    facturas.Id";

    $facturas = $run->select($query);

    if($facturas){

        foreach($facturas as $factura){

            $data = array();
            $data['Id'] = $factura['Id'];
            $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');        
            $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');        
            $data['TotalFactura'] = number_format($factura['TotalFactura'], 2);
            $data['TotalAbono'] = number_format($factura['TotalAbono'], 2);
            $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
            $data['TipoDocumento'] = $factura['TipoDocumento'];
            array_push($ToReturn,$data);
        }
    }

    echo json_encode($ToReturn);

?>