<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
	$run = new Method;

	$Rut = isset($_POST['Rut']) ? trim($_POST['Rut']) : "";
	$Dv = $run->obtenerDv($Rut);
	$TipoCliente = isset($_POST['TipoCliente']) ? strtoupper(trim($_POST['TipoCliente'])) : "";
	$ClaseCliente = isset($_POST['ClaseCliente']) ? strtoupper(trim($_POST['ClaseCliente'])) : "";
	$Nombre = isset($_POST['Nombre']) ? strtoupper(trim($_POST['Nombre'])) : "";
	$Alias = isset($_POST['Alias']) ? strtoupper(trim($_POST['Alias'])) : "";
	$DireccionComercial = isset($_POST['DireccionComercial']) ? strtoupper(trim($_POST['DireccionComercial'])) : "";
	$Giro = isset($_POST['Giro']) ? strtoupper(trim($_POST['Giro'])) : "";
	$Region = isset($_POST['Region']) ? strtoupper(trim($_POST['Region'])) : "";
	$Ciudad = isset($_POST['Ciudad']) ? strtoupper(trim($_POST['Ciudad'])) : "";
	$Contacto = isset($_POST['Contacto']) ? strtoupper(trim($_POST['Contacto'])) : "";
	$Telefono = isset($_POST['Telefono']) ? trim($_POST['Telefono']) : "";
	$Correo = isset($_POST['Correo']) ? strtoupper(trim($_POST['Correo'])) : "";
	$Comentario = isset($_POST['Comentario']) ? strtoupper(trim($_POST['Comentario'])) : "";
	$TipoPago = isset($_POST['TipoPago']) ? trim($_POST['TipoPago']) : "";
	$idUsuario = $_SESSION['idUsuario'];

	$query = "INSERT INTO personaempresa
			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id)
			VALUES
			('".$Rut."', '".$Dv."', '".$Nombre."', '".$Giro."', '".$Ciudad."', '".$Region."', '".$DireccionComercial."', '".$Correo."', '".$Contacto."', '".$Comentario."', '".$Telefono."', '".$Alias."', '".$TipoCliente."', '".$idUsuario."', '".$ClaseCliente."', '".$TipoPago."')";
	$id = $run->insert($query);
	if($id > 0){
		echo $Rut;
	}else{
		echo false;
	}
	
 ?>