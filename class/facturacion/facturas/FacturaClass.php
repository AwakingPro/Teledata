<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Factura{

    	public function showServicios(){

    		$query = 'SELECT servicios.*, personaempresa.nombre as Cliente FROM servicios INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut where servicios.estatus = 1';

            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);
    	}

        public function showFacturas(){

            $query = 'SELECT facturas.*, personaempresa.nombre as Cliente FROM facturas INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut';

            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);
        }

        public function storeFactura($Id, $Tipo){

            if(in_array  ('curl', get_loaded_extensions())) {

                //Demo
                // $access_token='b6ae44d94c240baa08b9fb48aa4333aa712cf3c2';
                //Producción
                $access_token='957d3b3419bacf7dbd0dd528172073c9903d618b';

                if($Tipo == 2){
                    $query = "SELECT facturas.*, mantenedor_servicios.servicio as Servicio FROM facturas LEFT JOIN servicios ON servicios.Id = facturas.IdServicio LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio where facturas.Id = '$Id'";
                }else{
                    $query = "SELECT servicios.*, mantenedor_servicios.servicio as Servicio FROM servicios LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio where servicios.Id = '$Id'";
                }

                $run = new Method;
                $Servicio = $run->select($query);

                if($Servicio){

                    $Servicio = $Servicio[0];
                    $Rut = $Servicio['Rut'];
                    $TipoMoneda = $Servicio['TipoMoneda'];

                    $query = "SELECT * from personaempresa where rut = '$Rut'";
                    $run = new Method;
                    $cliente = $run->select($query);

                    if($cliente){

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

                        if($TipoMoneda == 'UF'){

                            $Mes = date('n');

                            $query = "SELECT * from mantenedor_uf where mes = '$Mes' ORDER BY id DESC LIMIT 1";
                            $run = new Method;
                            $Uf = $run->select($query);

                            if($Uf){
                                $Uf = $Uf[0];
                                $Valor = str_replace('.','',$Uf['valor']);
                                $Valor = floatval($Servicio['Valor']) * floatval($Valor);
                            }else{
                                $response_array['status'] = 2;
                                echo json_encode($response_array);
                                return;
                            }
                        }else{
                            $Valor = floatval($Servicio['Valor']);
                        }

                        $details = array();
                        $detail = array("netUnitValue" => $Valor, "quantity" => 1, "taxId" => "[1]", "comment" => $Servicio["Servicio"], "discount" => floatval($Servicio["Descuento"]));

                        array_push($details,$detail);

                        //documentTypeId de Factura para Demo
                        // "documentTypeId"    => 82

                        //documentTypeId de Factura para Producción
                        // "documentTypeId"    => 5

                        $array = array(
                            "documentTypeId"     => 5,
                            // "documentTypeId"    => 82,
                            // "priceListId"        => 18,
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

                            //Para actualizar los datos del servicios con los datos de Bsale

                            $DocumentoId = $Factura['id'];
                            $UrlPdf = $Factura['urlPublicViewOriginal'];
                            $informedSii = $Factura['informedSii'];
                            $responseMsgSii = $Factura['responseMsgSii'];
                            $Hoy = new DateTime(); 
                            $Hoy = $Hoy->format('Y-m-d H:i:s');


                            if($Tipo == 2){
                                $query = "UPDATE `facturas` set `DocumentoIdBsale` = '$DocumentoId', `UrlPdfBsale` = '$UrlPdf', `informedSiiBsale` = '$informedSii', `responseMsgSiiBsale` = '$responseMsgSii', `EstatusFacturacion` = '1', `FechaFacturacion` = '$Hoy', `HoraFacturacion` = '$Hoy' where `Id` = '$Id'";
                            }else{
                                $query = "UPDATE `servicios` set `DocumentoIdBsale` = '$DocumentoId', `UrlPdfBsale` = '$UrlPdf', `informedSiiBsale` = '$informedSii', `responseMsgSiiBsale` = '$responseMsgSii', `EstatusFacturacion` = '1', `FechaFacturacion` = '$Hoy', `HoraFacturacion` = '$Hoy' where `Id` = '$Id'";
                            }

                            $run = new Method;
                            $data = $run->update($query);

                            $response_array['UrlPdf'] = $UrlPdf;
                            $response_array['status'] = 1; 

                        }else{
                            $response_array['status'] = 0;
                        }
                    }else{
                        $response_array['status'] = 4;
                    }
                }else{
                    $response_array['status'] = 3;
                }
            }else{
                $response_array['status'] = 99;
            }

            echo json_encode($response_array);
        }

        public function generarFacturasMensuales(){

            $run = new Method;
            $query = "SELECT * FROM variables_globales";
            $Variables = $run->select($query);

            if($Variables){

                $Variables = $Variables[0];
                $FechaComprobacion = $Variables['fecha_comprobacion'];
                $Hoy = new DateTime(); 
                $Hoy = $Hoy->format('Y-m-d');

                if($Hoy > $FechaComprobacion){

                    $query = "SELECT servicios.*, mantenedor_servicios.servicio as Servicio FROM servicios LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio";
                    $Servicios = $run->select($query);

                    foreach($Servicios as $Servicio){

                        $Rut = $Servicio['Rut'];
                        $Grupo = $Servicio['Grupo'];
                        $IdServicio = $Servicio['Id'];
                        $Valor = $Servicio['Valor'];
                        $Descuento = $Servicio['Descuento'];
                        $TipoMoneda = $Servicio['TipoMoneda'];
                        $Hoy = new DateTime(); 
                        $Hoy = $Hoy->format('Y-m-d H:i:s');

                        $query = "INSERT INTO facturas(Rut, Grupo, IdServicio, Valor, Descuento, TipoMoneda, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion) VALUES ('$Rut', '$Grupo', '$IdServicio', '$Valor', '$Descuento', '$TipoMoneda', '0', '0', '', '0', '', '$Hoy', '$Hoy')";
                        $data = $run->insert($query);
                    }

                    $FechaComprobacion = date('Y-m-d', strtotime('first day of next month'));
                    $query = "UPDATE `variables_globales` set `fecha_comprobacion` = '$FechaComprobacion'";
                    $update = $run->update($query);
                }
            }

            $response_array['status'] = 1; 

            echo json_encode($response_array);

        }
    }
?>