<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Factura{

    	public function showServicios(){            

            $run = new Method;

            $Mes = date('n');

            $query = "SELECT * from mantenedor_uf where mes = '$Mes' ORDER BY id DESC LIMIT 1";
            $UF = $run->select($query);

            if($UF){
                $UF = $UF[0];
                $UF = str_replace('.','',$UF['valor']);
                $UF = floatval($UF);
            }else{
                $UF = 1;
            }

            $data = array();

    		$query = 'SELECT servicios.Rut, servicios.Grupo, servicios.Valor, servicios.TipoMoneda, servicios.EstatusFacturacion, personaempresa.nombre as Cliente FROM servicios INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut where servicios.Estatus = 1 AND servicios.EstatusFacturacion = 0';

            $servicios = $run->select($query);

            if($servicios){
                foreach($servicios as $servicio){

                    $Rut = $servicio['Rut'];
                    $Grupo = $servicio['Grupo'];
                    $Index = $Rut.'-'.$Grupo;

                    $TipoMoneda = $servicio['TipoMoneda'];

                    if(!isset($data[$Index])){
                        $data[$Index] = $servicio;
                        $data[$Index]['Tipo'] = 1;
                        $data[$Index]['ValorPesos'] = 0;
                        $data[$Index]['ValorUF'] = 0;
                    }

                    if($TipoMoneda == 'UF'){
                        
                        $ValorUF = $data[$Index]['ValorUF'];
                        $ValorTotal = $ValorUF + $servicio['Valor'];
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorUF'] = $ValorTotal;

                        $ValorPesos = $ValorUF * $UF;
                        $ValorTotal = $ValorPesos + $data[$Index]['ValorPesos'];
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorPesos'] = $ValorTotal;

                    }else{

                        $ValorPesos = $data[$Index]['ValorPesos'];
                        $ValorTotal = $ValorPesos + $servicio['Valor'];
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorPesos'] = $ValorTotal;

                        $ValorUF = $ValorPesos / $UF;
                        $ValorTotal = $ValorUF + $data[$Index]['ValorUF'];
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorUF'] = $ValorTotal;

                    }

                }
            }

            $query = "  SELECT    facturas_detalle.*, facturas.Id, facturas.Rut, facturas.Grupo, facturas.UrlPdfBsale, personaempresa.nombre as Cliente, mantenedor_servicios.servicio as Servicio 
                        FROM facturas_detalle 
                        LEFT JOIN servicios ON servicios.Id = facturas_detalle.IdServicio 
                        LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
                        INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                        INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut
                        WHERE facturas.TipoFactura = '3'";

            $facturas = $run->select($query);

            if($facturas){

                foreach($facturas as $factura){

                    $Index = $factura['Id'];
                    $TipoMoneda = $factura['TipoMoneda'];

                    if(!isset($data[$Index])){
                        $data[$Index] = $factura;
                        $data[$Index]['Tipo'] = 2;
                        $data[$Index]['ValorPesos'] = 0;
                        $data[$Index]['ValorUF'] = 0;
                    }

                    if($TipoMoneda == 'UF'){
                        
                        $ValorUF = $data[$Index]['ValorUF'];
                        $ValorTotal = $ValorUF + $factura['Valor'];
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorUF'] = $ValorTotal;

                        $ValorPesos = $ValorUF * $UF;
                        $ValorTotal = $ValorPesos + $data[$Index]['ValorPesos'];
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorPesos'] = $ValorTotal;

                    }else{

                        $ValorPesos = $data[$Index]['ValorPesos'];
                        $ValorTotal = $ValorPesos + $factura['Valor'];
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorPesos'] = $ValorTotal;

                        $ValorUF = $ValorPesos / $UF;
                        $ValorTotal = $ValorUF + $data[$Index]['ValorUF'];
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorUF'] = $ValorTotal;

                    }
                }
            }

            $response_array['array'] = $data;

            echo json_encode($response_array);
    	}

        public function showFacturas(){

            $run = new Method;

            $Mes = date('n');

            $query = "SELECT * from mantenedor_uf where mes = '$Mes' ORDER BY id DESC LIMIT 1";
            $UF = $run->select($query);

            if($UF){
                $UF = $UF[0];
                $UF = str_replace('.','',$UF['valor']);
                $UF = floatval($UF);
            }else{
                $UF = 1;
            }

            $query = "  SELECT    facturas_detalle.*, facturas.Id, facturas.Rut, facturas.Grupo, facturas.UrlPdfBsale, facturas.EstatusFacturacion, personaempresa.nombre as Cliente, mantenedor_servicios.servicio as Servicio 
                        FROM facturas_detalle 
                        LEFT JOIN servicios ON servicios.Id = facturas_detalle.IdServicio 
                        LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
                        INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                        INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut
                        WHERE facturas.TipoFactura = '2'";

            $facturas = $run->select($query);

            $data = array();

            if($facturas){

                foreach($facturas as $factura){

                    $Index = $factura['Id'];
                    $TipoMoneda = $factura['TipoMoneda'];

                    if(!isset($data[$Index])){
                        $data[$Index] = $factura;
                        $data[$Index]['ValorPesos'] = 0;
                        $data[$Index]['ValorUF'] = 0;
                    }

                    if($TipoMoneda == 'UF'){

                        if(isset($data[$Index]['ValorUF'])){
                            $ValorUF = $data[$Index]['ValorUF'];
                        }else{
                            $ValorUF = 0;
                        }
                        
                        $ValorTotal = $ValorUF + $factura['Valor'];
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorUF'] = $ValorTotal;

                        $ValorPesos = $ValorUF * $UF;

                        if(isset($data[$Index]['ValorPesos'])){
                            $ValorTotal = $data[$Index]['ValorPesos'];
                        }else{
                            $ValorTotal = 0;
                        }

                        $ValorTotal = $ValorPesos + $ValorTotal;
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorPesos'] = $ValorTotal;

                    }else{

                        if(isset($data[$Index]['ValorPesos'])){
                            $ValorPesos = $data[$Index]['ValorPesos'];
                        }else{
                            $ValorPesos = 0;
                        }

                        $ValorTotal = $ValorPesos + $factura['Valor'];
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorPesos'] = $ValorTotal;

                        $ValorUF = $ValorPesos / $UF;

                        if(isset($data[$Index]['ValorUF'])){
                            $ValorTotal = $data[$Index]['ValorUF'];
                        }else{
                            $ValorTotal = 0;
                        }
                        
                        $ValorTotal = $ValorUF + $ValorTotal;
                        $ValorTotal = number_format($ValorTotal, 2);
                        $data[$Index]['ValorUF'] = $ValorTotal;

                    }
                }
            }

            $response_array['array'] = $data;

            echo json_encode($response_array);
        }

        public function storeFactura($RutId, $Grupo, $Tipo){

            if(in_array  ('curl', get_loaded_extensions())) {

                //Demo
                $access_token='b6ae44d94c240baa08b9fb48aa4333aa712cf3c2';
                //Producción
                // $access_token='957d3b3419bacf7dbd0dd528172073c9903d618b';

                if($Tipo == 2){
                    $query = "SELECT facturas_detalle.*, mantenedor_servicios.servicio as Servicio, servicios.Rut FROM facturas_detalle LEFT JOIN servicios ON servicios.Id = facturas_detalle.IdServicio LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio WHERE facturas_detalle.FacturaId = '$RutId'";
                }else{
                    $query = "SELECT servicios.*, mantenedor_servicios.servicio as Servicio FROM servicios LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio WHERE servicios.Rut = '$RutId' AND servicios.Grupo = '$Grupo'";
                }

                $run = new Method;
                $Servicios = $run->select($query);

                if($Servicios){

                    $Servicio = $Servicios[0];
                    $Rut = $Servicio['Rut'];

                    $query = "SELECT * from personaempresa where rut = '$Rut'";
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

                        $details = array();

                        foreach($Servicios as $Servicio){

                            $TipoMoneda = $Servicio['TipoMoneda'];
            
                            if($TipoMoneda == 'UF'){

                                $Mes = date('n');

                                $query = "SELECT * from mantenedor_uf where mes = '$Mes' ORDER BY id DESC LIMIT 1";
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

                            $detail = array("netUnitValue" => $Valor, "quantity" => 1, "taxId" => "[1]", "comment" => $Servicio["Servicio"], "discount" => floatval($Servicio["Descuento"]));

                            array_push($details,$detail);
                        }

                        //documentTypeId de Factura para Demo
                        // "documentTypeId"    => 82

                        //documentTypeId de Factura para Producción
                        // "documentTypeId"    => 5

                        $array = array(
                            // "documentTypeId"     => 5,
                            "documentTypeId"    => 82,
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
                        $FacturaBsale = json_decode($response, true);
                        $UrlPdf = isset($FacturaBsale['urlPublicViewOriginal']) ? trim($FacturaBsale['urlPublicViewOriginal']) : "";

                        if($UrlPdf){

                            //Para actualizar los datos del servicios con los datos de Bsale

                            $DocumentoId = $FacturaBsale['id'];
                            $informedSii = $FacturaBsale['informedSii'];
                            $responseMsgSii = $FacturaBsale['responseMsgSii'];
                            $Hoy = new DateTime(); 
                            $Hoy = $Hoy->format('Y-m-d H:i:s');

                            if($Tipo == 2){

                                $query = "UPDATE `facturas` set `DocumentoIdBsale` = '$DocumentoId', `UrlPdfBsale` = '$UrlPdf', `informedSiiBsale` = '$informedSii', `responseMsgSiiBsale` = '$responseMsgSii', `EstatusFacturacion` = '1', `FechaFacturacion` = '$Hoy', `HoraFacturacion` = '$Hoy' where `Id` = '$RutId'";
                                $data = $run->update($query);

                            }else{

                                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion) VALUES ('$Rut', '$Grupo', '3', '1', '$DocumentoId', '$UrlPdf', '$informedSii', '$responseMsgSii', '$Hoy', '$Hoy')";
                                $FacturaId = $run->insert($query);

                                foreach($Servicios as $Servicio){

                                    $IdServicio = $Servicio['Id'];
                                    $Valor = $Servicio['Valor'];
                                    $Descuento = $Servicio['Descuento'];
                                    $TipoMoneda = $Servicio['TipoMoneda'];

                                    $query = "INSERT INTO facturas_detalle(FacturaId, IdServicio, Valor, Descuento, TipoMoneda) VALUES ('$FacturaId', '$IdServicio', '$Valor', '$Descuento', '$TipoMoneda')";
                                    $data = $run->insert($query);

                                    if($data){
                                        $query = "UPDATE `servicios` set `EstatusFacturacion` = '1' where `Id` = '$IdServicio'";
                                        $data = $run->update($query);
                                    }
                                }
                            }

                            $response_array['UrlPdf'] = $UrlPdf;
                            $response_array['status'] = 1; 

                        }else{
                            $response_array['Message'] = $FacturaBsale['error'];
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
                $Facturas = array();

                if($Hoy > $FechaComprobacion){

                    $query = "SELECT servicios.*, mantenedor_servicios.servicio as Servicio FROM servicios LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio";
                    $Servicios = $run->select($query);

                    foreach($Servicios as $Servicio){

                        $Rut = $Servicio['Rut'];
                        $Grupo = $Servicio['Grupo'];

                        if(isset($Facturas[$Rut.'-'.$Grupo])){
                            $FacturaId = $Facturas[$Rut.'-'.$Grupo];
                        }else{
                            $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion) VALUES ('$Rut', '$Grupo', '2', '0', '0', '', '0', '', '$Hoy', '$Hoy')";
                            $FacturaId = $run->insert($query);
                        }

                        $IdServicio = $Servicio['Id'];
                        $Valor = $Servicio['Valor'];
                        $Descuento = $Servicio['Descuento'];
                        $TipoMoneda = $Servicio['TipoMoneda'];
                        $Hoy = new DateTime(); 
                        $Hoy = $Hoy->format('Y-m-d H:i:s');

                        $query = "INSERT INTO facturas_detalle(FacturaId, IdServicio, Valor, Descuento, TipoMoneda) VALUES ('$FacturaId', '$IdServicio', '$Valor', '$Descuento', '$TipoMoneda')";
                        $data = $run->insert($query);
                        $Facturas[$Rut.'-'.$Grupo] = $FacturaId;
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