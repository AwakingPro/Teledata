<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$run = new Method;
	$UltimoCodigo = $run->select("SELECT Codigo FROM servicios WHERE Rut = '". $_POST['Rut']."'");
	if($UltimoCodigo){
		$UltimoCodigo = $UltimoCodigo[0]['Codigo'];
		$Correlativo = substr($UltimoCodigo, -2);
		$Correlativo = intval($Correlativo);
		if($Correlativo < 9){
			$Correlativo++;
			$Correlativo = "0".$Correlativo; 
		}
	}else{
		$Correlativo = "01";
	}

	$Descuento = $_POST['Descuento'];
	if(!$Descuento){
		$Descuento = 0;
	}

	$Rut = isset($_POST['Rut']) ? trim($_POST['Rut']) : "";
	$Dv = $run->select("SELECT dv FROM personaempresa WHERE rut = '".$_POST['Rut']."'");
	$Dv = $Dv[0][0];
	$Grupo = isset($_POST['Grupo']) ? trim($_POST['Grupo']) : "";
	$TipoFactura = isset($_POST['TipoFactura']) ? trim($_POST['TipoFactura']) : "";
	$Valor = isset($_POST['Valor']) ? trim($_POST['Valor']) : "";
	$TipoServicio = isset($_POST['TipoServicio']) ? trim($_POST['TipoServicio']) : "";
	$TiepoFacturacion = isset($_POST['TiepoFacturacion']) ? trim($_POST['TiepoFacturacion']) : "";
	$Descripcion = isset($_POST['Descripcion']) ? trim($_POST['Descripcion']) : "";
	$tipoMoneda = isset($_POST['tipoMoneda']) ? trim($_POST['tipoMoneda']) : "";
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
	$Codigo = $Rut."-".$Dv.$TipoFactura.$Correlativo;
	$FechaInstalacion = date("Y-m-d");
	$idUsuario = $_SESSION['idUsuario'];
	$BooleanCostoInstalacion = isset($_POST['BooleanCostoInstalacion']) ? trim($_POST['BooleanCostoInstalacion']) : "";
	$CostoInstalacion = isset($_POST['CostoInstalacion']) ? trim($_POST['CostoInstalacion']) : "";
	$CostoInstalacionTipoMoneda = isset($_POST['CostoInstalacionTipoMoneda']) ? trim($_POST['CostoInstalacionTipoMoneda']) : "";
	$CostoInstalacionDescuento = isset($_POST['CostoInstalacionDescuento']) ? trim($_POST['CostoInstalacionDescuento']) : "";

	if(!$BooleanCostoInstalacion){
		$CostoInstalacion = 0;
		$CostoInstalacionDescuento = 0;
	}

	$FechaComprometidaInstalacion = $_POST['FechaComprometidaInstalacion'];
	if($FechaComprometidaInstalacion){
    	$FechaComprometidaInstalacion = DateTime::createFromFormat('d-m-Y', $FechaComprometidaInstalacion)->format('Y-m-d');
    }else{
    	$FechaComprometidaInstalacion = '1969-01-31';
    }

	$query = " INSERT INTO servicios (Rut, Grupo, TipoFactura, Valor, Descuento, IdServicio, TiepoFacturacion, Codigo, Descripcion, TipoMoneda, IdUsuarioSession, Alias, Estatus, FechaInstalacion, InstaladoPor, Comentario, UsuarioPppoe, Direccion, Latitud, Longitud, Referencia, Contacto, Fono, PosibleEstacion, Equipamiento, SenalTeorica, UsuarioPppoeTeorico, IdUsuarioAsignado, SenalFinal, EstacionFinal, EstatusFacturacion, CostoInstalacion, CostoInstalacionTipoMoneda, CostoInstalacionDescuento, FacturarSinInstalacion, FechaComprometidaInstalacion) VALUES ('".$Rut."', '".$Grupo."', '".$TipoFactura."', '".$Valor."', '".$Descuento."', '".$TipoServicio."', '".$TiepoFacturacion."', '".$Codigo."', '".$Descripcion."', '".$tipoMoneda."', '".$idUsuario."', '".$Alias."', '0', '".$FechaInstalacion."', '', '', '', '".$Direccion."', '".$Latitud."', '".$Longitud."', '".$Referencia."', '".$Contacto."', '".$Fono."', '".$PosibleEstacion."', '".$Equipamiento."', '".$SenalTeorica."', '".$UsuarioPppoeTeorico."', '0', '', '', '0', '".$CostoInstalacion."', '".$CostoInstalacionTipoMoneda."', '".$CostoInstalacionDescuento."', '0', '".$FechaComprometidaInstalacion."')";
	$id = $run->insert($query);

	switch ($TipoServicio) {
		case 1:
			include("../../class/inventario/egresos/EgresoClass.php");
			$query = "INSERT INTO arriendo_equipos_datos (IdServivio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES ('".$id."', '".$_POST['velocidad']."', '".$_POST['plan']."', '".$_POST['origen_id']."', '".$_POST['producto_id']."', '".$_POST['destino_tipo']."')";
			$data = $run->insert($query);
			$Egreso = new Egreso();
			$Egreso->storeMovimiento($_POST['producto_id'],$_POST['destino_tipo'],$id);
			break;
		case 2:
			include("../../class/inventario/egresos/EgresoClass.php");
			$query = "INSERT INTO servicio_internet (IdServivio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES ('".$id."', '".$_POST['velocidad']."', '".$_POST['plan']."', '".$_POST['origen_id']."', '".$_POST['producto_id']."', '".$_POST['destino_tipo']."')";
			$data = $run->insert($query);
			$Egreso = new Egreso();
			$Egreso->storeMovimiento($_POST['producto_id'],$_POST['destino_tipo'],$id);
			break;
		case 3:
			$query = "INSERT INTO mensualidad_puerdo_publicos (PuertoTCPUDP, Descripcion,IdServivio) VALUES ('".$_POST['puerto']."', '".$_POST['descripcion']."', '".$id."')";
			$data = $run->insert($query);
			break;
		case 4:
			$query = "INSERT INTO mensualidad_direccion_ip_fija (DireccionIPFija, Descripcion,IdServivio) VALUES ('".$_POST['ip']."', '".$_POST['descripcion']."', '".$id."')";
			$data = $run->insert($query);
			break;
		case 5:
			$query = "INSERT INTO mantencion_red (Descripcion, ComentarioDatosAdicionales,IdServivio) VALUES ('".$_POST['descripcion']."', '".$_POST['comentario']."', '".$id."')";
			$data = $run->insert($query);
			break;
		case 6:
			$query = "INSERT INTO trafico_generado (LineaTelefonica, Descripcion,IdServivio) VALUES ('".$_POST['linea']."', '".$_POST['descripcion']."','".$id."')";
			$data = $run->insert($query);
			break;
	}

	echo json_encode($id);


 ?>



