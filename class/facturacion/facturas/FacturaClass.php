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

            $query = '  SELECT 
                            servicios.Rut, servicios.Grupo, SUM(servicios.CostoInstalacion) as Valor, servicios.EstatusFacturacion, servicios.FechaFacturacion, personaempresa.nombre as Cliente, personaempresa.tipo_cliente as TipoDocumento, COALESCE ( grupo_servicio.Nombre, servicios.Grupo ) AS NombreGrupo
                        FROM servicios 
                        INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut 
                        LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = servicios.Grupo 
                        WHERE servicios.EstatusFacturacion = 0 
                        AND servicios.CostoInstalacion > 0 
                        AND (servicios.Estatus = 1 OR servicios.FacturarSinInstalacion = 1)
                        GROUP BY 
                            servicios.Rut,
                            servicios.Grupo,
				            servicios.FechaFacturacion';

            $servicios = $run->select($query);

            if($servicios){
                foreach($servicios as $servicio){

                    $data = array();
                    $data['Id'] = $servicio['Rut']; 
                    $data['Rut'] = $servicio['Rut'];          
                    $data['Grupo'] = $servicio['Grupo'];   
                    $data['Valor'] = $servicio['Valor'];      
                    $data['Cliente'] = $servicio['Cliente'];  
                    $data['FechaFacturacion'] = $servicio['FechaFacturacion'];           
                    $data['UrlPdfBsale'] = ''; 
                    $data['Tipo'] = 1;
                    $Valor = $servicio['Valor'];
                    $Valor = $Valor * $UF;
                    $data['Valor'] = number_format($Valor, 2);  
                    $data['EstatusFacturacion'] = 0;
                    $data['TipoDocumento'] = $servicio['TipoDocumento']; 
                    $data['NombreGrupo'] = $servicio['NombreGrupo'];

                    array_push($ToReturn,$data);
                }
            }

            $query = "  SELECT    SUM(facturas_detalle.Valor) as Valor, facturas.Id, facturas.Rut, facturas.Grupo, facturas.UrlPdfBsale, facturas.FechaFacturacion, facturas.TipoDocumento, personaempresa.nombre as Cliente, COALESCE ( grupo_servicio.Nombre, facturas.Grupo ) AS NombreGrupo
                        FROM facturas_detalle 
                        INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = facturas.Grupo 
                        WHERE facturas.TipoFactura = '3'
                        AND facturas_detalle.Valor > 0
                        GROUP BY
                            facturas.Id";

            $facturas = $run->select($query);

            if($facturas){

                foreach($facturas as $factura){

                    $data = array();
                    $data['Id'] = $factura['Id']; 
                    $data['Rut'] = $factura['Rut'];          
                    $data['Grupo'] = $factura['Grupo'];
                    $data['Valor'] = $factura['Valor'];   
                    $data['Cliente'] = $factura['Cliente'];   
                    $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
                    $data['FechaFacturacion'] = $factura['FechaFacturacion'];    
                    $data['Tipo'] = 2;
                    $data['Valor'] = number_format($factura['Valor'], 2);
                    $data['EstatusFacturacion'] = 1; 
                    $data['TipoDocumento'] = $factura['TipoDocumento']; 
                    $data['NombreGrupo'] = $factura['NombreGrupo'];
                   
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
            $ToReturn = array();

            $query = "  SELECT    SUM(facturas_detalle.Valor) as Valor, facturas.Id, facturas.Rut, facturas.Grupo, facturas.UrlPdfBsale, facturas.EstatusFacturacion, facturas.FechaFacturacion, facturas.TipoDocumento, personaempresa.nombre as Cliente, COALESCE ( grupo_servicio.Nombre, facturas.Grupo ) AS NombreGrupo 
                        FROM facturas_detalle 
                        INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = facturas.Grupo 
                        WHERE facturas_detalle.Valor > 0
                        AND facturas.TipoFactura = '2'
                        AND facturas.EstatusFacturacion = '1'
                        GROUP BY
                            facturas.Id";

            $facturas = $run->select($query);

            if($facturas){

                foreach($facturas as $factura){

                    $data = array();
                    $data['Id'] = $factura['Id'];  
                    $data['Rut'] = $factura['Rut'];          
                    $data['Grupo'] = $factura['Grupo'];   
                    $data['Valor'] = $factura['Valor'];    
                    $data['Cliente'] = $factura['Cliente'];   
                    $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
                    $data['EstatusFacturacion'] = $factura['EstatusFacturacion'];
                    $data['FechaFacturacion'] = $factura['FechaFacturacion'];    
                    $data['Valor'] = number_format($factura['Valor'], 2);
                    $data['EstatusFacturacion'] = 1; 
                    $data['TipoDocumento'] = $factura['TipoDocumento'];
                    $data['NombreGrupo'] = $factura['NombreGrupo'];

                    array_push($ToReturn,$data);
                }
            }

            $query = "  SELECT    SUM(facturas_detalle.Valor) as Valor, facturas.Rut, facturas.Grupo, facturas.EstatusFacturacion, facturas.TipoDocumento, personaempresa.nombre as Cliente, COALESCE ( grupo_servicio.Nombre, facturas.Grupo ) AS NombreGrupo
                        FROM facturas_detalle 
                        INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = facturas.Grupo 
                        WHERE facturas_detalle.Valor > 0
                        AND facturas.TipoFactura = '2'
                        AND facturas.EstatusFacturacion = '0'
                        GROUP BY
                            facturas.Rut,
                            facturas.Grupo,
                            facturas.TipoDocumento";

            $facturas = $run->select($query);

            if($facturas){

                foreach($facturas as $factura){

                    $data = array();
                    $data['Id'] = $factura['Rut'];
                    $data['Rut'] = $factura['Rut'];          
                    $data['Grupo'] = $factura['Grupo'];   
                    $data['Valor'] = $factura['Valor'];    
                    $data['Cliente'] = $factura['Cliente'];   
                    $data['UrlPdfBsale'] = '';
                    $data['EstatusFacturacion'] = $factura['EstatusFacturacion'];
                    $data['FechaFacturacion'] = '';    
                    $data['Valor'] = number_format($factura['Valor'], 2);
                    $data['EstatusFacturacion'] = 0;
                    $data['TipoDocumento'] = $factura['TipoDocumento'];
                    $data['NombreGrupo'] = $factura['NombreGrupo'];

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

            $query = "  SELECT servicios.Id, servicios.Codigo, servicios.CostoInstalacion as Valor, mantenedor_servicios.servicio as Nombre, mantenedor_tipo_factura.descripcion as Descripcion
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

                    $Valor = $servicio['Valor'];
                    $Valor = $Valor * $UF;
                    $data[$Index]['Valor'] = number_format($Valor, 2);
                }

                $response_array['array'] = $data;

                echo json_encode($response_array);
            }
        }

        public function showFactura($Id,$Tipo){            

            $run = new Method;

            $UfClass = new Uf(); 
            $Fecha = date('d-m-Y');
            $UF = $UfClass->getValue($Fecha);
            $Explode = explode('-',$Id);

            $query = "  SELECT  facturas_detalle.Valor, personaempresa.nombre as Nombre, facturas_detalle.Servicio as Descripcion
                        FROM facturas_detalle 
                        INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        WHERE facturas.TipoFactura = '".$Tipo."'";
            if(isset($Explode[1])){
                $Rut = $Explode[0];
                $Grupo = $Explode[1];
                $query .= " AND facturas.Rut = '".$Rut."' AND facturas.Grupo = '".$Grupo."'";
            }else{
                $query .= " AND facturas.Id = '".$Id."'";
            }
                        
            $servicios = $run->select($query);
            $array = array();

            if($servicios){
                foreach($servicios as $servicio){
                    $data = array();
                    $data = $servicio;
                    $data['Valor'] = number_format($servicio['Valor'], 2);
                    array_push($array,$data);
                }

                $response_array['array'] = $array;

                echo json_encode($response_array);
            }
        }

        public function storeFactura($RutId, $Grupo, $Tipo){

            if(in_array  ('curl', get_loaded_extensions())) {

                $response_array = array();

                //NECESITO NUEVAS TOKENS

                //Demo
                // $access_token='b6ae44d94c240baa08b9fb48aa4333aa712cf3c2';
                //Producción
                // $access_token='957d3b3419bacf7dbd0dd528172073c9903d618b';

                if($Tipo == 2){
                    $query = "  SELECT facturas_detalle.*, facturas.FechaFacturacion, facturas.Rut 
                                FROM facturas_detalle 
                                INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                                WHERE facturas.Rut = '".$RutId."' AND facturas.Grupo = '".$Grupo."'
                                AND facturas.TipoFactura = '".$Tipo."'
                                AND facturas.EstatusFacturacion = 0
                                AND facturas_detalle.Valor > 0";
                    $expirationDate = time() + 1728000;
                }else{
                    $query = "  SELECT servicios.*, servicios.CostoInstalacion as Valor, servicios.CostoInstalacionDescuento as Descuento, mantenedor_servicios.servicio as Servicio 
                                FROM servicios 
                                LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
                                WHERE servicios.Rut = '".$RutId."' AND servicios.Grupo = '".$Grupo."'
                                AND servicios.EstatusFacturacion = 0
                                AND servicios.Valor > 0";
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
                        $TipoDocumento = $cliente['tipo_cliente'];

                        if(isset($access_token)){
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

                                if($Tipo == 2){
                                    $Concepto = $Servicio["Servicio"] . ' - ' . $Servicio["Descuento"].'% Descuento';
                                }else{
                                    $Concepto = 'Costo de instalación / Habilitación'. ' - ' . $Servicio["Descuento"].'% Descuento';
                                    $Valor = floatval($Servicio['Valor']) * $UF;
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
                            if(!$UrlPdf){
                                $DocumentoId = $FacturaBsale['id'];
                                $informedSii = $FacturaBsale['informedSii'];
                                $responseMsgSii = $FacturaBsale['responseMsgSii'];
                            }else{
                                $response_array['Message'] = $FacturaBsale['error'];
                                $response_array['status'] = 0;
                            }
                        }else{
                            $UrlPdf = '0';
                            $DocumentoId = '0';
                            $informedSii = '0';
                            $responseMsgSii = '0';
                        }

                        //Para actualizar los datos del servicios con los datos de Bsale

                        $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento) VALUES ('".$Rut."', '".$Grupo."', '".$Tipo."', '1', '".$DocumentoId."', '".$UrlPdf."', '".$informedSii."', '".$responseMsgSii."', NOW(), NOW(), '".$TipoDocumento."')";
                        $FacturaId = $run->insert($query);

                        if($FacturaId){
                            foreach($Servicios as $Servicio){

                                $IdServicio = $Servicio['Id'];
                                $Valor = floatval($Servicio['Valor']);

                                if($Tipo == 2){
                                    $Concepto = $Servicio["Servicio"] . ' - ' . $Servicio["Descuento"].'% Descuento';
                                }else{
                                    $Concepto = 'Costo de instalación / Habilitación'. ' - ' . $Servicio["Descuento"].'% Descuento';
                                    $Valor = $Valor * $UF;
                                }
                                $Descuento = $Servicio['Descuento'];

                                $query = "INSERT INTO facturas_detalle(FacturaId, Servicio, Valor, Descuento) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Descuento."')";
                                $FacturaDetalleId = $run->insert($query);
                                if($Tipo == 3){
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
                            }

                            if($Tipo == 2){
                                $query = "SELECT Id FROM facturas WHERE Rut = '".$RutId."' AND Grupo = '".$Grupo."' AND EstatusFacturacion = 0";
                                $facturas = $run->select($query);
                                foreach($facturas as $factura){
                                    $DeleteId = $factura['Id'];
                                    $query = "DELETE FROM facturas_detalle WHERE FacturaId = '".$DeleteId."'";
                                    $delete = $run->delete($query);
                                    $query = "DELETE FROM facturas WHERE Id = '".$DeleteId."'";
                                    $delete = $run->delete($query);
                                }
                            }

                            $response_array['Id'] = $RutId;
                            $response_array['UrlPdf'] = $UrlPdf;
                            $response_array['status'] = 1; 

                        }else{
                            $response_array['Message'] = 'Error Factura';
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
                // $access_token='b6ae44d94c240baa08b9fb48aa4333aa712cf3c2';
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
                        $RutGrupo = explode("-", $Factura);
                        $Rut = $RutGrupo[0];
                        $Grupo = $RutGrupo[1];

                        $query = "  SELECT facturas_detalle.*, facturas.FechaFacturacion, facturas.Rut 
                                FROM facturas_detalle 
                                INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                                WHERE facturas.Rut = '".$Rut."' AND facturas.Grupo = '".$Grupo."'
                                AND facturas.TipoFactura = '2'
                                AND facturas.EstatusFacturacion = 0
                                AND facturas_detalle.Valor > 0";

                        $run = new Method;
                        $Servicios = $run->select($query);

                        if($Servicios){
                            $Servicio = $Servicios[0];
                            $Rut = $Servicio['Rut'];

                            $query = "SELECT * FROM personaempresa WHERE rut = '".$Rut."'";
                            $cliente = $run->select($query);

                            if($cliente){

                                $cliente = $cliente[0];
                                $TipoDocumento = $cliente['tipo_cliente'];

                                if(isset($access_token)){
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
                                    if(!$UrlPdf){
                                        $DocumentoId = $FacturaBsale['id'];
                                        $informedSii = $FacturaBsale['informedSii'];
                                        $responseMsgSii = $FacturaBsale['responseMsgSii'];
                                    }else{
                                        $response_array['Message'] = $FacturaBsale['error'];
                                        $response_array['status'] = 0;
                                    }
                                }else{
                                    $UrlPdf = '0';
                                    $DocumentoId = '0';
                                    $informedSii = '0';
                                    $responseMsgSii = '0';
                                }

                                //Para actualizar los datos del servicios con los datos de Bsale

                                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento) VALUES ('".$Rut."', '".$Grupo."', '2', '1', '".$DocumentoId."', '".$UrlPdf."', '".$informedSii."', '".$responseMsgSii."', NOW(), NOW(), '".$TipoDocumento."')";
                                $FacturaId = $run->insert($query);

                                if($FacturaId){
                                    foreach($Servicios as $Servicio){

                                        $IdServicio = $Servicio['Id'];
                                        $Valor = floatval($Servicio['Valor']);
                                        $Concepto = $Servicio["Servicio"] . ' - ' . $Servicio["Descuento"].'% Descuento';
                                        $Descuento = $Servicio['Descuento'];

                                        $query = "INSERT INTO facturas_detalle(FacturaId, Servicio, Valor, Descuento) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Descuento."')";
                                        $FacturaDetalleId = $run->insert($query);
                                    }

                                    $response_array['Facturas'][$Factura]['Rut'] = $Rut;
                                    $response_array['Facturas'][$Factura]['Grupo'] = $Grupo;
                                    $response_array['Facturas'][$Factura]['UrlPdf'] = $UrlPdf;
                                    $response_array['status'] = 1; 

                                    $query = "SELECT Id FROM facturas WHERE Rut = '".$Rut."' AND Grupo = '".$Grupo."' AND EstatusFacturacion = 0";
                                    $pagadas = $run->select($query);
                                    foreach($pagadas as $pagada){
                                        $DeleteId = $pagada['Id'];
                                        $query = "DELETE FROM facturas_detalle WHERE FacturaId = '".$DeleteId."'";
                                        $delete = $run->delete($query);
                                        $query = "DELETE FROM facturas WHERE Id = '".$DeleteId."'";
                                        $delete = $run->delete($query);
                                    }
                                }else{
                                    $response_array['Message'] = 'Error Factura';
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

                    $query = "  SELECT servicios.*, mantenedor_servicios.servicio as Servicio, personaempresa.tipo_cliente
                                FROM servicios 
                                INNER JOIN personaempresa ON servicios.Rut = personaempresa.rut
                                LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio";
                    $Servicios = $run->select($query);

                    if($Servicios){
                        $UfClass = new Uf(); 
                        $Fecha = date('d-m-Y');
                        $UF = $UfClass->getValue($Fecha);
                        
                        foreach($Servicios as $Servicio){

                            $Rut = $Servicio['Rut'];
                            $Grupo = $Servicio['Grupo'];

                            if(isset($Facturas[$Rut.'-'.$Grupo])){
                                $FacturaId = $Facturas[$Rut.'-'.$Grupo];
                            }else{
                                $TipoDocumento = $Servicio['tipo_cliente'];
                                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento) VALUES ('".$Rut."', '".$Grupo."', '2', '0', '0', '', '0', '', NOW(), NOW(), '".$TipoDocumento."')";
                                $FacturaId = $run->insert($query);
                            }

                            $Concepto = $Servicio['Servicio'];
                            $Concepto .= ' - Mes ' . $MesFacturacion;
                            $Valor = $Servicio['Valor'];
                            $Valor = $Valor * $UF;
                            $Descuento = $Servicio['Descuento'];
                            $Hoy = new DateTime(); 
                            $Hoy = $Hoy->format('Y-m-d H:i:s');

                            $query = "INSERT INTO facturas_detalle(FacturaId, Servicio, Valor, Descuento) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Descuento."')";
                            $data = $run->insert($query);
                            $Facturas[$Rut.'-'.$Grupo] = $FacturaId;
                        }
                    }

                    $FechaComprobacion = date('Y-m-d', strtotime('first day of next month'));
                    $query = "UPDATE `variables_globales` set `fecha_comprobacion` = '".$FechaComprobacion."'";
                    $update = $run->update($query);
                }
            }

            $response_array['status'] = 1; 

            echo json_encode($response_array);

        }
        public function getTotales(){
            $run = new Method;
            $UfClass = new Uf(); 
            $Fecha = date('d-m-Y');
            $UF = $UfClass->getValue($Fecha);
            $totalBoletas = 0;
            $totalFacturas = 0;
            $cantidadBoletas = 0;
            $cantidadFacturas = 0;

            $query = "  SELECT    
                            facturas.TipoDocumento, SUM(facturas_detalle.Valor) as Valor, COUNT(facturas.Id) as Cantidad
                        FROM 
                            facturas_detalle 
                        INNER JOIN 
                            facturas 
                        ON 
                            facturas_detalle.FacturaId = facturas.Id 
                        GROUP BY
                            facturas.TipoDocumento";
            $facturas = $run->select($query);
            foreach($facturas as $factura){
                if($factura['TipoDocumento'] == 'Factura'){
                    $totalFacturas += $factura['Valor'];
                    $cantidadFacturas += $factura['Cantidad'];
                }else{
                    $totalBoletas += $factura['Valor'];
                    $cantidadBoletas += $factura['Cantidad'];
                }
            }

            $query = "  SELECT 
                            personaempresa.tipo_cliente as TipoDocumento, SUM(servicios.CostoInstalacion) * '".$UF."' as Valor, COUNT(servicios.Id) as Cantidad
                        FROM 
                            servicios 
                        INNER JOIN 
                            personaempresa 
                        ON 
                            personaempresa.rut = servicios.Rut 
                        WHERE 
                            servicios.EstatusFacturacion = 0 
                        AND 
                            servicios.CostoInstalacion > 0 
                        AND 
                            (servicios.Estatus = 1 OR servicios.FacturarSinInstalacion = 1)
                        GROUP BY
                            personaempresa.tipo_cliente";
            $servicios = $run->select($query);
            foreach($servicios as $servicio){
                if($servicio['TipoDocumento'] == 'Factura'){
                    $totalFacturas += $servicio['Valor'];
                    $cantidadFacturas += $servicio['Cantidad'];
                }else{
                    $totalBoletas += $servicio['Valor'];
                    $cantidadBoletas += $servicio['Cantidad'];
                }
            }

            $array = array('totalFacturas' => number_format($totalFacturas, 2), 'totalBoletas' => number_format($totalBoletas, 2), 'cantidadFacturas' => $cantidadFacturas, 'cantidadBoletas' => $cantidadBoletas);
            return $array;
        }
    }
?>