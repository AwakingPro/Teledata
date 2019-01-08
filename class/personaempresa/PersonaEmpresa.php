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
            $limiteClientes = $this->metodo->contador(1, 'https://api.bsale.cl/v1/clients.json');
            $urlClients='https://api.bsale.cl/v1/clients.json?expand=[contacts,attributes,addresses]&limit='.$limiteClientes;
            $ClientesBsale = $this->metodo->conectarAPI($urlClients);
            
            // echo '<pre>'; print_r($ClientesBsale); echo '</pre>'; exit;
            foreach($ClientesBsale['items'] as $ClienteBsale){
                $ClienteHref             = $ClienteBsale['href'];
                $ClienteId               = $ClienteBsale['id'];
                $ClienteFirstName        = $ClienteBsale['firstName'];
                $ClienteLastName         = $ClienteBsale['lastName'];
                $ClienteEmail            = $ClienteBsale['email'];
                $ClienteRut              = $ClienteBsale['code'];
                if($ClienteRut == ''){
                    $ClienteRut = 0;
                }
                $ClientePhone            = $ClienteBsale['phone'];
                $ClienteNombre           = $ClienteBsale['company'];
                $ClienteHasCredit        = $ClienteBsale['hasCredit'];
                if($ClienteHasCredit == ''){
                    $ClienteHasCredit = 0;
                }
                $ClienteMaxCredit        = $ClienteBsale['maxCredit'];
                if($ClienteMaxCredit == ''){
                    $ClienteMaxCredit = 0;
                }
                $ClienteEstate           = $ClienteBsale['state'];
                $ClienteActivity         = $ClienteBsale['activity'];
                //municipality = ciudades de la tabla busco el campo nombre = ClienteMunicipality y obtengo su id y el provincia_id y guardo
                // id de ciudades en el campo ciudad de personaempresa, luego hago un select de provincias igual al provincia_id y obtengo
                // el region_id de la tabla y lo guardo en el campo region de la tabla personaempresa
                $ClienteMunicipality = $ClienteBsale['municipality'];
                $ClienteCity         = $ClienteBsale['city'];
                if($ClienteCity == ''){
                    $ClienteCity = 0;
                }

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
                if($ClienteCityId == ''){
                    $ClienteCityId = 0;
                }
                // echo $ClienteCiudadId."\n".$ProvinciaId."\n".$ClienteRegionId."\n".$ClienteCityId; exit;
                
                $ClienteAddress          = $ClienteBsale['address'];
                $ClienteCompanyOrPerson  = $ClienteBsale['companyOrPerson'];
                $ClienteAccumulatePoints = $ClienteBsale['accumulatePoints'];
                $ClientePoints           = $ClienteBsale['points'];
                $ClientePointsUpdated    = $ClienteBsale['pointsUpdated'];
                if($ClientePointsUpdated == ''){
                    $ClientePointsUpdated = 0;
                }
                $ClienteSendDte          = $ClienteBsale['sendDte'];
                $ClienteIsForeigner      = $ClienteBsale['isForeigner'];
                if($ClienteIsForeigner == ''){
                    $ClienteIsForeigner = 0;
                }
                $ClienteCreatedAt        = $ClienteBsale['createdAt'];
                if($ClienteCreatedAt == ''){
                    $ClienteCreatedAt = date('Y-m-d H:i:s');
                }
                $ClienteUpdatedAt        = $ClienteBsale['updatedAt'];
                if($ClienteUpdatedAt == ''){
                    $ClienteUpdatedAt = date('Y-m-d H:i:s');
                }
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
                    $dataClient = array();
                    $dataClient['RutExplode'] = $RutExplode;
                    $dataClient['ClienteNombre'] = $ClienteNombre;
                    // $dataClient['correos'] = 'teledatadte@teledata.cl, preinoso@teledata.cl, cjurgens@teledata.cl, fpezzuto@teledata.cl, esalas@teledata.cl, sergio@teledata.cl';
                    $dataClient['correos'] = 'daniel30081990@gmail.com';
                    $dataClient['asunto'] = 'Ingreso del Cliente: '.$ClienteNombre.' Rut: '.$ClienteRut.' de Bsale a la BD del ERP';
                    // para traer todos los count paso el 1 y la url correcta
                    $limitDocumentos = $this->metodo->contador(1, 'https://api.bsale.cl/v1/documents.json?clientid='.$ClienteId);
                    if($limitDocumentos > 0){
                        
                        $urlDocs='https://api.bsale.cl/v1/documents.json?expand=[client]&clientid='.$ClienteId.'&limit='.$limitDocumentos;
                        $DocsBsale = $this->metodo->conectarAPI($urlDocs);
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
                   echo " Entro en insert per"; echo "\n";
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
                    echo $query; echo "\n";
                    echo 'Id es ' . $Id; echo "\n";
                    if($Id){
                        // echo '<pre>'; print_r($dataClient); echo '</pre>';
                        $respCorreo = $this->metodo->enviarCorreo(1, $dataClient);
                        echo $respCorreo;
                    }
                }
                else{
                    //actualizo los datos de las facturas en la bd
                    if($Rut){
                        //esto es para que actualise solo clientes actios, ya que pueden existir varios clientes con mismo rut y estados inactivos
                        if($ClienteEstate == 0){
                            $query = "UPDATE personaempresa set cliente_id_bsale = '".$ClienteId."' , state = '".$ClienteEstate."',  
                            fecha_creacion = '".$ClienteCreatedAt."', fecha_actualizacion = '".$ClienteUpdatedAt."', href = '".$ClienteHref."',
                            firstName  = '".$ClienteFirstName."', lastName  = '".$ClienteLastName."', hasCredit  = '".$ClienteHasCredit."',
                            maxCredit  = '".$ClienteMaxCredit."', city = '".$ClienteCityId."', companyOrPerson = '".$ClienteCompanyOrPerson."',
                            accumulatePoints = '".$ClienteAccumulatePoints."', points = '".$ClientePoints."', pointsUpdated = '".$ClientePointsUpdated."',
                            sendDte = '".$ClienteSendDte."', isForeigner = '".$ClienteIsForeigner."'
                            WHERE rut = '".$Rut."' ";
                            $update = $this->metodo->update2($query);
                        }
                        
                    }
                }
            }

        }
    }

?>