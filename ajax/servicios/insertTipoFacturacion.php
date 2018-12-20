<?php
	require_once('../../class/methods_global/methods.php');

	$TipoFacCodigo = $_POST['TipoFacCodigo'];
	$TipoFacDescripcion = $_POST['TipoFacDescripcion'];
	$ClaseCliente = isset($_POST['TipoCliente']) ? trim($_POST['TipoCliente']) : "";

	$TipoFacCodigo = isset($TipoFacCodigo) ? trim($TipoFacCodigo) : "";
	$TipoFacDescripcion = isset($TipoFacDescripcion) ? trim($TipoFacDescripcion) : "";

	if($TipoFacCodigo != ''){
		if($TipoFacDescripcion != ''){
			if($ClaseCliente != ''){
				$run = new Method;
				$query = "INSERT INTO mantenedor_tipo_factura (codigo, descripcion, tipo_facturacion, tipo_documento) VALUES ('".$_POST['TipoFacCodigo']."', '".$_POST['TipoFacDescripcion']."', '".$_POST['TipoFacturacion']."', '".$_POST['TipoCliente']."')";
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