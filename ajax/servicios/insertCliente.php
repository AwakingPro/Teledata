<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$run = new Method;

	$Rut = isset($_POST['Rut']) ? trim($_POST['Rut']) : "";
	$Dv = $run->obtenerDv($Rut);
	$CodigoCliente = $Rut.'-'.$Dv;
	$TipoCliente = isset($_POST['TipoCliente']) ? strtoupper(trim($_POST['TipoCliente'])) : "";
	$ClaseCliente = isset($_POST['ClaseCliente']) ? strtoupper(trim($_POST['ClaseCliente'])) : "";
	$Nombre = isset($_POST['Nombre']) ? strtoupper(trim($_POST['Nombre'])) : "";
	$Alias = isset($_POST['Alias']) ? strtoupper(trim($_POST['Alias'])) : "";
	$DireccionComercial = isset($_POST['DireccionComercial']) ? strtoupper(trim($_POST['DireccionComercial'])) : "";
	$Giro = isset($_POST['Giro']) ? strtoupper(trim($_POST['Giro'])) : "";
	$Ciudad = isset($_POST['Ciudad']) ? strtoupper(trim($_POST['Ciudad'])) : "";
	$Comuna = isset($_POST['Comuna']) ? strtoupper(trim($_POST['Comuna'])) : "";
	$Contacto = isset($_POST['Contacto']) ? strtoupper(trim($_POST['Contacto'])) : "";
	$Telefono = isset($_POST['Telefono']) ? trim($_POST['Telefono']) : "";
	$Correo = isset($_POST['Correo']) ? strtoupper(trim($_POST['Correo'])) : "";
	$Comentario = isset($_POST['Comentario']) ? strtoupper(trim($_POST['Comentario'])) : "";
	$idUsuario = $_SESSION['idUsuario'];

	$query = "INSERT INTO personaempresa
			(rut, dv, nombre, giro, comuna, ciudad, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, IdUsuarioSession, CodigoCliente, ClaseCliente)
			VALUES
			('".$Rut."', '".$Dv."', '".$Nombre."', '".$Giro."', '".$Comuna."', '".$Ciudad."', '".$DireccionComercial."', '".$Correo."', '".$Contacto."', '".$Comentario."', '".$Telefono."', '".$Alias."', '".$TipoCliente."', '".$idUsuario."', '".$CodigoCliente."', '".$ClaseCliente."')";
	$id = $run->insert($query);
	if($id > 0){
		echo $Rut;
	}else{
		echo false;
	}
	
 ?>