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

	$query = "INSERT INTO personaempresa
			(rut, dv, nombre, giro, comuna, ciudad, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, IdUsuarioSession, CodigoCliente, ClaseCliente)
			VALUES
			('".$Rut."', '".$Dv."', '".$Nombre."', '".$Giro."', '".$Comuna."', '".$Ciudad."', '".$DireccionComercial."', '".$Correo."', '".$Contacto."', '".$Comentario."', '".$Telefono."', '".$Alias."', '".$TipoCliente."', '".$_SESSION['idUsuario']."', '".$CodigoCliente."', '".$ClaseCliente."')";

	$id = $run->insert($query);

	if($id > 0){

		echo $id;

		if (count($_POST['extra_telefono']) > 0) {
			for ($i=0; $i < count($_POST['extra_telefono']); $i++) {
				if ($_POST['extra_telefono'][$i] != "") {
						$query = "INSERT INTO telefono_extra (IdUsuario, Telefono) VALUES ('".$id."', '".$_POST['extra_telefono'][$i]."')";
					$data = $run->insert($query);
				}

			}
		}

		if (count($_POST['extra_correo']) > 0) {
			for ($i=0; $i < count($_POST['extra_correo']); $i++) {
				if ($_POST['extra_correo'][$i] != "") {
						$query = "INSERT INTO correo_extra (IdUsuario, Correo) VALUES ('".$id."', '".$_POST['extra_correo'][$i]."')";
					$data = $run->insert($query);
				}

			}
		}

		if (count($_POST['extra_TipoContacto']) > 0) {
			for ($i=0; $i < count($_POST['extra_TipoContacto']); $i++) {
				if ($_POST['extra_TipoContacto'][$i] != "") {
					$query = "INSERT INTO contactos_extras (IdCliente, TipoContacto, Contacto) VALUES ('".$id."', '".$_POST['extra_TipoContacto'][$i]."', '".$_POST['extra_Contacto'][$i]."');";
					$data = $run->insert($query);
				}

			}
		}

	}else{
		echo false;
	}

 ?>