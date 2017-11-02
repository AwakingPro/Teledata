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
			(rut, dv, nombre, giro, comuna, ciudad, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, IdUsuarioSession)
			VALUES
			('".$Rut."', '".$Dv."', '".$Nombre."', '".$Giro."', '".$Comuna."', '".$Ciudad."', '".$DireccionComercial."', '".$Correo."', '".$Contacto."', '".$Comentario."', '".$Telefono."', '".$Alias."', '".$TipoCliente."', '".$_SESSION['idUsuario']."')";
	$run = new Method;
	$id = $run->insert($query);
	echo $query;
	echo $id;
	if($id > 0){
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