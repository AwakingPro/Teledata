<?php
	require_once('../../class/methods_global/methods.php');
	session_start();

	$CodigoCliente = isset($_POST['Rut']) ? trim($_POST['Rut']) : "";
	$RutDv = explode("-", $CodigoCliente);
	if(isset($RutDv[0])){
		$Rut = $RutDv[0];
	}else{
		$Rut = '';
	}
	if(isset($RutDv[1])){
		$Dv = $RutDv[1];
	}else{
		$Dv = '';
	}
	
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
	
	if($Dv){

		$query = "INSERT INTO personaempresa
				(rut, dv, nombre, giro, comuna, ciudad, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, IdUsuarioSession, CodigoCliente)
				VALUES
				('".$Rut."', '".$Dv."', '".$Nombre."', '".$Giro."', '".$Comuna."', '".$Ciudad."', '".$DireccionComercial."', '".$Correo."', '".$Contacto."', '".$Comentario."', '".$Telefono."', '".$Alias."', '".$TipoCliente."', '".$_SESSION['idUsuario']."','".$CodigoCliente."')";
		$run = new Method;
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
	}else{
		echo "Dv";
	}

 ?>