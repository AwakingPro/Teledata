<?php
	require_once('../../class/methods_global/methods.php');
	session_start();

	$Rut = isset($_POST['Rut']) ? trim($_POST['Rut']) : "";
	$Dv = isset($_POST['Dv']) ? trim($_POST['Dv']) : "";
	$Nombre = isset($_POST['Nombre']) ? trim($_POST['Nombre']) : "";
	$Giro = isset($_POST['Giro']) ? trim($_POST['Giro']) : "";
	$DireccionComercial = isset($_POST['DireccionComercial']) ? trim($_POST['DireccionComercial']) : "";
	$Correo = isset($_POST['Correo']) ? trim($_POST['Correo']) : "";
	$Contacto = isset($_POST['Contacto']) ? trim($_POST['Contacto']) : "";
	$Comentario = isset($_POST['Comentario']) ? trim($_POST['Comentario']) : "";
	$Telefono = isset($_POST['Telefono']) ? trim($_POST['Telefono']) : "";
	$Alias = isset($_POST['Alias']) ? trim($_POST['Alias']) : "";
	$TipoCliente = isset($_POST['TipoCliente']) ? trim($_POST['TipoCliente']) : "";
	$Comuna = isset($_POST['Comuna']) ? trim($_POST['Comuna']) : "";
	$Ciudad = isset($_POST['Ciudad']) ? trim($_POST['Ciudad']) : "";

	$query = "INSERT INTO personaempresa 
			(rut, dv, nombre, giro, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, IdUsuarioSession, comuna, ciudad) 
			VALUES 
			('".$Rut."', '".$Dv."', '".$Nombre."', '".$Giro."', '".$DireccionComercial."', '".$Correo."', '".$Contacto."', '".$Comentario."', '".$Telefono."', '".$Alias."', '".$TipoCliente."', '".$_SESSION['idUsuario']."', '".$Comuna."', '".$Ciudad."')";
	$run = new Method;
	$id = $run->insert($query);
	echo $data
 ?>