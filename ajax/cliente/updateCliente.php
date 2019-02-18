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
	$PoseePac = isset($_POST['PoseePac_update']) ? trim($_POST['PoseePac_update']) : "";
	$IdCliente = isset($_POST['IdCliente']) ? trim($_POST['IdCliente']) : "";
	$cliente_id_bsale = isset($_POST['cliente_id_bsale']) ? trim($_POST['cliente_id_bsale']) : "";
	$stateOculto = isset($_POST['stateOculto']) ? trim($_POST['stateOculto']) : "";
	$stateCliente = isset($_POST['stateCliente']) ? trim($_POST['stateCliente']) : "";
	$query = "UPDATE personaempresa SET alias = '".$Alias."', nombre = '".$Nombre."', giro = '".$Giro."', direccion = '".$DireccionComercial."', correo = '".$Correo."', contacto = '".$Contacto."', comentario = '".$Comentario."', telefono = '".$Telefono."', tipo_cliente = '".$TipoCliente."', ciudad = '".$Ciudad."', region = '".$Region."', tipo_pago_bsale_id = '".$TipoPago."', posee_pac = '".$PoseePac."', state = '".$stateCliente."' WHERE id = '".$IdCliente."'";
	$run = new Method;
	$data = $run->update($query);
	if($stateCliente != $stateOculto){
		if($cliente_id_bsale){
			switch ($stateCliente) {
				case 0:
					$metodo = 'PUT';
					break;
				case 1:
					$metodo = 'DELETE';
					break;
				case 2:
					exit;
			}
			$DatosCliente = array(
				"id"			=> $cliente_id_bsale,
				"state"			=> $stateCliente,
				"metodo"		=> $metodo
			);
			$url = "https://api.bsale.cl/v1/clients/".$cliente_id_bsale.".json";
			print_r($run->EditClientApiBsale($DatosCliente, $url));
		}
	}
	

	// if($data){
	// 	$query = "SELECT token_produccion as access_token FROM variables_globales";
	// 	$variables_globales = $run->select($query);
	// 	$access_token = $variables_globales[0]['access_token'];
	// 	$query = "	SELECT
	// 					CONCAT(per.rut, '-', per.dv) as codigo, per.cliente_id_bsale, pro.nombre AS provincia, ciu.nombre AS ciudad
	// 				FROM
	// 					personaempresa per
	// 				INNER JOIN ciudades ciu ON per.ciudad = ciu.id
	// 				INNER JOIN provincias pro ON ciu.provincia_id = pro.id
	// 				WHERE
	// 					per.id = '".$IdCliente."'";
	// 	$Cliente = $run->select($query);
	// 	$Cliente = $Cliente[0];
		
	// 	$Provincia = $Cliente['provincia'];
	// 	$Ciudad = $Cliente['ciudad'];
	// 	$Code = $Cliente['codigo'];
		
	// 	$array = array(
	// 		"id"			=> $Cliente['cliente_id_bsale'],
	// 		"municipality"  => $Ciudad,
	// 		"phone"         => $Telefono,
	// 		"state"			=> 0,
	// 		"activity"      => $Giro,
	// 		"city"          => $Provincia,
	// 		"lastName"      => "",
	// 		"firstName"     => $Contacto,
	// 		"company"       => $Nombre,
	// 		"address"       => $DireccionComercial,
	// 		"email"         => $Correo,
	// 		"code"			=> $Code,
	// 	);

	// 	if(!$Cliente['cliente_id_bsale']){
	// 		$codigo = $Cliente['codigo'];
	// 		$url = 'https://api.bsale.cl/v1/clients.json?code='.$codigo;
    //         $session = curl_init($url);
    //         curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    //         $headers = array(
    //             'access_token: ' . $access_token,
    //             'Accept: application/json',
    //             'Content-Type: application/json'
    //         );
    //         curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
    //         $response = curl_exec($session);
    //         curl_close($session);
	// 		$client = json_decode($response, true);

    //         if($client['count']){
	// 			$id = $client['items'][0]['id'];
	// 		}
	// 		else{
	// 			$array['code'] = $codigo;
	// 			$url = 'https://api.bsale.cl/v1/clients.json';
	// 			$session = curl_init($url);
	// 			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	// 			$headers = array(
	// 				'access_token: ' . $access_token,
	// 				'Accept: application/json',
	// 				'Content-Type: application/json'
	// 			);
	// 			curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
	// 			curl_setopt($session, CURLOPT_POST, true);
	// 			$data = json_encode($array);
	// 			curl_setopt($session, CURLOPT_POSTFIELDS, $data);
	// 			$response = curl_exec($session);
	// 			curl_close($session);
	// 			$client = json_decode($response, true);
	// 			$id = $client['id'];
	// 		}
			
	// 		$query = "UPDATE personaempresa SET cliente_id_bsale = '".$id."' WHERE id = '".$IdCliente."'";
	// 		$update = $run->update($query);
	// 	}else{
	// 		$id = $Cliente['cliente_id_bsale'];
	// 	}
		
	// 	$array['id'] = $id;
	// 	$url = "https://api.bsale.cl/v1/clients/".$id.".json";
		
	// 	$session = curl_init($url);
		
	// 	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	// 	$headers = array(
	// 		'access_token: ' . $access_token,
	// 		'Accept: application/json',
	// 		'Content-Type: application/json'
	// 	);
	// 	curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
	// 	curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
	// 	$data = json_encode($array);
		
	// 	curl_setopt($session, CURLOPT_POSTFIELDS, $data);
	// 	$response = curl_exec($session);
		
	// 	curl_close($session);
	// 	$client = json_decode($response, true);
		
	// }


 ?>