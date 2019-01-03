<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class PersonaEmpresa{
        private $metodo;

        function __construct () {
			$this->metodo = new Method;
        }
    	// metodo para sincronizar clientes de bsale con la bd
        function SincronizarConBsale(){

            $query = "SELECT token_produccion as access_token FROM variables_globales";
            $variables_globales = $this->metodo->select($query);
            $access_token = $variables_globales[0]['access_token'];
            // para traer todos los documentos se pasa el 1
            $limiteClientes = self::countClientes(1, '');
            
            $url='https://api.bsale.cl/v1/clients.json?expand=[contacts,attributes,addresses]&limit='.$limiteClientes;
            
            // Inicia cURL
            $session = curl_init($url);

            // Indica a cURL que retorne data
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

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
            $ClientesBsale = json_decode($response, true);
            // echo '<pre>'; print_r($ClientesBsale); echo '</pre>'; exit;
            foreach($ClientesBsale['items'] as $ClienteBsale){
                
                $ClienteId               = $ClienteBsale['id'];
                $ClienteFirstName        = $ClienteBsale['firstName'];
                $ClienteLastName         = $ClienteBsale['lastName'];
                $ClienteEmail            = $ClienteBsale['email'];
                $ClienteRut              = $ClienteBsale['code'];
                $ClientePhone            = $ClienteBsale['phone'];
                $ClienteNombre           = $ClienteBsale['company'];
                $ClienteHasCredit        = $ClienteBsale['hasCredit'];
                $ClienteMaxCredit        = $ClienteBsale['maxCredit'];
                $ClienteEstate           = $ClienteBsale['state'];
                $ClienteActivity         = $ClienteBsale['activity'];
                //municipality = ciudades de la tabla busco el campo nombre = ClienteMunicipality y obtengo su id y el provincia_id y guardo
                // id de ciudades en el campo ciudad de personaempresa, luego hago un select de provincias igual al provincia_id y obtengo
                // el region_id de la tabla y lo guardo en el campo region de la tabla personaempresa
                $ClienteMunicipality = $ClienteBsale['municipality'];
                $ClienteCity         = $ClienteBsale['city'];

                $ClienteCiudadId = '';
                $ProvinciaId = '';
                $ClienteRegionId = '';
                if($ClienteMunicipality != ''){
                    $query = "SELECT id, nombre, provincia_id FROM ciudades WHERE nombre = '".$ClienteMunicipality."' limit 1 ";
                    $ClienteCiudad   = $this->metodo->select($query);
                    $contadorCiudad  = count($ClienteCiudad);
                    if($contadorCiudad > 0){
                        // id para el campo ciudad de personaempresa
                        $ClienteCiudadId = $ClienteCiudad[0]['id'];
                        $ProvinciaId = $ClienteCiudad[0]['provincia_id'];

                        if($ProvinciaId != ''){
                            $query = "SELECT id, nombre, region_id FROM provincias WHERE id = '".$ProvinciaId."' limit 1 ";
                            $ClienteRegion   = $this->metodo->select($query);
                            $contadorRegion  = count($ClienteRegion);
                            if($contadorRegion > 0){
                                // id para el campo region de personaempresa
                                $ClienteRegionId = $ClienteRegion[0]['region_id'];
                            }
        
                        }
                    }

                }
                $ClienteCityId = '';

                if($ClienteCity != ''){
                    $query = "SELECT id FROM ciudades WHERE nombre = '".$ClienteCity."' limit 1 ";
                    $ClienteCity   = $this->metodo->select($query);
                    $contadorCity  = count($ClienteCity);
                    if($contadorCity > 0){
                        // id para el campo city en personaempresa
                        $ClienteCityId = $ClienteCity[0]['id'];
                    }

                }
                echo $ClienteCiudadId."\n".$ProvinciaId."\n".$ClienteRegionId."\n".$ClienteCityId; exit;
                
                $ClienteAddress          = $ClienteBsale['address'];
                $ClienteCompanyOrPerson  = $ClienteBsale['companyOrPerson'];
                $ClienteAccumulatePoints = $ClienteBsale['accumulatePoints'];
                $ClientePoints           = $ClienteBsale['points'];
                $ClientePointsUpdated    = $ClienteBsale['pointsUpdated'];
                $ClienteSendDte          = $ClienteBsale['SendDte'];
                $ClienteIsForeigner      = $ClienteBsale['isForeigner'];
                $ClienteCreatedAt        = $ClienteBsale['createdAt'];
                $ClienteUpdatedAt        = $ClienteBsale['updatedAt'];

                if($TipoDocumento == 1 OR $TipoDocumento == 2){
                    $query = "SELECT Id, UrlPdfBsale, CountDTE, DocumentoIdBsale FROM facturas WHERE DocumentoIdBsale = '".$ClienteId."'";
                    $Factura = $run->select($query);
                    // echo '<pre>'; print_r($Factura); echo '</pre>';exit;
                    if(!$Factura){
                        $UrlPdf = $ClienteBsale['urlPdf'];
                        $informedSii = $ClienteBsale['informedSii'];
                        $responseMsgSii = $ClienteBsale['responseMsgSii'];
                        $NumeroDocumento = $ClienteBsale['number'];
                        $FechaFacturacion = date('Y-m-d', $ClienteBsale['emissionDate']);
                        $HoraFacturacion = date('H:i:s', $ClienteBsale['emissionDate']);
                        $FechaVencimiento = date('Y-m-d', $ClienteBsale['expirationDate']);
                        $references = $ClienteBsale['references'];
                        $references = $references['items'];
                        $referencesCount = count($references);
                        if($references){
                            foreach($references as $reference){
                                $NumeroOC = $reference['number'];
                                $FechaOC = date('Y-m-d',$reference['referenceDate']);
                            }
                            $Grupo = 1001;
                        }else{
                            $Grupo = 1000;
                            $NumeroOC = '';
                            $FechaOC = '1970-01-31';
                        }
                        $client = $ClienteBsale['client'];
                        $code = $client['code'];
                        $Explode = explode('-',$code);
                        $Rut = $Explode[0];
                        if($Rut){
                            $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC, CountDTE) VALUES ('".$Rut."', '".$Grupo."', '4', '1', '".$ClienteId."', '".$UrlPdf."', '".$informedSii."', '".$responseMsgSii."', '".$FechaFacturacion."', '".$HoraFacturacion."', '".$TipoDocumento."', '".$FechaVencimiento."', 0.19, '".$NumeroDocumento."', '".$NumeroOC."', '".$FechaOC."', '".$referencesCount."')";
                            $Id = $run->insert($query);
                            if($Id){
                                $details = $ClienteBsale['details'];
                                $details = $details['items'];
                                foreach($details as $detail){
                                    $documentDetailIdBsale = $detail['id'];
                                    $Valor = $detail['netUnitValue'];
                                    $Cantidad = $detail['quantity'];
                                    $variant = $detail['variant'];
                                    $Concepto = $variant['description'];
                                    $Descuento = 0;
                                    $Total = $detail['totalAmount'];
                                    $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo, documentDetailIdBsale) VALUES ('".$Id."', '".$Concepto."', '".$Valor."', '".$Cantidad."', '".$Descuento."', '0', '".$Total."', '', '".$documentDetailIdBsale."')";
                                    $FacturaDetalleId = $run->insert($query);
                                }
                                //si existen references, exiten dte_code y los inserta
                                if($references){
                                    foreach($references as $reference){
                                        $dte_code = $reference['dte_code'];
                                        $dte_code = $dte_code['href'];
                                        // el 3 es para traer datos de https://api.bsale.cl/v1/dte_codes/20.json y obtener info del dte_code
                                        $dte_code = self::countClientes(3, $dte_code);
                                        $url = $dte_code['href'];
                                        $dtecodeID = $dte_code['id'];
                                        $name = $dte_code['name'];
                                        $codeSii = $dte_code['codeSii'];
                                        $state = $dte_code['state'];
                                        $query = "INSERT INTO dte_code(url, dte_code_id, name, codeSii, state, FacturaId, DocumentoIdBsale) VALUES ('".$url."', '".$dtecodeID."', '".$name."', '".$codeSii."', '".$state."', '".$Id."', '".$ClienteId."')";
                                        $FacturaDTEId = $run->insert($query);
                                    }
                                }
                            }
                        }
                    }else{
                        $Id = $Factura[0]['Id'];
                        $UrlPdf = $Factura[0]['UrlPdfBsale'];
                        $DocumentoIdBsale = $Factura[0]['DocumentoIdBsale'];
                        //actualizo los datos de las facturas en la bd
                        
                        $informedSii = $ClienteBsale['informedSii'];
                        $responseMsgSii = $ClienteBsale['responseMsgSii'];
                        $references = $ClienteBsale['references'];
                        $references = $references['items'];
                        $referencesCount = count($references);
                        if($references){
                            foreach($references as $reference){
                                $NumeroOC = $reference['number'];
                                $FechaOC = date('Y-m-d',$reference['referenceDate']);
                            }
                        }else{
                            $NumeroOC = '';
                            $FechaOC = '1970-01-31';
                        }
                        $client = $ClienteBsale['client'];
                        $code = $client['code'];
                        $Explode = explode('-',$code);
                        $Rut = $Explode[0];
                        if($Rut){
                            $query = "UPDATE facturas set informedSiiBsale = '".$informedSii."' , responseMsgSiiBsale = '".$responseMsgSii."',  NumeroOC = '".$NumeroOC."', FechaOC = '".$FechaOC."', CountDTE = '".$referencesCount."' WHERE DocumentoIdBsale = '".$DocumentoIdBsale."' ";
                            $update = $run->update2($query);
                        }
                    }
                    if($Id){   
                        // $this->almacenarDocumento($Id,1,$UrlPdf);
                    }
                }
            }

        }

        // funcion para obtener el total de clientes de bsale
        function countClientes($tipo, $urlbsale){
            $query = "SELECT token_produccion as access_token FROM variables_globales";
            $variables_globales = $this->metodo->select($query);
            $access_token = $variables_globales[0]['access_token'];
            //Total Clientes
            if($tipo == 1){
                $url='https://api.bsale.cl/v1/clients.json';
            }
            
            // Inicia cURL
            $session = curl_init($url);
            // Indica a cURL que retorne data
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

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
            $Clients = json_decode($response, true);
            if($tipo == 3){
                return $Clients;
            }else{
                return $Clients['count'];
            }
            
        }

    }

?>