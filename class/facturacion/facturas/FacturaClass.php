<?php

    include('../../../class/methods_global/methods.php');
    include("../../../class/facturacion/uf/UfClass.php");
    header('Content-type: application/json');

    class Factura{

    	public function showServicios(){  

            $run = new Method;

            $UfClass = new Uf(); 
            $Fecha = date('d-m-Y');
            $UF = $UfClass->getValue($Fecha);

            $ToReturn = array();

            $query = '  SELECT servicios.Rut, servicios.Grupo, servicios.CostoInstalacion as Valor, servicios.CostoInstalacionTipoMoneda as TipoMoneda, servicios.EstatusFacturacion, servicios.FechaFacturacion, personaempresa.nombre as Cliente 
                        FROM servicios 
                        INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut 
                        WHERE servicios.EstatusFacturacion = 0 
                        AND servicios.CostoInstalacion > 0 
                        AND (servicios.Estatus = 1 OR servicios.FacturarSinInstalacion = 1)';

            $servicios = $run->select($query);

            if($servicios){
                foreach($servicios as $servicio){

                    $data = array();
                    $data['Rut'] = $servicio['Rut'];          
                    $data['Grupo'] = $servicio['Grupo'];   
                    $data['Valor'] = $servicio['Valor'];   
                    $data['TipoMoneda'] = $servicio['TipoMoneda'];     
                    $data['Cliente'] = $servicio['Cliente'];  
                    $data['FechaFacturacion'] = $servicio['FechaFacturacion'];           
                    $data['UrlPdfBsale'] = ''; 
                    $data['Tipo'] = 1;
                    $TipoMoneda = $servicio['TipoMoneda'];
                    $Valor = $servicio['Valor'];

                    if($TipoMoneda == 'UF'){
                        $data['ValorUF'] = number_format($Valor, 2);
                        $Valor = $Valor * $UF;
                        $data['ValorPesos'] = number_format($Valor, 2);

                    }else{
                        $data['ValorPesos'] = number_format($Valor, 2);
                        $Valor = $Valor / $UF;
                        $data['ValorUF'] = number_format($Valor, 2);
                    }
                    array_push($ToReturn,$data);
                }
            }

            $query = "  SELECT    facturas_detalle.*, facturas.Id, facturas.Rut, facturas.Grupo, facturas.UrlPdfBsale, facturas.FechaFacturacion, personaempresa.nombre as Cliente 
                        FROM facturas_detalle 
                        INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        WHERE facturas.TipoFactura = '3'";

            $facturas = $run->select($query);

            if($facturas){

                foreach($facturas as $factura){

                    $data = array();
                    $data['Rut'] = $factura['Rut'];          
                    $data['Grupo'] = $factura['Grupo'];   
                    $data['Valor'] = $factura['Valor'];   
                    $data['TipoMoneda'] = $factura['TipoMoneda'];   
                    $data['Cliente'] = $factura['Cliente'];   
                    $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
                    $data['FechaFacturacion'] = $factura['FechaFacturacion'];    
                    $data['Tipo'] = 2;
                    $TipoMoneda = $factura['TipoMoneda'];
                    $Valor = $factura['Valor'];

                    if(!$factura['UrlPdfBsale']){
                        $TipoMoneda = $factura['TipoMoneda'];
                        if($TipoMoneda == 'UF'){
                            $data['ValorUF'] = number_format($Valor, 2);
                            $Valor = $Valor * $UF;
                            $data['ValorPesos'] = number_format($Valor, 2);

                        }else{
                            $data['ValorPesos'] = number_format($Valor, 2);
                            $Valor = $Valor / $UF;
                            $data['ValorUF'] = number_format($Valor, 2);
                        }
                    }else{
                        $data['ValorPesos'] = number_format($factura['ValorPesos'], 2);
                        $data['ValorUF'] = number_format($factura['ValorUF'], 2);
                    }
                    array_push($ToReturn,$data);
                }
            }

            $response_array['array'] = $ToReturn;

            echo json_encode($response_array);
    	}

        public function showFacturas(){

            $run = new Method;

            $UfClass = new Uf(); 
            $Fecha = date('d-m-Y');
            $UF = $UfClass->getValue($Fecha);

            $query = "  SELECT    facturas_detalle.*, facturas.Id, facturas.Rut, facturas.Grupo, facturas.UrlPdfBsale, facturas.EstatusFacturacion, facturas.FechaFacturacion, personaempresa.nombre as Cliente 
                        FROM facturas_detalle 
                        INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        WHERE facturas_detalle.Valor > 0
                        AND facturas.TipoFactura = '2'";

            $facturas = $run->select($query);

            $ToReturn = array();

            if($facturas){

                foreach($facturas as $factura){

                    $data = array();
                    $data['Rut'] = $factura['Rut'];          
                    $data['Grupo'] = $factura['Grupo'];   
                    $data['Valor'] = $factura['Valor'];   
                    $data['TipoMoneda'] = $factura['TipoMoneda'];   
                    $data['Cliente'] = $factura['Cliente'];   
                    $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
                    $data['EstatusFacturacion'] = $factura['EstatusFacturacion'];
                    $data['FechaFacturacion'] = $factura['FechaFacturacion'];    
                    $Valor = $factura['Valor'];
                    if(!$factura['UrlPdfBsale']){
                        $TipoMoneda = $factura['TipoMoneda'];
                        if($TipoMoneda == 'UF'){
                            $data['ValorUF'] = number_format($Valor, 2);
                            $Valor = $Valor * $UF;
                            $data['ValorPesos'] = number_format($Valor, 2);

                        }else{
                            $data['ValorPesos'] = number_format($Valor, 2);
                            $Valor = $Valor / $UF;
                            $data['ValorUF'] = number_format($Valor, 2);
                        }
                    }else{
                        $data['ValorPesos'] = number_format($factura['ValorPesos'], 2);
                        $data['ValorUF'] = number_format($factura['ValorUF'], 2);
                    }

                    array_push($ToReturn,$data);
                }
            }

            $response_array['array'] = $ToReturn;

            echo json_encode($response_array);
        }

        public function showServicio($Rut, $Grupo){            

            $run = new Method;

            $UfClass = new Uf(); 
            $Fecha = date('d-m-Y');
            $UF = $UfClass->getValue($Fecha);

            $query = "  SELECT servicios.Id, servicios.Codigo, servicios.CostoInstalacion as Valor, servicios.CostoInstalacionTipoMoneda as TipoMoneda, mantenedor_servicios.servicio as Nombre, mantenedor_tipo_factura.descripcion as Descripcion
                        FROM servicios 
                        LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
                        LEFT JOIN mantenedor_tipo_factura ON mantenedor_tipo_factura.codigo = servicios.TipoFactura 
                        WHERE servicios.Rut = '".$Rut."' AND servicios.Grupo = '".$Grupo."' AND (servicios.Estatus = 1 OR servicios.FacturarSinInstalacion = 1)";

            $servicios = $run->select($query);
            $data = array();

            if($servicios){
                foreach($servicios as $servicio){

                    $Index = $servicio['Id'];
                    $data[$Index] = $servicio;

                    $TipoMoneda = $servicio['TipoMoneda'];

                    if($TipoMoneda == 'UF'){

                        $ValorUF = $servicio['Valor'];
                        $ValorTotal = number_format($ValorUF, 2);
                        $data[$Index]['ValorUF'] = $ValorTotal;

                        $ValorPesos = $ValorUF * $UF;
                        $ValorTotal = number_format($ValorPesos, 2);
                        $data[$Index]['ValorPesos'] = $ValorTotal;

                    }else{

                        $ValorPesos = $servicio['Valor'];
                        $ValorTotal = number_format($ValorPesos, 2);
                        $data[$Index]['ValorPesos'] = $ValorTotal;

                        $ValorUF = $ValorPesos / $UF;
                        $ValorTotal = number_format($ValorUF, 2);
                        $data[$Index]['ValorUF'] = $ValorTotal;

                    }

                }

                $response_array['array'] = $data;

                echo json_encode($response_array);
            }
        }

        public function showFactura($Id){            

            $run = new Method;

            $UfClass = new Uf(); 
            $Fecha = date('d-m-Y');
            $UF = $UfClass->getValue($Fecha);

            $query = "  SELECT  *
                        FROM facturas_detalle 
                        INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                        INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut
                        WHERE facturas.Id = '".$Id."'";

            $servicios = $run->select($query);
            $data = array();

            if($servicios){
                foreach($servicios as $servicio){

                    $Index = $servicio['Id'];
                    $data[$Index] = $servicio;

                    $TipoMoneda = $servicio['TipoMoneda'];
                    $Valor = $servicio['Valor'];

                    if(!$factura['UrlPdfBsale']){
                        if($TipoMoneda == 'UF'){
                            $data[$Index]['ValorUF'] = number_format($Valor, 2);
                            $Valor = $Valor * $UF;
                            $data[$Index]['ValorPesos'] = number_format($Valor, 2);

                        }else{
                            $data[$Index]['ValorPesos'] = number_format($Valor, 2);
                            $Valor = $Valor / $UF;
                            $data[$Index]['ValorUF'] = number_format($Valor, 2);
                        }
                    }else{
                        $data[$Index]['ValorPesos'] = number_format($factura['ValorPesos'], 2);
                        $data[$Index]['ValorUF'] = number_format($factura['ValorUF'], 2);
                    }
                }

                $response_array['array'] = $data;

                echo json_encode($response_array);
            }
        }

        public function storeFactura($RutId, $Grupo, $Tipo){

            if(in_array  ('curl', get_loaded_extensions())) {

                $response_array = array();

                //Demo
                $access_token='b6ae44d94c240baa08b9fb48aa4333aa712cf3c2';
                //Producción
                // $access_token='957d3b3419bacf7dbd0dd528172073c9903d618b';

                if($Tipo == 2){
                    $query = "  SELECT facturas_detalle.*, facturas.FechaFacturacion, facturas.Rut 
                                FROM facturas_detalle 
                                INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                                WHERE facturas.Id = '".$RutId."'";
                    $expirationDate = time() + 1728000;
                }else{
                    $query = "  SELECT servicios.*, servicios.CostoInstalacion as Valor, servicios.CostoInstalacionTipoMoneda as TipoMoneda, servicios.CostoInstalacionDescuento as Descuento, mantenedor_servicios.servicio as Servicio 
                                FROM servicios 
                                LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
                                WHERE servicios.Rut = '".$RutId."' AND servicios.Grupo = '".$Grupo."'";
                    $expirationDate = time() + 604800;
                }

                $run = new Method;
                $Servicios = $run->select($query);
                $Fecha = date('d-m-Y');
                $UfClass = new Uf(); 
                $UF = $UfClass->getValue($Fecha);

                if($Servicios){

                    $Servicio = $Servicios[0];
                    $Rut = $Servicio['Rut'];

                    $query = "SELECT * FROM personaempresa WHERE rut = '".$Rut."'";
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
                                $Valor = floatval($Servicio['Valor']) * floatval($UF);
                                $ValorUF = $Servicio['Valor'];
                                $ValorPesos = $Valor;
                            }else{
                                $Valor = floatval($Servicio['Valor']);
                                $ValorUF = $Valor / $UF;
                                $ValorPesos = $Valor;
                            }

                            if($Tipo == 2){

                                $Concepto = $Servicio["Servicio"] . ' - ' . $Servicio["Descuento"].'% Descuento';

                            }else{
                                if($Valor > 0){
                                    $Concepto = 'Costo de instalación / Habilitación'. ' - ' . $Servicio["Descuento"].'% Descuento';
                                }else{
                                    continue;
                                }
                            }

                            $detail = array("netUnitValue" => $Valor, "quantity" => 1, "taxId" => "[1]", "comment" => $Concepto, "discount" => floatval($Servicio["Descuento"]));

                            array_push($details,$detail);
                        }

                        //FACTURA

                        //Demo
                        // "documentTypeId"    => 82

                        //Producción
                        // "documentTypeId"    => 5

                        //BOLETA

                        //Demo
                        // "documentTypeId"    => 26

                        //Producción
                        // "documentTypeId"    => 22

                        if($cliente['tipo_cliente'] == "Factura"){
                            if($access_token == "b6ae44d94c240baa08b9fb48aa4333aa712cf3c2"){
                                $documentTypeId = 82;
                            }else{
                                $documentTypeId = 5;
                            }
                        }else{
                            if($access_token == "b6ae44d94c240baa08b9fb48aa4333aa712cf3c2"){
                                $documentTypeId = 26;
                            }else{
                                $documentTypeId = 22;
                            }
                        }

                        $array = array(
                            "documentTypeId"    => $documentTypeId,
                            // "priceListId"       => 18,
                            "emissionDate"      => time(),
                            "expirationDate"    => $expirationDate,
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

                            if($Tipo == 2){

                                $query = "UPDATE facturas SET DocumentoIdBsale = '".$DocumentoId."', UrlPdfBsale = '".$UrlPdf."', informedSiiBsale = '".$informedSii."', responseMsgSiiBsale = '".$responseMsgSii."', EstatusFacturacion = '1', FechaFacturacion = NOW(), HoraFacturacion = NOW() WHERE Id = '".$RutId."'";
                                $data = $run->update($query);

                                if($data){
                                    $response_array['Id'] = $RutId;
                                    $response_array['UrlPdf'] = $UrlPdf;
                                    $response_array['status'] = 1; 
                                }

                            }else{

                                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion) VALUES ('".$Rut."', '".$Grupo."', '3', '1', '".$DocumentoId."', '".$UrlPdf."', '".$informedSii."', '".$responseMsgSii."', NOW(), NOW())";
                                $FacturaId = $run->insert($query);

                                if($FacturaId){

                                    foreach($Servicios as $Servicio){

                                        $IdServicio = $Servicio['Id'];

                                        if($Tipo == 2){
                                            $Concepto = $Servicio['Servicio'];
                                        }else{
                                            $Concepto = 'Costo de instalación / Habilitación';
                                        }

                                        $Valor = $Servicio['Valor'];
                                        $Descuento = $Servicio['Descuento'];
                                        $TipoMoneda = $Servicio['TipoMoneda'];

                                        $query = "INSERT INTO facturas_detalle(FacturaId, Servicio, Valor, Descuento, TipoMoneda, ValorUF, ValorPesos) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Descuento."', '".$TipoMoneda."','".$ValorUF."', '".$ValorPesos."')";
                                        $FacturaDetalleId = $run->insert($query);

                                        if($FacturaDetalleId){
                                            $query = "UPDATE servicios SET EstatusFacturacion = '1', FechaFacturacion = NOW() WHERE Id = '".$IdServicio."'";
                                            $update = $run->update($query);
                                        }else{
                                            $query = "DELETE FROM facturas WHERE Id = '".$FacturaId."'";
                                            $delete = $run->delete($query);
                                            $query = "DELETE FROM facturas_detalle WHERE FacturaId = '".$FacturaId."'";
                                            $delete = $run->delete($query);
                                            $response_array['Message'] = 'Error Detalle';
                                            $response_array['status'] = 0;
                                            break;
                                        }
                                    }

                                    $response_array['Id'] = $RutId;
                                    $response_array['UrlPdf'] = $UrlPdf;
                                    $response_array['status'] = 1; 

                                }else{
                                    $response_array['Message'] = 'Error Factura';
                                    $response_array['status'] = 0;
                                }
                            }
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

        public function storeFacturaPorLote($Facturas){

            if(in_array  ('curl', get_loaded_extensions())) {

                $response_array = array();

                //Demo
                $access_token='b6ae44d94c240baa08b9fb48aa4333aa712cf3c2';
                //Producción
                // $access_token='957d3b3419bacf7dbd0dd528172073c9903d618b';

                $Facturas = explode(",", $Facturas);
                $Fecha = date('d-m-Y');
                $UfClass = new Uf(); 
                $UF = $UfClass->getValue($Fecha);
                $expirationDate = time() + 1728000;

                foreach($Facturas as $Factura){

                    if($Factura){

                        $response_array['Facturas'][$Factura] = array();

                        $query = "  SELECT facturas_detalle.*, facturas.FechaFacturacion, facturas.Rut 
                                    FROM facturas_detalle 
                                    INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                                    WHERE facturas.Id = '".$Factura."'";


                        $run = new Method;
                        $Servicios = $run->select($query);

                        if($Servicios){
                            $Servicio = $Servicios[0];
                            $Rut = $Servicio['Rut'];

                            $query = "SELECT * FROM personaempresa WHERE rut = '".$Rut."'";
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
                                        $Valor = floatval($Servicio['Valor']) * floatval($UF);
                                    }else{
                                        $Valor = floatval($Servicio['Valor']);
                                    }

                                    $Concepto = $Servicio["Servicio"] . ' - ' . $Servicio["Descuento"].'% Descuento';

                                    $detail = array("netUnitValue" => $Valor, "quantity" => 1, "taxId" => "[1]", "comment" => $Concepto, "discount" => floatval($Servicio["Descuento"]));

                                    array_push($details,$detail);
                                }

                                //FACTURA

                                //Demo
                                // "documentTypeId"    => 82

                                //Producción
                                // "documentTypeId"    => 5

                                //BOLETA

                                //Demo
                                // "documentTypeId"    => 26

                                //Producción
                                // "documentTypeId"    => 22

                                if($cliente['tipo_cliente'] == "Factura"){
                                    if($access_token == "b6ae44d94c240baa08b9fb48aa4333aa712cf3c2"){
                                        $documentTypeId = 82;
                                    }else{
                                        $documentTypeId = 5;
                                    }
                                }else{
                                    if($access_token == "b6ae44d94c240baa08b9fb48aa4333aa712cf3c2"){
                                        $documentTypeId = 26;
                                    }else{
                                        $documentTypeId = 22;
                                    }
                                }

                                $array = array(
                                    "documentTypeId"    => $documentTypeId,
                                    // "priceListId"       => 18,
                                    "emissionDate"      => time(),
                                    "expirationDate"    => $expirationDate,
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

                                    $query = "UPDATE facturas SET DocumentoIdBsale = '".$DocumentoId."', UrlPdfBsale = '".$UrlPdf."', informedSiiBsale = '".$informedSii."', responseMsgSiiBsale = '".$responseMsgSii."', EstatusFacturacion = '1', FechaFacturacion = NOW(), HoraFacturacion = NOW() WHERE Id = '".$Factura."'";
                                    $data = $run->update($query);

                                    $response_array['Facturas'][$Factura]['Id'] = $Factura;
                                    $response_array['Facturas'][$Factura]['UrlPdf'] = $UrlPdf;
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
                    }
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
                $dt = new DateTime(); 
                $Mes = $dt->format('m');
                $Hoy = $dt->format('Y-m-d');
                $Facturas = array();

                if($Hoy > $FechaComprobacion){

                    switch ($Mes) {
                        case 1:
                            $MesFacturacion = "Enero";
                            break;
                        case 2:
                            $MesFacturacion = "Febrero";
                            break;
                        case 3:
                            $MesFacturacion = "Marzo";
                            break;
                        case 4:
                            $MesFacturacion = "Abril";
                            break;
                        case 5:
                            $MesFacturacion = "Mayo";
                            break;
                        case 6:
                            $MesFacturacion = "Junio";
                            break;
                        case 7:
                            $MesFacturacion = "Julio";
                            break;
                        case 8:
                            $MesFacturacion = "Agosto";
                            break;
                        case 9:
                            $MesFacturacion = "Septiembre";
                            break;
                        case 10:
                            $MesFacturacion = "Octubre";
                            break;
                        case 11:
                            $MesFacturacion = "Noviembre";
                            break;
                        case 12:
                            $MesFacturacion = "Diciembre";
                            break;
                    }

                    $query = "  SELECT servicios.*, mantenedor_servicios.servicio as Servicio 
                                FROM servicios 
                                LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio";
                    $Servicios = $run->select($query);

                    foreach($Servicios as $Servicio){

                        $Rut = $Servicio['Rut'];
                        $Grupo = $Servicio['Grupo'];

                        if(isset($Facturas[$Rut.'-'.$Grupo])){
                            $FacturaId = $Facturas[$Rut.'-'.$Grupo];
                        }else{
                            $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion) VALUES ('".$Rut."', '".$Grupo."', '2', '0', '0', '', '0', '', NOW(), NOW())";
                            $FacturaId = $run->insert($query);
                        }

                        $Concepto = $Servicio['Servicio'];
                        $Concepto .= ' - Mes ' . $MesFacturacion;
                        $Valor = $Servicio['Valor'];
                        $Descuento = $Servicio['Descuento'];
                        $TipoMoneda = $Servicio['TipoMoneda'];
                        $Hoy = new DateTime(); 
                        $Hoy = $Hoy->format('Y-m-d H:i:s');

                        $query = "INSERT INTO facturas_detalle(FacturaId, Servicio, Valor, Descuento, TipoMoneda) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Descuento."', '".$TipoMoneda."')";
                        $data = $run->insert($query);
                        $Facturas[$Rut.'-'.$Grupo] = $FacturaId;
                    }

                    $FechaComprobacion = date('Y-m-d', strtotime('first day of next month'));
                    $query = "UPDATE `variables_globales` set `fecha_comprobacion` = '".$FechaComprobacion."'";
                    $update = $run->update($query);
                }
            }

            $response_array['status'] = 1; 

            echo json_encode($response_array);

        }
    }
?>