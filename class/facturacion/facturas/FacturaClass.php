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

            $query = "  SELECT
                            servicios.Rut,
                            servicios.Grupo,
                            SUM( servicios.CostoInstalacion * '".$UF."' - ( ( servicios.CostoInstalacion * '".$UF."' ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ) AS Valor,
                            servicios.EstatusFacturacion,
                            servicios.FechaFacturacion,
                            personaempresa.nombre AS Cliente,
                            mantenedor_tipo_cliente.nombre AS TipoDocumento,
                            COALESCE ( grupo_servicio.Nombre, servicios.Grupo ) AS NombreGrupo 
                        FROM
                            servicios
                            INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut
                            LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = servicios.Grupo
                            INNER JOIN mantenedor_tipo_cliente ON personaempresa.tipo_cliente = mantenedor_tipo_cliente.id 
                        WHERE
                            servicios.EstatusFacturacion = 0 
                            AND servicios.CostoInstalacion > 0 
                            AND ( servicios.Estatus = 1 OR servicios.FacturarSinInstalacion = 1 ) 
                        GROUP BY
                            servicios.Rut,
                            servicios.Grupo,
                            servicios.FechaFacturacion";

            $servicios = $run->select($query);

            if($servicios){
                foreach($servicios as $servicio){
                    $Valor = $servicio['Valor'];
                    $IVA = $servicio['Valor'] * 0.19;
                    $Valor += $IVA;
                    $data = array();
                    $data['Id'] = $servicio['Rut']; 
                    $data['Rut'] = $servicio['Rut'];          
                    $data['Grupo'] = $servicio['Grupo'];       
                    $data['Cliente'] = $servicio['Cliente'];        
                    $data['UrlPdfBsale'] = ''; 
                    $data['Tipo'] = 1;
                    $data['Valor'] = number_format($Valor, 2);  
                    $data['EstatusFacturacion'] = 0;
                    $data['TipoDocumento'] = $servicio['TipoDocumento']; 
                    $data['NombreGrupo'] = $servicio['NombreGrupo'];

                    array_push($ToReturn,$data);
                }
            }

            // $query = "  SELECT    SUM(facturas_detalle.Valor) as Valor, facturas.Id, facturas.Rut, facturas.Grupo, facturas.UrlPdfBsale, facturas.FechaFacturacion, facturas.TipoDocumento, personaempresa.nombre as Cliente, COALESCE ( grupo_servicio.Nombre, facturas.Grupo ) AS NombreGrupo
            //             FROM facturas_detalle 
            //             INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
            //             INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
            //             LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = facturas.Grupo 
            //             WHERE facturas.TipoFactura = '3'
            //             AND facturas_detalle.Valor > 0
            //             GROUP BY
            //                 facturas.Id";

            // $facturas = $run->select($query);

            // if($facturas){

            //     foreach($facturas as $factura){

            //         $data = array();
            //         $data['Id'] = $factura['Id']; 
            //         $data['Rut'] = $factura['Rut'];          
            //         $data['Grupo'] = $factura['Grupo'];
            //         $data['Valor'] = $factura['Valor'];   
            //         $data['Cliente'] = $factura['Cliente'];   
            //         $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
            //         $data['FechaFacturacion'] = $factura['FechaFacturacion'];    
            //         $data['Tipo'] = 2;
            //         $data['Valor'] = number_format($factura['Valor'], 2);
            //         $data['EstatusFacturacion'] = 1; 
            //         $data['TipoDocumento'] = $factura['TipoDocumento']; 
            //         $data['NombreGrupo'] = $factura['NombreGrupo'];
                   
            //         array_push($ToReturn,$data);
            //     }
            // }

            $response_array['array'] = $ToReturn;

            echo json_encode($response_array);
    	}

        public function showFacturas(){

            $run = new Method;

            $ToReturn = array();

            // $query = "  SELECT    SUM(facturas_detalle.Valor) as Valor, facturas.Id, facturas.Rut, facturas.Grupo, facturas.UrlPdfBsale, facturas.EstatusFacturacion, facturas.FechaFacturacion, facturas.TipoDocumento, personaempresa.nombre as Cliente, COALESCE ( grupo_servicio.Nombre, facturas.Grupo ) AS NombreGrupo 
            //             FROM facturas_detalle 
            //             INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
            //             INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
            //             LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = facturas.Grupo 
            //             WHERE facturas_detalle.Valor > 0
            //             AND facturas.TipoFactura = '2'
            //             AND facturas.EstatusFacturacion = '1'
            //             GROUP BY
            //                 facturas.Id";

            // $facturas = $run->select($query);

            // if($facturas){

            //     foreach($facturas as $factura){

            //         $data = array();
            //         $data['Id'] = $factura['Id'];  
            //         $data['Rut'] = $factura['Rut'];          
            //         $data['Grupo'] = $factura['Grupo'];   
            //         $data['Valor'] = $factura['Valor'];    
            //         $data['Cliente'] = $factura['Cliente'];   
            //         $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
            //         $data['EstatusFacturacion'] = $factura['EstatusFacturacion'];
            //         $data['FechaFacturacion'] = $factura['FechaFacturacion'];    
            //         $data['Valor'] = number_format($factura['Valor'], 2);
            //         $data['EstatusFacturacion'] = 1; 
            //         $data['TipoDocumento'] = $factura['TipoDocumento'];
            //         $data['NombreGrupo'] = $factura['NombreGrupo'];

            //         array_push($ToReturn,$data);
            //     }
            // }

            $query = "  SELECT
                            SUM(
                                facturas_detalle.Valor - ( facturas_detalle.Valor * ( facturas_detalle.Descuento / 100 ) ) 
                            ) AS Valor,
                            facturas.Rut,
                            facturas.Grupo,
                            facturas.EstatusFacturacion,
                            facturas.TipoDocumento,
                            facturas.IVA,
                            personaempresa.nombre AS Cliente,
                            COALESCE ( grupo_servicio.Nombre, facturas.Grupo ) AS NombreGrupo 
                        FROM
                            facturas_detalle
                            INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id
                            INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                            LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = facturas.Grupo 
                        WHERE
                            facturas_detalle.Valor > 0 
                            AND facturas.TipoFactura = '2' 
                            AND facturas.EstatusFacturacion = '0' 
                        GROUP BY
                            facturas.Rut,
                            facturas.Grupo,
                            facturas.TipoDocumento,
                            facturas.IVA";

            $facturas = $run->select($query);

            if($facturas){

                foreach($facturas as $factura){
                    $Valor = $factura['Valor'];
                    $IVA = $factura['Valor'] * $factura['IVA'];
                    $Valor += $IVA;
                    $data = array();
                    $data['Id'] = $factura['Rut'];
                    $data['Rut'] = $factura['Rut'];          
                    $data['Grupo'] = $factura['Grupo'];   
                    $data['Cliente'] = $factura['Cliente'];   
                    $data['UrlPdfBsale'] = '';
                    $data['EstatusFacturacion'] = $factura['EstatusFacturacion'];
                    $data['Valor'] = number_format($Valor, 2);
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

            $query = "  SELECT
                            servicios.Id,
                            servicios.Codigo,
                            ( servicios.CostoInstalacion * '".$UF."' - ( ( servicios.CostoInstalacion * '".$UF."' ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ) AS Valor,
                            mantenedor_servicios.servicio AS Nombre,
                            mantenedor_tipo_factura.descripcion AS Descripcion 
                        FROM
                            servicios
                            LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio
                            LEFT JOIN mantenedor_tipo_factura ON mantenedor_tipo_factura.codigo = servicios.TipoFactura 
                        WHERE
                            servicios.Rut = '".$Rut."' 
                            AND servicios.Grupo = '".$Grupo."' 
                            AND ( servicios.Estatus = 1 OR servicios.FacturarSinInstalacion = 1 )
                            AND servicios.EstatusFacturacion = 0";

            $servicios = $run->select($query);
            $array = array();

            if($servicios){
                foreach($servicios as $servicio){
                    $data = $servicio;
                    $Valor = $servicio['Valor'];
                    $IVA = $servicio['Valor'] * 0.19;
                    $Valor += $IVA;
                    $data['Valor'] = number_format($Valor, 2);
                    array_push($array,$data);
                }

                $response_array['array'] = $array;

                echo json_encode($response_array);
            }
        }

        public function showFactura($Id,$Tipo){            

            $run = new Method;
            $Explode = explode('-',$Id);

            $query = "  SELECT
                            (
                                facturas_detalle.Valor - ( facturas_detalle.Valor * ( facturas_detalle.Descuento / 100 ) )
                            ) AS Valor,
                            personaempresa.nombre AS Nombre,
                            facturas_detalle.Concepto AS Concepto,
                            facturas.IVA
                        FROM
                            facturas_detalle
                            INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id
                            INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut 
                        WHERE
                            facturas.TipoFactura = '".$Tipo."'";
            if(isset($Explode[1])){
                $Rut = $Explode[0];
                $Grupo = $Explode[1];
                $query .= " AND facturas.Rut = '".$Rut."' AND facturas.Grupo = '".$Grupo."' AND facturas.EstatusFacturacion = 0";
            }else{
                $query .= " AND facturas.Id = '".$Id."'";
            }  
            $facturas = $run->select($query);
            $array = array();

            if($facturas){
                foreach($facturas as $factura){
                    $data = $factura;
                    $Valor = $factura['Valor'];
                    $IVA = $factura['Valor'] * $factura['IVA'];
                    $Valor += $IVA;
                    $data['Valor'] = number_format($Valor, 2);
                    array_push($array,$data);
                }

                $response_array['array'] = $array;

                echo json_encode($response_array);
            }
        }

        public function storeFactura($RutId, $Grupo, $Tipo){

            if(in_array  ('curl', get_loaded_extensions())) {

                $response_array = array();

                if($Tipo == 2){
                    $query = "  SELECT facturas_detalle.*, facturas.FechaFacturacion, facturas.Rut 
                                FROM facturas_detalle 
                                INNER JOIN facturas ON facturas_detalle.FacturaId = facturas.Id 
                                WHERE facturas.Rut = '".$RutId."' AND facturas.Grupo = '".$Grupo."'
                                AND facturas.TipoFactura = '".$Tipo."'
                                AND facturas.EstatusFacturacion = 0
                                AND facturas_detalle.Valor > 0";
                    $expirationDate = time() + 1728000;
                    $FechaVencimiento = date('Y-m-d', $expirationDate);
                }else{
                    $query = "  SELECT servicios.*, servicios.CostoInstalacion as Valor, servicios.CostoInstalacionDescuento as Descuento, mantenedor_servicios.servicio as Servicio 
                                FROM servicios 
                                LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
                                WHERE servicios.Rut = '".$RutId."' AND servicios.Grupo = '".$Grupo."'
                                AND servicios.EstatusFacturacion = 0
                                AND servicios.Valor > 0";
                    $expirationDate = time() + 604800;
                    $FechaVencimiento = date('Y-m-d', $expirationDate);
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
                        $FacturaBsale = $this->sendBsale($cliente,$Servicios,$UF,$Tipo,$expirationDate);

                        if($FacturaBsale['status'] == 1){
                            $UrlPdf = $FacturaBsale['urlPublicViewOriginal'];
                            $DocumentoId = $FacturaBsale['id'];
                            $informedSii = $FacturaBsale['informedSii'];
                            $responseMsgSii = $FacturaBsale['responseMsgSii'];
                            $NumeroDocumento = $FacturaBsale['number'];
                        }else{
                            $UrlPdf = '0';
                            $DocumentoId = '0';
                            $informedSii = '0';
                            $responseMsgSii = '0';
                            $NumeroDocumento = '0';
                        }
                        
                        //Para actualizar los datos del servicios con los datos de Bsale

                        $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES ('".$Rut."', '".$Grupo."', '".$Tipo."', '1', '".$DocumentoId."', '".$UrlPdf."', '".$informedSii."', '".$responseMsgSii."', NOW(), NOW(), '".$TipoDocumento."', '".$FechaVencimiento."', 0.19, '".$NumeroDocumento."')";
                        $FacturaId = $run->insert($query);

                        if($FacturaId){
                            foreach($Servicios as $Servicio){

                                $IdServicio = $Servicio['Id'];
                                $Valor = floatval($Servicio['Valor']);

                                if($Tipo == 2){
                                    $Concepto = $Servicio["Concepto"] . ' - ' . $Servicio["Descuento"].'% Descuento';
                                }else{
                                    $Concepto = 'Costo de instalación / Habilitación'. ' - ' . $Servicio["Descuento"].'% Descuento';
                                    $Valor = $Valor * $UF;
                                }
                                $Descuento = $Servicio['Descuento'];

                                $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Descuento, IdServicio) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Descuento."', '".$IdServicio."')";
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
                $access_token='55c32f657ce5aa159a6fc039b64aabceead8f061';
                //Producción
                // $access_token='957d3b3419bacf7dbd0dd528172073c9903d618b';

                $Facturas = explode(",", $Facturas);
                $Fecha = date('d-m-Y');
                $UfClass = new Uf(); 
                $UF = $UfClass->getValue($Fecha);
                $expirationDate = time() + 1728000;
                $FechaVencimiento = date('Y-m-d', $expirationDate);

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
                            $Valor = $Servicio['Valor'];

                            $query = "SELECT * FROM personaempresa WHERE rut = '".$Rut."'";
                            $cliente = $run->select($query);

                            if($cliente){

                                $cliente = $cliente[0];
                                $TipoDocumento = $cliente['tipo_cliente'];
                                $FacturaBsale = $this->sendBsale($cliente,$Servicios,$UF,2,$expirationDate);

                                if($FacturaBsale['status'] == 1){
                                    $UrlPdf = $FacturaBsale['urlPublicViewOriginal'];
                                    $DocumentoId = $FacturaBsale['id'];
                                    $informedSii = $FacturaBsale['informedSii'];
                                    $responseMsgSii = $FacturaBsale['responseMsgSii'];
                                    $NumeroDocumento = $FacturaBsale['NumeroDocumento'];
                                }else{
                                    $UrlPdf = '0';
                                    $DocumentoId = '0';
                                    $informedSii = '0';
                                    $responseMsgSii = '0';
                                    $NumeroDocumento = '0';
                                }

                                //Para actualizar los datos del servicios con los datos de Bsale

                                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES ('".$Rut."', '".$Grupo."', '2', '1', '".$DocumentoId."', '".$UrlPdf."', '".$informedSii."', '".$responseMsgSii."', NOW(), NOW(), '".$TipoDocumento."', '".$FechaVencimiento."', 0.19, '".$NumeroDocumento."')";
                                $FacturaId = $run->insert($query);

                                if($FacturaId){
                                    foreach($Servicios as $Servicio){

                                        $IdServicio = $Servicio['Id'];
                                        $Valor = floatval($Servicio['Valor']);
                                        $Concepto = $Servicio["Concepto"] . ' - ' . $Servicio["Descuento"].'% Descuento';
                                        $Descuento = $Servicio['Descuento'];

                                        $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Descuento) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Descuento."')";
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

        public function generarFacturas(){

            $run = new Method;
            $dt = new DateTime(); 
            $Anio = $dt->format('Y');
            $MesFacturacion = $this->generarMes($dt);
            $Facturas = array();

            $query = "  SELECT
                            s.*,
                            ms.servicio AS Servicio,
                            p.tipo_cliente,
                        CASE
                                
                                WHEN (
                                    (
                                    SELECT
                                        COUNT( fd.Id ) 
                                    FROM
                                        facturas_detalle fd
                                        INNER JOIN facturas f ON f.Id = fd.FacturaId 
                                    WHERE
                                        s.Id = fd.IdServicio 
                                        AND f.TipoFactura = 2 
                                        AND f.EstatusFacturacion = 0 
                                    ) >= ( SELECT limite_facturas FROM clase_clientes WHERE id = p.ClaseCliente ) 
                                    OR ( SELECT limite_facturas FROM clase_clientes WHERE id = p.ClaseCliente ) = 0 
                                    ) THEN
                                    '0' ELSE '1' 
                                END AS PermitirFactura 
                            FROM
                                servicios s
                            INNER JOIN personaempresa p ON s.Rut = p.rut
                            LEFT JOIN mantenedor_servicios ms ON s.IdServicio = ms.IdServicio";
            $Servicios = $run->select($query);

            if($Servicios){
                $UfClass = new Uf(); 
                $Fecha = date('d-m-Y');
                $UF = $UfClass->getValue($Fecha);
                
                foreach($Servicios as $Servicio){
                    $Id = $Servicio['Id'];
                    $FechaActivacion = $Servicio['FechaActivacion'];
                    $PermitirFactura = $Servicio['PermitirFactura'];
                    if(!$FechaActivacion && $PermitirFactura){
                        $FechaUltimoCobro = $Servicio['FechaUltimoCobro'];
                        $FechaUltimoCobro = new DateTime($FechaUltimoCobro);                     
                        $TipoFacturacion = $Servicio['TipoFacturacion'];
                        $Concepto = $Servicio['Servicio'];
                        if($TipoFacturacion == '1'){
                            $Concepto .= ' - Mes ' . $MesFacturacion;
                            $FechaUltimoCobro->add(new DateInterval("P1M"));
                        }elseif($TipoFacturacion == '2'){
                            $MesUltimoCobro = $this->generarMes($FechaUltimoCobro);
                            $Concepto .= ' - Semestre '. $MesUltimoCobro . ' / ' . $MesFacturacion;
                            $FechaUltimoCobro->add(new DateInterval("P6M"));
                        }else{
                            $Concepto .= ' - Año ' . $Anio;
                            $FechaUltimoCobro->add(new DateInterval("P1Y"));
                        }
                        if($FechaUltimoCobro <= $dt){
                            $Rut = $Servicio['Rut'];
                            $Grupo = $Servicio['Grupo'];

                            if(isset($Facturas[$Rut.'-'.$Grupo])){
                                $FacturaId = $Facturas[$Rut.'-'.$Grupo];
                            }else{
                                $TipoDocumento = $Servicio['tipo_cliente'];
                                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES ('".$Rut."', '".$Grupo."', '2', '0', '0', '', '0', '', NOW(), NOW(), '".$TipoDocumento."', '".$FechaVencimiento."', 0.19, 0)";
                                $FacturaId = $run->insert($query);
                            }

                            $Valor = $Servicio['Valor'];
                            $Valor = $Valor * $UF;
                            $Descuento = $Servicio['Descuento'];

                            $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Descuento, IdServicio) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Descuento."', '".$Id."')";
                            $data = $run->insert($query);
                            $Facturas[$Rut.'-'.$Grupo] = $FacturaId;
                        }
                    }
                    $query = "UPDATE servicios SET FechaUltimoCobro = NOW() WHERE Id = '".$Id."'";
                    $data = $run->update($query);
                }
            }

            $response_array['status'] = 1; 

            echo json_encode($response_array);

        }
        public function getTotalesInstalacion(){
            $run = new Method;
            $UfClass = new Uf(); 
            $Fecha = date('d-m-Y');
            $UF = $UfClass->getValue($Fecha);
            $totalBoletas = 0;
            $totalFacturas = 0;
            $cantidadBoletas = 0;
            $cantidadFacturas = 0;

            $query = "  SELECT 
                            personaempresa.tipo_cliente as TipoDocumento, 
                            SUM( servicios.CostoInstalacion * '".$UF."' - ( ( servicios.CostoInstalacion * '".$UF."' ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ) AS Valor
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
                            servicios.Rut,
                            servicios.Grupo";
            $servicios = $run->select($query);
            foreach($servicios as $servicio){
                $Valor = $servicio['Valor'];
                $IVA = $servicio['Valor'] * 0.19;
                $Valor += $IVA;
                if($servicio['TipoDocumento'] == '2'){
                    $totalFacturas += $Valor;
                    $cantidadFacturas++;
                }else{
                    $totalBoletas += $Valor;
                    $cantidadBoletas++;
                }
            }

            $array = array('totalFacturas' => number_format($totalFacturas, 2), 'totalBoletas' => number_format($totalBoletas, 2), 'cantidadFacturas' => $cantidadFacturas, 'cantidadBoletas' => $cantidadBoletas);
            return $array;
        }
        public function getTotalesLote(){
            $run = new Method;
            $totalBoletas = 0;
            $totalFacturas = 0;
            $cantidadBoletas = 0;
            $cantidadFacturas = 0;

            $query = "  SELECT    
                            facturas.TipoDocumento, 
                            SUM(
                                facturas_detalle.Valor - ( facturas_detalle.Valor * ( facturas_detalle.Descuento / 100 ) ) 
                            ) AS Valor,
                            facturas.IVA
                        FROM 
                            facturas_detalle 
                        INNER JOIN 
                            facturas 
                        ON 
                            facturas_detalle.FacturaId = facturas.Id 
                        WHERE 
                            facturas.EstatusFacturacion = 0 
                        GROUP BY
                            facturas.Rut,
                            facturas.Grupo,
                            facturas.TipoDocumento,
                            facturas.IVA";
            $facturas = $run->select($query);
            foreach($facturas as $factura){
                $Valor = $factura['Valor'];
                $IVA = $factura['Valor'] * $factura['IVA'];
                $Valor += $IVA;
                if($factura['TipoDocumento'] == '2'){
                    $totalFacturas += $Valor;
                    $cantidadFacturas++;
                }else{
                    $totalBoletas += $Valor;
                    $cantidadBoletas++;
                }
            }
            
            $array = array('totalFacturas' => number_format($totalFacturas, 2), 'totalBoletas' => number_format($totalBoletas, 2), 'cantidadFacturas' => $cantidadFacturas, 'cantidadBoletas' => $cantidadBoletas);
            return $array;
        }

        function generarMes($dt){
            $Mes = $dt->format('m');

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
            return $MesFacturacion;
        }

        public function generarFacturacionAutomatica(){

            if(in_array  ('curl', get_loaded_extensions())) {

                $response_array = array();

                $query = "  SELECT Id, Rut
                            FROM facturas
                            WHERE EstatusFacturacion = 0";
                $expirationDate = time() + 1728000;
                $FechaVencimiento = date('Y-m-d', $expirationDate);
                $run = new Method;
                $Facturas = $run->select($query);

                if($Facturas){
                    foreach($Facturas as $Factura){
                        $Id = $Factura['Id'];
                        $Rut = $Factura['Rut'];

                        $query = "SELECT * FROM personaempresa WHERE rut = '".$Rut."'";
                        $cliente = $run->select($query);

                        if($cliente){

                            $cliente = $cliente[0];
                            $TipoDocumento = $cliente['tipo_cliente'];

                            $query = "SELECT * FROM facturas_detalle WHERE FacturaId = '".$Id."'";
                            $Detalles = $run->select($query);

                            $FacturaBsale = $this->sendBsale($cliente,$Detalles,0,2,$expirationDate);
                            if($FacturaBsale['status'] == 1){
                                $UrlPdf = $FacturaBsale['urlPublicViewOriginal'];
                                $DocumentoId = $FacturaBsale['id'];
                                $informedSii = $FacturaBsale['informedSii'];
                                $responseMsgSii = $FacturaBsale['responseMsgSii'];
                            }else{
                                $UrlPdf = '0';
                                $DocumentoId = '0';
                                $informedSii = '0';
                                $responseMsgSii = '0';
                            }
                            if($UrlPdf){
                                $DocumentoId = $FacturaBsale['id'];
                                $informedSii = $FacturaBsale['informedSii'];
                                $responseMsgSii = $FacturaBsale['responseMsgSii'];
                                $query = "UPDATE facturas SET EstatusFacturacion = '1', DocumentoIdBsale = '".$DocumentoId."', UrlPdfBsale = '".$UrlPdf."', informedSiiBsale = '".$informedSii."', responseMsgSiiBsale = '".$responseMsgSii."', FechaFacturacion = NOW(), HoraFacturacion = NOW(), FechaVencimiento = '".$FechaVencimiento."' WHERE Id = '".$Id."'";
                                $update = $run->update($query);
                                foreach($Detalles as $Detalle){
                                    $this->aplicarDescuento($Detalle);
                                }
                                $response_array['status'] = 1;
                            }else{
                                $response_array['Message'] = $FacturaBsale['error'];
                                $response_array['status'] = 0;
                            }
                        }else{
                            $response_array['status'] = 4;
                        }
                    }
                }else{
                    $response_array['status'] = 3;
                }
            }else{
                $response_array['status'] = 99;
            }

            echo json_encode($response_array);
        }

        public function sendBsale($cliente,$Servicios,$UF,$Tipo,$expirationDate){

            //Demo
            $access_token='55c32f657ce5aa159a6fc039b64aabceead8f061';
            //Producción
            // $access_token='957d3b3419bacf7dbd0dd528172073c9903d618b';
            
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
                    $Descuentos = $this->aplicarDescuento($Servicio);
                    $Descuento = $Descuentos['DescuentoAplicado'];
                    $CantidadAplicada = $Descuentos['CantidadAplicada'];
                    if($CantidadAplicada == 0){
                        $Extra = '';
                    }else if($CantidadAplicada == 1){
                        $Extra = ' ('.$CantidadAplicada.' Descuento Aplicado)';
                    }else{
                        $Extra = ' ('.$CantidadAplicada.' Descuentos Aplicados)';
                    }
                    $Concepto = $Servicio["Concepto"] . ' - ' . $Descuento.'% Descuento' . $Extra;
                    $Valor = floatval($Servicio['Valor']);
                }else{
                    $Descuento = floatval($Servicio["Descuento"]);
                    $Concepto = 'Costo de instalación / Habilitación'. ' - ' . $Descuento.'% Descuento';
                    $Valor = floatval($Servicio['Valor']) * $UF;
                }

                $detail = array("netUnitValue" => $Valor, "quantity" => 1, "taxId" => "[1]", "comment" => $Concepto, "discount" => $Descuento);

                array_push($details,$detail);
            }

            //FACTURA

            //Demo
            // "documentTypeId"    => 5

            //Producción
            // "documentTypeId"    => 5

            //BOLETA

            //Demo
            // "documentTypeId"    => 22

            //Producción
            // "documentTypeId"    => 22

            if($cliente['tipo_cliente'] == "2"){
                $documentTypeId = 5;
            }else{
                $documentTypeId = 22;
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
                $FacturaBsale['status'] = 1;
            }else{
                $Message = $FacturaBsale['error'];
                $FacturaBsale = array();
                $FacturaBsale['Message'] = $Message;
                $FacturaBsale['status'] = 0;
            }
            return $FacturaBsale;
        }

        public function aplicarDescuento($Detalle){
            $IdServicio = $Detalle['IdServicio'];
            $IdDetalle = $Detalle['Id'];
            $DescuentoAplicado = $Detalle['Descuento'];
            $CantidadAplicada = 0;
            if($DescuentoAplicado < 100 && isset($Detalle['IdServicio'])){
                $run = new Method;
                $query = "SELECT * FROM descuentos WHERE IdServicio = '".$IdServicio."' AND CantidadUtilizada < Cantidad AND FechaAprobacion IS NOT NULL";
                $Descuentos = $run->select($query);
                if($Descuentos){
                    foreach($Descuentos as $Descuento){
                        if($DescuentoAplicado < 100){
                            $Id = $Descuento['Id'];
                            $IdTicket = $Descuento['IdTicket'];
                            $Porcentaje = $Descuento['Porcentaje'];
                            $PorcentajeTmp = $DescuentoAplicado + $Porcentaje;
                            if($PorcentajeTmp <= 100){
                                $Tipo = 1;
                            }else{
                                $Tipo = 2;
                                $Porcentaje = $PorcentajeTmp - 100;
                            }
                            $query = "INSERT INTO descuentos_aplicados (IdDescuento,IdServicio,IdDetalle,IdTicket,Porcentaje,Tipo) VALUES ('".$Id."','".$IdServicio."','".$IdDetalle."','".$IdTicket."','".$Porcentaje."','".$Tipo."')";
                            $insert = $run->insert($query);
                            if($insert){
                                $CantidadUtilizada = intval($Descuento['CantidadUtilizada']);
                                $CantidadUtilizada++;
                                $query = "UPDATE descuentos SET CantidadUtilizada = '".$CantidadUtilizada."' WHERE Id = '".$Id."'";
                                $update = $run->update($query);
                                $DescuentoAplicado += $Porcentaje;
                                $CantidadAplicada++;
                            }
                        }
                    }
                }
            }
            $array = array('DescuentoAplicado' => $DescuentoAplicado, 'CantidadAplicada' => $CantidadAplicada);
            return $array; 
        }
        public function filtrarFacturasPorFecha($startDate,$endDate){

            $run = new Method;
            $ToReturn = array();

            $dt = \DateTime::createFromFormat('d-m-Y',$startDate);
            $startDate = $dt->format('Y-m-d');
            $dt = \DateTime::createFromFormat('d-m-Y',$endDate);
            $endDate = $dt->format('Y-m-d');

            $query = "  SELECT
                            personaempresa.nombre as Cliente,
                            facturas.Id,
                            facturas.NumeroDocumento,
                            facturas.FechaFacturacion,
                            facturas.FechaVencimiento,
                            facturas.UrlPdfBsale,
                            mantenedor_tipo_cliente.nombre AS TipoDocumento,
                            facturas.IVA,
                            IFNULL( ( SELECT SUM( Monto ) FROM facturas_pagos WHERE FacturaId = facturas.Id ), 0 ) AS TotalAbono 
                        FROM
                            facturas
                            INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id 
                            INNER JOIN personaempresa ON facturas.Rut = personaempresa.rut 
                        WHERE
                            facturas.FechaFacturacion BETWEEN '".$startDate."' AND '".$endDate."'
                            AND facturas.EstatusFacturacion = '1'";
            $facturas = $run->select($query);

            if($facturas){
                foreach($facturas as $factura){
                    $Id = $factura['Id'];
                    $IVA = $factura['IVA'];       
                    $TotalAbono = $factura['TotalAbono'];
                    $TotalFactura = 0;
                    $query = "SELECT Valor, (Descuento + IFNULL((SELECT SUM(Porcentaje) FROM descuentos_aplicados WHERE IdDetalle = facturas_detalle.Id),0)) as Descuento FROM facturas_detalle WHERE FacturaId = '".$Id."'";
                    $detalles = $run->select($query);
                    foreach($detalles as $detalle){
                        $Valor = $detalle['Valor'];
                        $Descuento = floatval($detalle['Descuento']) / 100;
                        $Descuento = $Valor * $Descuento;
                        $Valor -= $Descuento;
                        $IvaSumatoria = $Valor * $IVA;
                        $Valor += $IvaSumatoria;
                        $TotalFactura += $Valor;
                    }

                    $TotalAbono = $TotalFactura - $TotalAbono;
                    if($TotalAbono < 0){
                        $TotalAbono = 0;
                    }

                    $data = array();
                    $data['Id'] = $factura['Id'];
                    $data['Cliente'] = $factura['Cliente'];
                    $data['NumeroDocumento'] = $factura['NumeroDocumento'];
                    $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');        
                    $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');        
                    $data['TotalFactura'] = number_format($TotalFactura, 2);
                    $data['TotalAbono'] = number_format($TotalAbono, 2);
                    $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
                    $data['TipoDocumento'] = $factura['TipoDocumento'];
                    array_push($ToReturn,$data);
                }
            }

            echo json_encode($ToReturn);
        }

    }
?>