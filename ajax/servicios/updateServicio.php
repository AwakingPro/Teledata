<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
    $run = new Method;
    $Id = isset($_POST['Id']) ? trim($_POST['Id']) : "";
	$TipoFactura = isset($_POST['TipoFactura']) ? trim($_POST['TipoFactura']) : "";
	$Grupo = isset($_POST['Grupo']) ? trim($_POST['Grupo']) : "";
	$Valor = isset($_POST['Valor']) ? trim($_POST['Valor']) : "0";
	$Descuento = isset($_POST['Descuento']) ? trim($_POST['Descuento']) : "0";
	$Descripcion = isset($_POST['Descripcion']) ? trim($_POST['Descripcion']) : "";
	$Alias = isset($_POST['Alias']) ? trim($_POST['Alias']) : "";
	$Direccion = isset($_POST['Direccion']) ? trim($_POST['Direccion']) : "";
	$Latitud = isset($_POST['Latitud']) ? trim($_POST['Latitud']) : "";
	$Longitud = isset($_POST['Longitud']) ? trim($_POST['Longitud']) : "";
	$Referencia = isset($_POST['Referencia']) ? trim($_POST['Referencia']) : "";
	$Contacto = isset($_POST['Contacto']) ? trim($_POST['Contacto']) : "";
	$Fono = isset($_POST['Fono']) ? trim($_POST['Fono']) : "";
	$PosibleEstacion = isset($_POST['PosibleEstacion']) ? trim($_POST['PosibleEstacion']) : "";
	$Equipamiento = isset($_POST['Equipamiento']) ? trim($_POST['Equipamiento']) : "";
	$UsuarioPppoeTeorico = isset($_POST['UsuarioPppoeTeorico']) ? trim($_POST['UsuarioPppoeTeorico']) : "";
	$SenalTeorica = isset($_POST['SenalTeorica']) ? trim($_POST['SenalTeorica']) : "";
	$BooleanCostoInstalacion = isset($_POST['BooleanCostoInstalacion']) ? trim($_POST['BooleanCostoInstalacion']) : "";
	$CostoInstalacion = isset($_POST['CostoInstalacion']) ? trim($_POST['CostoInstalacion']) : "";
	$CostoInstalacionDescuento = isset($_POST['CostoInstalacionDescuento']) ? trim($_POST['CostoInstalacionDescuento']) : "";
	$FechaComprometidaInstalacion = isset($_POST['FechaComprometidaInstalacion']) ? trim($_POST['FechaComprometidaInstalacion']) : "";
	$Servicio  = $run->select("SELECT Rut, Codigo FROM servicios WHERE Id = '". $Id."'");
	if($Servicio){
		$Rut = $Servicio[0]['Rut'];
		$UltimoCodigo = $run->select("SELECT Codigo FROM servicios WHERE Rut = '". $Rut."'");
		if($UltimoCodigo){
			$UltimoCodigo = $UltimoCodigo[0]['Codigo'];
			$Correlativo = substr($UltimoCodigo, -2);
			$Correlativo = intval($Correlativo) - 1;
			if($Correlativo < 9){
				$Correlativo++;
				$Correlativo = "0".$Correlativo; 
			}
		}else{
			$Correlativo = "01";
		}
		$Dv = $run->select("SELECT dv FROM personaempresa WHERE rut = '".$Rut."'");
		$Dv = $Dv[0][0];	
		$Codigo = $Rut."-".$Dv.$TipoFactura.$Correlativo;
	}else{
		$Codigo = '';
	}

	if(!$BooleanCostoInstalacion){
		$CostoInstalacion = 0;
		$CostoInstalacionDescuento = 0;
	}else{
		if(!$CostoInstalacion){
			$CostoInstalacion = 0;
		}

		if(!$CostoInstalacionDescuento){
			$CostoInstalacionDescuento = 0;
		}
	}

	if($FechaComprometidaInstalacion){
    	$FechaComprometidaInstalacion = DateTime::createFromFormat('d-m-Y', $FechaComprometidaInstalacion)->format('Y-m-d');
    }else{
    	$FechaComprometidaInstalacion = '1969-01-31';
    }

	$query = " UPDATE servicios SET Codigo = '".$Codigo."', Grupo = '".$Grupo."', TipoFactura = '".$TipoFactura."', Valor = '".$Valor."', Descuento = '".$Descuento."', Descripcion = '".$Descripcion."', Alias = '".$Alias."', Direccion = '".$Direccion."', Latitud = '".$Latitud."', Longitud = '".$Longitud."', Referencia = '".$Referencia."', Contacto = '".$Contacto."', Fono = '".$Fono."', PosibleEstacion = '".$PosibleEstacion."', Equipamiento = '".$Equipamiento."', SenalTeorica = '".$SenalTeorica."', UsuarioPppoeTeorico = '".$UsuarioPppoeTeorico."', FechaComprometidaInstalacion = '".$FechaComprometidaInstalacion."', CostoInstalacion = '".$CostoInstalacion."', CostoInstalacionDescuento = '".$CostoInstalacionDescuento."' WHERE Id = '".$Id."'";
	$update = $run->update($query);

	echo json_encode($update);


 ?>



