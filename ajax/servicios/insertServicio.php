<?php
	require_once('../../class/methods_global/methods.php');
	$run = new Method;
	$dv = $run->select("SELECT dv FROM PersonaEmpresa WHERE rut = ".$_POST['Rut']);
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

	$Codigo = $_POST['Rut']."-".$dv.$_POST['TipoFactura'].$ContarFinal;
	$query = "INSERT INTO servicios (Rut, Grupo, TipoFactura, Valor, Descuento, IdServicio, TiepoFacturacion, Codigo, Descripcion, TipoMoneda, Alias) VALUES ('".$_POST['Rut']."', '".$_POST['Grupo']."','".$_POST['TipoFactura']."' , '".$_POST['Valor']."','$Descuento' ,'".$_POST['TipoServicio']."' ,'".$_POST['TiepoFacturacion']."' ,'".$Codigo."' ,'".$_POST['Descripcion']."', '".$_POST['tipoMoneda']."', '".$_POST['Alias']."')";
	$data = $run->insert($query);
	echo $data
 ?>



