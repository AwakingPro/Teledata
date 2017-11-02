<?php

    include('../../class/methods_global/methods.php'); 

    header('Content-type: application/json');

    class Factura{

    	public function showServicios(){

    		$query = 'SELECT servicios.*, personaempresa.nombre as Cliente FROM servicios INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut where servicios.estatus = 1';

            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);
    	}

        public function storeFactura($Id){

            if(in_array  ('curl', get_loaded_extensions())) {

                //Demo
                $access_token='b6ae44d94c240baa08b9fb48aa4333aa712cf3c2';
                //Producción
                // $access_token='957d3b3419bacf7dbd0dd528172073c9903d618b';

                $query = "SELECT servicios.*, mantenedor_servicios.servicio as Servicio FROM servicios LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio where servicios.Id = '$Id'";

                $run = new Method;
                $Servicio = $run->select($query);
                $Servicio = $Servicio[0];
                $Rut = $Servicio['Rut'];

                $query = "SELECT * from personaempresa where rut = '$Rut'";
                $run = new Method;
                $cliente = $run->select($query);
                $cliente = $cliente[0];

                //CONSULTA AL CLIENTE

                $url='https://api.bsale.cl/v1/clients.json?code='.$cliente['rut'].'-'.$cliente['dv'];

                // Inicia cURL
                $session = curl_init($url);

                // Indica a cURL que retorne data
                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
                // Activa SSL
                // curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, true);

                // Configura cabeceras
                $headers = array(
                    'access_token: ' . $access_token,
                    'Accept: application/json',
                    'Content-Type: application/json'
                );
                curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

                // Ejecuta cURL
                $response = curl_exec($session);

                // Cierra la sesión cURL
                curl_close($session);

                //Esto es sólo para poder visualizar lo que se está retornando
                $client = json_decode($response, true);

                //SI EL CLIENTE NO EXISTE EN LA API, SE CREA CON LA DATA DE TELEDATA

                if($client['count']){
                    $clientId = $client['items'][0]['id'];
                }else{

                    if($cliente['ciudad']){
                        $ciudad = $cliente['ciudad'];
                    }else{
                        $ciudad = 'Santiago';
                    }

                    if($cliente['comuna']){
                        $comuna = $cliente['comuna'];
                    }else{
                        $comuna = 'Las Condes';
                    }

                    $clientId = null;
                    $client = array(
                        "code"          => $cliente['rut'].'-'.$cliente['dv'],
                        "firstName"     => $cliente['contacto'],
                        "lastName"      => "",
                        "email"         => $cliente['correo'],
                        "phone"         => $cliente['telefono'],
                        "address"       => $cliente['direccion'],
                        "company"       => $cliente['nombre'],
                        "city"          => $ciudad,
                        "municipality"  => $comuna,
                        "activity"      => $cliente['giro']
                    );
                }

                //CREACION DE LA FACTURA

                $url='https://api.bsale.cl/v1/documents.json';

                // Inicia cURL
                $session = curl_init($url);

                // Indica a cURL que retorne data
                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
                // Activa SSL
                // curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, true);

                // Configura cabeceras
                $headers = array(
                    'access_token: ' . $access_token,
                    'Accept: application/json',
                    'Content-Type: application/json'
                );
                curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

                // Indica que se va ser una petición POST
                curl_setopt($session, CURLOPT_POST, true);

                //CONSTRUCCION DEL ARRAY DE DETALLE

                $details = array();
                $detail = array("netUnitValue" => floatval($Servicio['Valor']), "quantity" => 1, "taxId" => "[1]", "comment" => $Servicio["Servicio"], "discount" => floatval($Servicio["Descuento"]));

                array_push($details,$detail);

                //documentTypeId de Factura para Demo
                // "documentTypeId"    => 82

                //documentTypeId de Factura para Producción
                // "documentTypeId"    => 5

                //En demo hay que enviar obligatoriamente el priceListId, en producción hay que quitarlo

                $array = array(
                    // "documentTypeId"     => 5,
                    "documentTypeId"    => 82,
                    // "officeId"           => 83,
                    "priceListId"        => 18,
                    "emissionDate"      => time(),
                    "expirationDate"    => time(),
                    "declareSii"        => 1,
                    "details"           => $details
                );

                if($clientId){
                    $array['clientId'] = $clientId;
                }else{
                    $array['client'] = $client;
                }

                // Parsea a JSON
                $data = json_encode($array);

                // Agrega parámetros
                curl_setopt($session, CURLOPT_POSTFIELDS, $data);

                // Ejecuta cURL
                $response = curl_exec($session);

                // // Cierra la sesión cURL
                curl_close($session);

                //Esto es sólo para poder visualizar lo que se está retornando
                $Factura = json_decode($response, true);

                if($Factura){
                    $DocumentoId = $Factura['id'];
                    $UrlPdf = $Factura['urlPublicViewOriginal'];
                    $informedSii = $Factura['informedSii'];
                    $responseMsgSii = $Factura['responseMsgSii'];
                    $Hoy = new DateTime(); 
                    $Hoy = $Hoy->format('Y-m-d H:i:s');

                    $query = "UPDATE `servicios` set `DocumentoIdBsale` = '$DocumentoId', `UrlPdfBsale` = '$UrlPdf', `informedSiiBsale` = '$informedSii', `responseMsgSiiBsale` = '$responseMsgSii', `EstatusFacturacion` = '1', `FechaFacturacion` = '$Hoy', `HoraFacturacion` = '$Hoy' where `id` = '$Id'";
                    $run = new Method;
                    $data = $run->update($query);

                    $response_array['UrlPdf'] = $UrlPdf;
                    $response_array['status'] = 1; 

                }else{
                    $response_array['status'] = 0;
                }
            }else{
                $response_array['status'] = 99;
            }

            echo json_encode($response_array);
        }
    }
?>