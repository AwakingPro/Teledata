<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$run = new Method;
	$Rut = isset($_POST['Rut']) ? trim($_POST['Rut']) : "";
	$UltimoCodigo = $run->select("SELECT Codigo FROM servicios WHERE Rut = '".$Rut."' ORDER BY Id DESC");
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
	$Dv = $run->select("SELECT dv FROM personaempresa WHERE rut = '".$Rut."'");
	$Dv = $Dv[0][0];	
	$TipoFactura = isset($_POST['TipoFactura']) ? trim($_POST['TipoFactura']) : "";
	$CodigoFactura = $run->select("SELECT codigo FROM mantenedor_tipo_factura WHERE id = '".$TipoFactura."'");
	$CodigoFactura = $CodigoFactura[0][0];
	$Codigo = $Rut."-".$Dv.$CodigoFactura.$Correlativo;
	$Grupo = isset($_POST['Grupo']) ? trim($_POST['Grupo']) : "";
	$Valor = isset($_POST['Valor']) ? trim($_POST['Valor']) : "0";
	$Descuento = isset($_POST['Descuento']) ? trim($_POST['Descuento']) : "0";
	$TipoServicio = isset($_POST['TipoServicio']) ? trim($_POST['TipoServicio']) : "";
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
	$FechaInstalacion = date("Y-m-d");
	$idUsuario = $_SESSION['idUsuario'];
	$BooleanCostoInstalacion = isset($_POST['BooleanCostoInstalacion']) ? trim($_POST['BooleanCostoInstalacion']) : "";
	$CostoInstalacion = isset($_POST['CostoInstalacion']) ? trim($_POST['CostoInstalacion']) : "";
	$CostoInstalacionDescuento = isset($_POST['CostoInstalacionDescuento']) ? trim($_POST['CostoInstalacionDescuento']) : "0";
	$FechaComprometidaInstalacion = isset($_POST['FechaComprometidaInstalacion']) ? trim($_POST['FechaComprometidaInstalacion']) : "";

	if(!$Descuento){
		$Descuento = 0;
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

	$query = " INSERT INTO servicios (Rut, Grupo, TipoFactura, Valor, Descuento, IdServicio, Codigo, Descripcion, IdUsuarioSession, Alias, Estatus, FechaInstalacion, InstaladoPor, Comentario, UsuarioPppoe, Direccion, Latitud, Longitud, Referencia, Contacto, Fono, PosibleEstacion, Equipamiento, SenalTeorica, UsuarioPppoeTeorico, IdUsuarioAsignado, SenalFinal, EstacionFinal, EstatusFacturacion, CostoInstalacion, CostoInstalacionDescuento, FacturarSinInstalacion, FechaComprometidaInstalacion, FechaFacturacion, FechaUltimoCobro) VALUES ('".$Rut."', '".$Grupo."', '".$TipoFactura."', '".$Valor."', '".$Descuento."', '".$TipoServicio."', '".$Codigo."', '".$Descripcion."', '".$idUsuario."', '".$Alias."', '0', '".$FechaInstalacion."', '', '', '', '".$Direccion."', '".$Latitud."', '".$Longitud."', '".$Referencia."', '".$Contacto."', '".$Fono."', '".$PosibleEstacion."', '".$Equipamiento."', '".$SenalTeorica."', '".$UsuarioPppoeTeorico."', '0', '', '', '0', '".$CostoInstalacion."', '".$CostoInstalacionDescuento."', '0', '".$FechaComprometidaInstalacion."',NOW(),NOW())";
	$id = $run->insert($query);
	if($id){
		switch ($TipoServicio) {
			case 1:
				$Velocidad = $_POST['velocidad'];
				$Plan = $_POST['plan'];
				if(isset($_POST['producto_id'])){
					$IdProducto = $_POST['producto_id'] ? trim($_POST['producto_id']) : "0";
					$TipoDestino = $_POST['destino_tipo'] ? trim($_POST['destino_tipo']) : "0";
					$IdOrigen = $_POST['origen_id'] ? trim($_POST['origen_id']) : "0";
				}else{
					$IdProducto = '0';
					$TipoDestino = '0';
					$IdOrigen = '0';
				}
				$query = "INSERT INTO arriendo_equipos_datos (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES ('".$id."', '".$Velocidad."', '".$Plan."', '".$IdOrigen."', '".$IdProducto."', '".$TipoDestino."')";
				$data = $run->insert($query);
				if($data && $IdProducto){		
					include("../../class/inventario/egresos/EgresoClass.php");
					$Egreso = new Egreso();
					$Egreso->storeMovimiento($_POST['producto_id'],$_POST['destino_tipo'],$id);
				}
				break;
			case 2:
				$Velocidad = $_POST['velocidad'];
				$Plan = $_POST['plan'];
				if(isset($_POST['producto_id'])){
					$IdProducto = $_POST['producto_id'] ? trim($_POST['producto_id']) : "0";
					$TipoDestino = $_POST['destino_tipo'] ? trim($_POST['destino_tipo']) : "0";
					$IdOrigen = $_POST['origen_id'] ? trim($_POST['origen_id']) : "0";
				}else{
					$IdProducto = '0';
					$TipoDestino = '0';
					$IdOrigen = '0';
				}
				$query = "INSERT INTO servicio_internet (IdServicio, Velocidad, Plan, IdOrigen, IdProducto, TipoDestino) VALUES ('".$id."', '".$Velocidad."', '".$Plan."', '".$IdOrigen."', '".$IdProducto."', '".$TipoDestino."')";
				$data = $run->insert($query);
				if($data){
					include("../../class/inventario/egresos/EgresoClass.php");
					$Egreso = new Egreso();
					$Egreso->storeMovimiento($_POST['producto_id'],$_POST['destino_tipo'],$id);
				}
				break;
			case 3:
				$query = "INSERT INTO mensualidad_puertos_publicos (PuertoTCPUDP, Descripcion,IdServicio) VALUES ('".$_POST['puerto']."', '".$_POST['descripcion']."', '".$id."')";
				$data = $run->insert($query);
				break;
			case 4:
				$query = "INSERT INTO mensualidad_direccion_ip_fija (DireccionIPFija, Descripcion,IdServicio) VALUES ('".$_POST['ip']."', '".$_POST['descripcion']."', '".$id."')";
				$data = $run->insert($query);
				break;
			case 5:
				$query = "INSERT INTO mantencion_red (Descripcion, ComentarioDatosAdicionales,IdServicio) VALUES ('".$_POST['descripcion']."', '".$_POST['comentario']."', '".$id."')";
				$data = $run->insert($query);
				break;
			case 6:
				$query = "INSERT INTO trafico_generado (LineaTelefonica, Descripcion,IdServicio) VALUES ('".$_POST['linea']."', '".$_POST['descripcion']."','".$id."')";
				$data = $run->insert($query);
				break;
		}
	}

	echo json_encode($id);


 ?>



