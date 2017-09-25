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

    $Rut = $_POST['Rut'];
    $Grupo = $_POST['Grupo'];
    $TipoFactura = $_POST['TipoFactura'];
    $Valor = $_POST['Valor'];
    $TipoServicio = $_POST['TipoServicio'];
    $TiepoFacturacion = $_POST['TiepoFacturacion'];
    $Descripcion = $_POST['Descripcion'];
    $tipoMoneda = $_POST['tipoMoneda'];
    $idUsuario = $_SESSION['idUsuario'];
    $Alias = $_POST['Alias'];
    $Direccion = $_POST['Direccion'];
    $Latitud = $_POST['Latitud'];
    $Longitud = $_POST['Longitud'];
    $Referencia = $_POST['Referencia'];
    $Contacto = $_POST['Contacto'];
    $Fono = $_POST['Fono'];
    $PosibleEstacion = $_POST['PosibleEstacion'];
    $Equipamiento = $_POST['Equipamiento'];
    $SenalTeorica = $_POST['SenalTeorica'];
	$Codigo = $Rut."-".$dv.$TipoFactura.$ContarFinal;
    $FechaInstalacion = date("Y-m-d");

	$query = " INSERT INTO servicios
                (Rut, Grupo, TipoFactura, Valor, Descuento, IdServicio, TiepoFacturacion, Codigo, Descripcion, TipoMoneda, IdUsuarioSession, Alias, Estatus, FechaInstalacion, InstaladoPor, Comentario, UsuarioPppoe, Direccion, Latitud, Longitud, Referencia, Contacto, Fono, PosibleEstacion, Equipamiento, SenalTeorica)
                VALUES
                ('$Rut', '$Grupo', '$TipoFactura', '$Valor', '$Descuento', '$TipoServicio', '$TiepoFacturacion', '$Codigo', '$Descripcion', '$tipoMoneda', '$idUsuario', '$Alias', '0', '$FechaInstalacion', '', '', '', '$Direccion', '$Latitud', '$Longitud', '$Referencia', '$Contacto', '$Fono', '$PosibleEstacion', '$Equipamiento', '$SenalTeorica')";
	$data = $run->insert($query);
	echo $data
 ?>



