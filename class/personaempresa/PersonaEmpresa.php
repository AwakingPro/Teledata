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

            // para traer todos los count paso el 1 y la url correcta
            $limiteClientes = self::contador(1, 'https://api.bsale.cl/v1/clients.json');
            $urlCliets='https://api.bsale.cl/v1/clients.json?expand=[contacts,attributes,addresses]&limit='.$limiteClientes;
            $ClientesBsale = self::conectarAPI($urlCliets);
            
            // echo '<pre>'; print_r($ClientesBsale); echo '</pre>'; exit;
            foreach($ClientesBsale['items'] as $ClienteBsale){
                $ClienteHref             = $ClienteBsale['href'];
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
                // echo $ClienteCiudadId."\n".$ProvinciaId."\n".$ClienteRegionId."\n".$ClienteCityId; exit;
                
                $ClienteAddress          = $ClienteBsale['address'];
                $ClienteCompanyOrPerson  = $ClienteBsale['companyOrPerson'];
                $ClienteAccumulatePoints = $ClienteBsale['accumulatePoints'];
                $ClientePoints           = $ClienteBsale['points'];
                $ClientePointsUpdated    = $ClienteBsale['pointsUpdated'];
                $ClienteSendDte          = $ClienteBsale['sendDte'];
                $ClienteIsForeigner      = $ClienteBsale['isForeigner'];
                $ClienteCreatedAt        = $ClienteBsale['createdAt'];
                $ClienteUpdatedAt        = $ClienteBsale['updatedAt'];
                if($ClienteCreatedAt != ''){
                    $ClienteCreatedAt = date('Y-m-d H:i:s',$ClienteCreatedAt);
                }
                if($ClienteUpdatedAt != ''){
                    $ClienteUpdatedAt = date('Y-m-d H:i:s',$ClienteUpdatedAt);
                }
                $RutExplode = $this->metodo->encontrar($ClienteRut, "-");
                if($RutExplode['verificacion'] == true){
                    $Rut = $RutExplode['Value'][0];
                    $DV = $RutExplode['Value'][1];
                }
                else{
                    $Rut = $ClienteRut;
                    $DV  = '';
                }
                if($Rut != ''){
                    $query = "SELECT rut, dv, nombre, cliente_id_bsale FROM personaempresa WHERE rut = '".$Rut."' ";
                }
                if($DV != ''){
                    $query.= "AND dv = '".$DV."' ";
                }
                if($Rut == '' && $DV == ''){
                    $query = "SELECT rut, dv, nombre, cliente_id_bsale FROM personaempresa WHERE cliente_id_bsale = '".$ClienteId."' ";
                }
                
                $Cliente = $this->metodo->select($query);
                // echo '<pre>'; print_r($Cliente); echo '</pre>';exit;
                if(!$Cliente){
                    // para traer todos los count paso el 1 y la url correcta
                    
                    $limitDocumentos = self::contador(1, 'https://api.bsale.cl/v1/documents.json?clientid='.$ClienteId);
                    
                    if($limitDocumentos > 0){
                        
                        $urlDocs='https://api.bsale.cl/v1/documents.json?expand=[client]&clientid='.$ClienteId.'&limit='.$limitDocumentos;
                        $DocsBsale = self::conectarAPI($urlDocs);
                        // echo '<pre>'; print_r($DocsBsale); echo '</pre>'; exit;
                        foreach($DocsBsale['items'] as $DocBsale){
                            $document_type = $DocBsale['document_type'];
                            $TipoDocumento = $document_type['id'];
                            if($TipoDocumento == 22){
                                $TipoDocumento = 1;
                            }else if($TipoDocumento == 5){
                                $TipoDocumento = 2;
                            }else{
                                $TipoDocumento = 3;
                            }
                        }
                    }else{
                        $TipoDocumento = '';
                    }
                   
                    $query = "INSERT INTO personaempresa(rut, dv, nombre, giro, direccion, correo, contacto, telefono, region, ciudad, tipo_cliente,
                              cliente_id_bsale, tipo_pago_bsale_id, state, fecha_creacion, fecha_actualizacion, href, firstName, lastName, hasCredit, maxCredit,
                              city, companyOrPerson, accumulatePoints, points, pointsUpdated, sendDte, isForeigner ) 
                              VALUES ('".$Rut."', '".$DV."', '".$ClienteNombre."', '".$ClienteActivity."', '".$ClienteAddress."', 
                                    '".$ClienteEmail."', '".$ClienteFirstName."', '".$ClientePhone."', '".$ClienteRegionId."', '".$ClienteCiudadId."',
                                    '".$TipoDocumento."', '".$ClienteId."','15', '".$ClienteEstate."', '".$ClienteCreatedAt."', '".$ClienteUpdatedAt."',
                                    '".$ClienteHref."', '".$ClienteFirstName."', '".$ClienteLastName."', '".$ClienteHasCredit."', '".$ClienteMaxCredit."',
                                    '".$ClienteCityId."','".$ClienteCompanyOrPerson."', '".$ClienteAccumulatePoints."', '".$ClientePoints."',
                                    '".$ClientePointsUpdated."', '".$ClienteSendDte."','".$ClienteIsForeigner."')";
                    $Id = $this->metodo->insert($query, true);
                    // echo $Id;
                    // echo "\n";
                }
                // else{
                //     $Id = $Cliente[0]['Id'];
                //     $UrlPdf = $Cliente[0]['UrlPdfBsale'];
                //     $DocumentoIdBsale = $Cliente[0]['DocumentoIdBsale'];
                //     //actualizo los datos de las facturas en la bd
                //     if($Rut){
                //         $query = "UPDATE facturas set informedSiiBsale = '".$informedSii."' , responseMsgSiiBsale = '".$responseMsgSii."',  NumeroOC = '".$NumeroOC."', FechaOC = '".$FechaOC."', CountDTE = '".$referencesCount."' WHERE DocumentoIdBsale = '".$DocumentoIdBsale."' ";
                //         $update = $run->update2($query);
                //     }
                // }
            }

        }

        // funcion para conectar con la api
        function conectarAPI($url){
            $query = "SELECT token_produccion as access_token FROM variables_globales";
            $variables_globales = $this->metodo->select($query);
            $access_token = $variables_globales[0]['access_token'];
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
            return $response = json_decode($response, true);
        }

        // funcion para obtener el total de clientes de bsale
        function contador($tipo, $urlbsale){
            $query = "SELECT token_produccion as access_token FROM variables_globales";
            $variables_globales = $this->metodo->select($query);
            $access_token = $variables_globales[0]['access_token'];
            //Total Clientes
            if($tipo == 1){
                $url = $urlbsale;
            }
            // if($tipo == 2){
            //     $url='https://api.bsale.cl/v1/documents.json';
            // }
            
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
            $response = json_decode($response, true);
            if($tipo == 3){
                return $response;
            }else{
                return $response['count'];
            }
            
        }

    }

?>