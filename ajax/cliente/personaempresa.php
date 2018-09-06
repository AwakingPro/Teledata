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
	$query_factura = "SELECT
	FechaFacturacion,
	FechaVencimiento
	FROM facturas
	WHERE Rut = $Rut AND EstatusFacturacion = 1 ";
	$FacturasVencidas = $run->select($query_factura);
	$total_facturas=  count($FacturasVencidas);
	$documentos_vencidos = '';
	if($total_facturas > 0) {
		$documentos_vencidos = $total_facturas;
	} else {
		$documentos_vencidos = 0;
	}
	
 ?>