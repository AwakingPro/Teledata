<?php
	require_once('../../class/methods_global/methods.php');
	$query = "INSERT INTO personaempresa (rut, dv, nombre, giro, direccion, correo, contacto, comentario, telefono, alias) VALUES ('".$_POST['Rut']."', '".$_POST['Dv']."', '".$_POST['Nombre']."', '".$_POST['Giro']."', '".$_POST['DireccionComercial']."', '".$_POST['Correo']."', '".$_POST['Contacto']."', '".$_POST['Comentario']."', '".$_POST['Telefono']."','".$_POST['alias']."')";
	$run = new Method;
	$data = $run->insert($query);
	$id = $data;
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
	}
	echo $id;
 ?>