<?php

	$query_cliente = "SELECT
	id,
	rut,
    nombre,
    correo,
    telefono
	FROM
	personaempresa
	WHERE
		id = $id_cliente ";
    $run = new Method;
    $tipo = '';
	$lista = $run->select($query_cliente);

	$Rut = $lista[0][1];

	$dia = date("d");
	$mes = date("m");
	$ano = date("Y");

	$fecha_actual = $ano.'-'.$mes.'-'.$dia;

	$query_factura = "SELECT
	Id,
	FechaVencimiento
	FROM facturas
	WHERE Rut = $Rut AND EstatusFacturacion = 1 AND FechaVencimiento < '".$fecha_actual."' ";

	
	// echo $Rut;
	$FacturasVencidas = $run->select($query_factura);
	$total_facturas =  count($FacturasVencidas);
	// echo $total_facturas;
	$fechaVencimiento = '';
	$id_facturas = '';
	$factura_detalle_FacturaId = '';
	$factura_detalle_Total = '';
	$contador_vencidos = 0;
	$monto_deuda = 0;

	if($total_facturas > 0) {
		foreach($FacturasVencidas as $factura) {
			$id_facturas = $factura['Id'];
			$fechaVencimiento = $factura['FechaVencimiento'];
			
			if($fechaVencimiento < $fecha_actual) {
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
						$factura_detalle_Total = $factura_detalle['Total'];
						// echo $factura_detalle_Total.'/';
						$query_facturas_pagos = "SELECT
						Id,
						FacturaId,
						Monto
						FROM facturas_pagos
						WHERE FacturaId = $factura_detalle_FacturaId";
						$facturas_pagos = $run->select($query_facturas_pagos);
						$total_facturas_pagos = count($facturas_pagos);
						
						if($total_facturas_pagos > 0) {
							foreach($facturas_pagos as $factura_pago) {
								$fp_facturaId = $factura_pago['FacturaId'];
								$fp_monto = $factura_pago['Monto'];
								if($fp_monto >= $factura_detalle_Total)
								{
									
									$contador_vencidos-=1;
									$monto_deuda -= $fp_monto;
								}
								else {
									$monto_deuda -= $fp_monto;
									
								}
							}
						}
					}
				}
				
			}
			// echo ' Fecha Vencimiento '.$fechaVencimiento. ' Fecha Actual '.$fecha_actual;
			$contador_vencidos+=1;
			$monto_deuda+=$factura_detalle_Total;
		}
		
		
	}
	
	
	// echo $FacturasVencidas[0][0];
	$documentos_vencidos = '';
	if($contador_vencidos > 0) {
		$documentos_vencidos = $contador_vencidos;
	} else {
		$documentos_vencidos = 0;
	}
	
 ?>