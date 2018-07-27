<?php
	require_once('../../class/methods_global/methods.php');

	$Nombre = isset($_POST['Nombre_update']) ? trim($_POST['Nombre_update']) : "";
	$Giro = isset($_POST['Giro_update']) ? trim($_POST['Giro_update']) : "";
	$DireccionComercial = isset($_POST['DireccionComercial_update']) ? trim($_POST['DireccionComercial_update']) : "";
	$Correo = isset($_POST['Correo_update']) ? trim($_POST['Correo_update']) : "";
	$Contacto = isset($_POST['Contacto_update']) ? trim($_POST['Contacto_update']) : "";
	$Comentario = isset($_POST['Comentario_update']) ? trim($_POST['Comentario_update']) : "";
	$Telefono = isset($_POST['Telefono_update']) ? trim($_POST['Telefono_update']) : "";
	$Alias = isset($_POST['Alias_update']) ? trim($_POST['Alias_update']) : "";
	$TipoCliente = isset($_POST['TipoCliente_update']) ? trim($_POST['TipoCliente_update']) : "";
	$Ciudad = isset($_POST['Ciudad_update']) ? trim($_POST['Ciudad_update']) : "";
	$Region = isset($_POST['Region_update']) ? trim($_POST['Region_update']) : "";
	$TipoPago = isset($_POST['TipoPago_update']) ? trim($_POST['TipoPago_update']) : "";
	$IdCliente = isset($_POST['IdCliente']) ? trim($_POST['IdCliente']) : "";

	$query = "UPDATE personaempresa SET alias = '".$Alias."', nombre = '".$Nombre."', giro = '".$Giro."', direccion = '".$DireccionComercial."', correo = '".$Correo."', contacto = '".$Contacto."', comentario = '".$Comentario."', telefono = '".$Telefono."', tipo_cliente = '".$TipoCliente."', ciudad = '".$Ciudad."', region = '".$Region."', tipo_pago_bsale_id = '".$TipoPago."' WHERE id = '".$IdCliente."'";
	$run = new Method;
	$data = $run->update($query);

	echo $data;

	if($data){
		$query = "SELECT token_prueba as access_token FROM variables_globales";
		$variables_globales = $run->select($query);
		$access_token = $variables_globales[0]['access_token'];
		$query = "	SELECT
						CONCAT(per.rut, '-', per.dv) as codigo, per.cliente_id_bsale, pro.nombre AS provincia, ciu.nombre AS ciudad
					FROM
						personaempresa per
					INNER JOIN ciudades ciu ON per.ciudad = ciu.id
					INNER JOIN provincias pro ON ciu.provincia_id = pro.id
					WHERE
						per.id = '".$IdCliente."'";
		$Cliente = $run->select($query);
		$Cliente = $Cliente[0];
		$Provincia = $Cliente['provincia'];
		$Ciudad = $Cliente['ciudad'];
		$array = array(
			"firstName"     => $Contacto,
			"lastName"      => "",
			"email"         => $Correo,
			"phone"         => $Telefono,
			"address"       => $DireccionComercial,
			"company"       => $Nombre,
			"city"          => $Provincia,
			"municipality"  => $Ciudad,
			"activity"      => $Giro
		);
		if(!$Cliente['cliente_id_bsale']){
			$codigo = $Cliente['codigo'];
			$url = 'https://api.bsale.cl/v1/clients.json?code='.$codigo;
            $session = curl_init($url);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            $headers = array(
                'access_token: ' . $access_token,
                'Accept: application/json',
                'Content-Type: application/json'
            );
            curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($session);
            curl_close($session);
            $client = json_decode($response, true);
            if($client['count']){
				$id = $client['items'][0]['id'];
			}else{
				$array['code'] = $codigo;
				$url = 'https://api.bsale.cl/v1/clients.json';
				$session = curl_init($url);
				curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
				$headers = array(
					'access_token: ' . $access_token,
					'Accept: application/json',
					'Content-Type: application/json'
				);
				curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($session, CURLOPT_POST, true);
				$data = json_encode($array);
				curl_setopt($session, CURLOPT_POSTFIELDS, $data);
				$response = curl_exec($session);
				curl_close($session);
				$client = json_decode($response, true);
				$id = $client['id'];
			}
			$query = "UPDATE personaempresa SET cliente_id_bsale = '".$id."' WHERE id = '".$IdCliente."'";
			$update = $run->update($query);
		}else{
			$id = $Cliente['cliente_id_bsale'];
		}
		$array['id'] = $id;
		$url = "https://api.bsale.cl/v1/clients/".$id.".json";
		$session = curl_init($url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		$headers = array(
			'access_token: ' . $access_token,
			'Accept: application/json',
			'Content-Type: application/json'
		);
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
		$data = json_encode($array);
		echo $data;
		curl_setopt($session, CURLOPT_POSTFIELDS, $data);
		$response = curl_exec($session);
		curl_close($session);
		$client = json_decode($response, true);

		if (count($_POST['extra_telefono']) > 0) {
			$run->delete("DELETE FROM telefono_extra WHERE IdUsuario = '".$IdCliente."'");
			for ($i=0; $i < count($_POST['extra_telefono']); $i++) {
				if ($_POST['extra_telefono'][$i] != "") {
					$query = "INSERT INTO telefono_extra (IdUsuario, Telefono) VALUES ('".$IdCliente."', '".$_POST['extra_telefono'][$i]."')";
					$data = $run->insert($query);
				}

			}
		}

		if (count($_POST['extra_correo']) > 0) {
			$run->delete("DELETE FROM correo_extra WHERE IdUsuario = '".$IdCliente."'");
			for ($i=0; $i < count($_POST['extra_correo']); $i++) {
				if ($_POST['extra_correo'][$i] != "") {
					$query = "INSERT INTO correo_extra (IdUsuario, Correo) VALUES ('".$IdCliente."', '".$_POST['extra_correo'][$i]."')";
					$data = $run->insert($query);
				}

			}
		}

		if (count($_POST['extra_TipoContacto']) > 0) {
			$run->delete("DELETE FROM contactos_extras WHERE IdCliente = '".$IdCliente."'");
			for ($i=0; $i < count($_POST['extra_TipoContacto']); $i++) {
				if ($_POST['extra_TipoContacto'][$i] != "") {
					$query = "INSERT INTO contactos_extras (IdCliente, TipoContacto, Contacto) VALUES ('".$IdCliente."', '".$_POST['extra_TipoContacto'][$i]."', '".$_POST['extra_Contacto'][$i]."');";
					$data = $run->insert($query);
				}

			}
		}
	}


 ?>