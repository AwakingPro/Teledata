<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO servicios (Rut, Grupo, TipoFacturacion, Valor, Descuento, IdServicio, TiempoFacturacion, Codigo, Descripcion) VALUES ('".$_POST['Rut']."', '".$_POST['Grupo']."','".$_POST['TipoFacturacion']."' , '".$_POST['Valor']."','".$_POST['Descuento']."' ,'".$_POST['TipoServicio']."' ,'".$_POST['TiempoFacturacion']."' ,'' ,'".$_POST['Descripcion']."' );";
	$run = new Method;
	$data = $run->insert($query);
	echo $data
 ?>



