<?php
	require_once('../../class/methods_global/methods.php');

	$TipoFacCodigo = $_POST['TipoFacCodigo'];
	$TipoFacDescripcion = $_POST['TipoFacDescripcion'];
	$ClaseCliente = isset($_POST['ClaseCliente']) ? strtoupper(trim($_POST['ClaseCliente'])) : "";

	$TipoFacCodigo = isset($TipoFacCodigo) ? trim($TipoFacCodigo) : "";
	$TipoFacDescripcion = isset($TipoFacDescripcion) ? trim($TipoFacDescripcion) : "";

	if($TipoFacCodigo != ''){
		if($TipoFacDescripcion != ''){
			if($ClaseCliente != ''){
				$run = new Method;
				$query = "INSERT INTO mantenedor_tipo_factura (codigo, descripcion, tipo_facturacion, tipo_documento) VALUES ('".$_POST['TipoFacCodigo']."', '".$_POST['TipoFacDescripcion']."', '".$_POST['TipoFacturacion']."', '".$_POST['ClaseCliente']."')";
				$data = $run->insert($query);
				echo $data;
			}else{
				return -2;
			}
		}else{
			echo -1;
			return;
		}
	}else{
		echo 0;
		return;
	}
	
 ?>