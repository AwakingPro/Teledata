<?php
	require_once('../../class/methods_global/methods.php');

	$Rut = isset($_POST['Rut_update']) ? trim($_POST['Rut_update']) : "";
	$Dv = isset($_POST['Dv_update']) ? trim($_POST['Dv_update']) : "";
	$Nombre = isset($_POST['Nombre_update']) ? trim($_POST['Nombre_update']) : "";
	$Giro = isset($_POST['Giro_update']) ? trim($_POST['Giro_update']) : "";
	$DireccionComercial = isset($_POST['DireccionComercial_update']) ? trim($_POST['DireccionComercial_update']) : "";
	$Correo = isset($_POST['Correo_update']) ? trim($_POST['Correo_update']) : "";
	$Contacto = isset($_POST['Contacto_update']) ? trim($_POST['Contacto_update']) : "";
	$Comentario = isset($_POST['Comentario_update']) ? trim($_POST['Comentario_update']) : "";
	$Telefono = isset($_POST['Telefono_update']) ? trim($_POST['Telefono_update']) : "";
	$Alias = isset($_POST['Alias_update']) ? trim($_POST['Alias_update']) : "";
	$TipoCliente = isset($_POST['TipoCliente_update']) ? trim($_POST['TipoCliente_update']) : "";
	$Comuna = isset($_POST['Comuna_update']) ? trim($_POST['Comuna_update']) : "";
	$Ciudad = isset($_POST['Ciudad_update']) ? trim($_POST['Ciudad_update']) : "";
	$IdCliente = isset($_POST['IdCliente']) ? trim($_POST['IdCliente']) : "";

	$query = "UPDATE personaempresa SET rut = '$Rut', dv = '$Dv', nombre = '$Nombre', giro = '$Giro', direccion = '$DireccionComercial', correo = '$Correo', contacto = '$Contacto', comentario = '$Comentario', telefono = '$Telefono', tipo_cliente = '$TipoCliente', comuna = '$Comuna', ciudad = '$Ciudad' WHERE id = '$IdCliente'";
	$run = new Method;
	$data = $run->update($query);
	echo $data;
 ?>