<?php
	require_once('../../class/methods_global/methods.php');
	
	$run = new Method;

	$Rut = isset($_POST['Rut']) ? trim($_POST['Rut']) : "";
	$Dv = $run->obtenerDv($Rut);
	$TipoCliente = isset($_POST['TipoCliente']) ? strtoupper(trim($_POST['TipoCliente'])) : "";
	$ClaseCliente = isset($_POST['ClaseCliente']) ? strtoupper(trim($_POST['ClaseCliente'])) : "";
	$Nombre = isset($_POST['Nombre']) ? strtoupper(trim($_POST['Nombre'])) : "";
	$Alias = isset($_POST['Alias']) ? strtoupper(trim($_POST['Alias'])) : "";
	$DireccionComercial = isset($_POST['DireccionComercial']) ? strtoupper(trim($_POST['DireccionComercial'])) : "";
	$Giro = isset($_POST['Giro']) ? trim($_POST['Giro']) : "";
	$Region = isset($_POST['Region']) ? strtoupper(trim($_POST['Region'])) : "";
	$Ciudad = isset($_POST['Ciudad']) ? strtoupper(trim($_POST['Ciudad'])) : "";
	$Contacto = isset($_POST['Contacto']) ? strtoupper(trim($_POST['Contacto'])) : "";
	$Telefono = isset($_POST['Telefono']) ? trim($_POST['Telefono']) : "";
	$Correo = isset($_POST['Correo']) ? strtoupper(trim($_POST['Correo'])) : "";
	$Comentario = isset($_POST['Comentario']) ? strtoupper(trim($_POST['Comentario'])) : "";
	$TipoPago = isset($_POST['TipoPago']) ? trim($_POST['TipoPago']) : "";
	$PoseePac = isset($_POST['PoseePac']) ? trim($_POST['PoseePac']) : "";
	$Extras = isset($_POST['extras']) ? trim($_POST['extras']) : "";
	$idUsuario = $_SESSION['idUsuario'];
	$query = "INSERT INTO personaempresa
			(rut, dv, nombre, giro, ciudad, region, direccion, correo, contacto, comentario, telefono, alias, tipo_cliente, id_usuario_sistema, clase_cliente, tipo_pago_bsale_id, posee_pac)
			VALUES
			('".$Rut."', '".$Dv."', '".$Nombre."', '".$Giro."', '".$Ciudad."', '".$Region."', '".$DireccionComercial."', '".$Correo."', '".$Contacto."', '".$Comentario."', '".$Telefono."', '".$Alias."', '".$TipoCliente."', '".$idUsuario."', '".$ClaseCliente."', '".$TipoPago."', '".$PoseePac."')";

	$Id = $run->insert($query);

	if($Id > 0){

		if($Extras){
			$Extras = json_decode($Extras);
			foreach($Extras as $Extra){
				$contacto = $Extra[0];
				$tipo_contacto = $Extra[1];
				$correo = $Extra[2];
				$telefono = $Extra[3];
				$query = "INSERT INTO contactos ( contacto, tipo_contacto, correo, telefono, rut ) VALUES ( '".$contacto."', ( SELECT id FROM mantenedor_tipo_contacto WHERE nombre = '".$tipo_contacto."' ), '".$correo."', '".$telefono."', '".$Rut."' )";
				$run->insert($query);
			}
		}

		echo $Id;

		// $query = "SELECT token_produccion as access_token FROM variables_globales";
		// $variables_globales = $run->select($query);
		// $access_token = $variables_globales[0]['access_token'];
		// $query = "	SELECT
		// 				CONCAT(per.rut, '-', per.dv) as codigo, per.cliente_id_bsale, pro.nombre AS provincia, ciu.nombre AS ciudad
		// 			FROM
		// 				personaempresa per
		// 			INNER JOIN ciudades ciu ON per.ciudad = ciu.id
		// 			INNER JOIN provincias pro ON ciu.provincia_id = pro.id
		// 			WHERE
		// 				per.id = '".$IdCliente."'";
		// $Cliente = $run->select($query);
		// $Cliente = $Cliente[0];
		// $Provincia = $Cliente['provincia'];
		// $Ciudad = $Cliente['ciudad'];
		// $array = array(
		// 	"firstName"     => $Contacto,
		// 	"lastName"      => "",
		// 	"email"         => $Correo,
		// 	"phone"         => $Telefono,
		// 	"address"       => $DireccionComercial,
		// 	"company"       => $Nombre,
		// 	"city"          => $Provincia,
		// 	"municipality"  => $Ciudad,
		// 	"activity"      => $Giro
		// );

		// $codigo = $Cliente['codigo'];
		// $url = 'https://api.bsale.cl/v1/clients.json?code='.$codigo;
		// $session = curl_init($url);
		// curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		// $headers = array(
		// 	'access_token: ' . $access_token,
		// 	'Accept: application/json',
		// 	'Content-Type: application/json'
		// );
		// curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
		// $response = curl_exec($session);
		// curl_close($session);
		// $client = json_decode($response, true);
		// if($client['count']){
		// 	$id = $client['items'][0]['id'];
		// 	$array['id'] = $id;
		// 	$url = "https://api.bsale.cl/v1/clients/".$id.".json";
		// 	$session = curl_init($url);
		// 	curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
		// }else{
		// 	$array['code'] = $codigo;
		// 	$url = 'https://api.bsale.cl/v1/clients.json';
		// 	$session = curl_init($url);
		// 	curl_setopt($session, CURLOPT_POST, true);
		// }
		// curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		// $headers = array(
		// 	'access_token: ' . $access_token,
		// 	'Accept: application/json',
		// 	'Content-Type: application/json'
		// );
		// curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
		// $data = json_encode($array);
		// curl_setopt($session, CURLOPT_POSTFIELDS, $data);
		// $response = curl_exec($session);
		// curl_close($session);
		// if(!isset($id)){
		// 	$client = json_decode($response, true);
		// 	$id = $client['id'];
		// }
		// $query = "UPDATE personaempresa SET cliente_id_bsale = '".$id."' WHERE id = '".$IdCliente."'";
		// $update = $run->update($query);
		
	}else{
		echo false;
	}

 ?>