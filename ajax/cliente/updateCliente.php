<?php
	require_once('../../class/methods_global/methods.php');

	$Rut = substr($_POST['Rut_update'], 0, strpos($_POST['Rut_update'], '-'));
	$Dv = substr($_POST['Rut_update'], - 1);
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
	$CodigoCliente = isset($_POST['Rut_update']) ? trim($_POST['Rut_update']) : "";

	$query = "UPDATE personaempresa SET alias='$Alias', CodigoCliente = '$CodigoCliente',  rut = '$Rut', dv = '$Dv', nombre = '$Nombre', giro = '$Giro', direccion = '$DireccionComercial', correo = '$Correo', contacto = '$Contacto', comentario = '$Comentario', telefono = '$Telefono', tipo_cliente = '$TipoCliente', comuna = '$Comuna', ciudad = '$Ciudad' WHERE id = '$IdCliente'";
	$run = new Method;
	$data = $run->update($query);

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

	echo $data;
 ?>