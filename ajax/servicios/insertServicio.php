<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$run = new Method;
	$dv = $run->select("SELECT dv FROM personaempresa WHERE rut = ".$_POST['Rut']);
	$dv = $dv[0][0];
	$Contar = count($run->select("SELECT Rut FROM servicios WHERE Rut = ". $_POST['Rut'] ."  AND IdServicio = ".$_POST['TipoServicio']));
	$Contar = $Contar+1;
	if($Contar<10){
		$ContarFinal = "0".$Contar;
	}else{
		$ContarFinal = $Contar;
	}

	$Descuento = $_POST['Descuento'];
	if(!$Descuento){
		$Descuento = 0;
	}

	$Rut = isset($_POST['Rut']) ? trim($_POST['Rut']) : "";
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
	$UsuarioPppoe = isset($_POST['UsuarioPppoe']) ? trim($_POST['UsuarioPppoe']) : "";
	$SenalTeorica = isset($_POST['SenalTeorica']) ? trim($_POST['SenalTeorica']) : "";
	$Codigo = $Rut."-".$dv.$TipoFactura.$ContarFinal;
	$FechaInstalacion = date("Y-m-d");
	$idUsuario = $_SESSION['idUsuario'];

	echo $query = " INSERT INTO servicios (Rut, Grupo, TipoFactura, Valor, Descuento, IdServicio, TiepoFacturacion, Codigo, Descripcion, TipoMoneda, IdUsuarioSession, Alias, Estatus, FechaInstalacion, InstaladoPor, Comentario, UsuarioPppoe, Direccion, Latitud, Longitud, Referencia, Contacto, Fono, PosibleEstacion, Equipamiento, SenalTeorica, IdUsuarioAsignado, SenalFinal, EstacionFinal) VALUES ('".$Rut."', '".$Grupo."', '".$TipoFactura."', '".$Valor."', '".$Descuento."', '".$TipoServicio."', '".$TiepoFacturacion."', '".$Codigo."', '".$Descripcion."', '".$tipoMoneda."', '".$idUsuario."', '".$Alias."', '0', '".$FechaInstalacion."', '', '', '".$UsuarioPppoe."', '".$Direccion."', '".$Latitud."', '".$Longitud."', '".$Referencia."', '".$Contacto."', '".$Fono."', '".$PosibleEstacion."', '".$Equipamiento."', '".$SenalTeorica."', '', '', '')";
	$data = $run->insert($query);
	echo $data
 ?>



