<?php

    include('../../../class/methods_global/methods.php');
    include("../../../class/facturacion/uf/UfClass.php");
    header('Content-type: application/json');

    class Factura{
        function __construct () {
			$run = new Method;
        }

        //metodo para que aparezcan los documentos de cliente con posee_prefactura = 1, y sus docs con EstatusFacturacion = 4(ocultos en por lotes), para que se ejecute los 22 de cada mes 
        public function generarPrefactura(){
            $run = new Method;
            $query = " SELECT * from facturas WHERE EstatusFacturacion = 4 ";
            $documentosPrefacturas = $run->select($query);
            if($documentosPrefacturas){
                foreach($documentosPrefacturas as $documentoPrefactura){
                    $facturaId = $documentoPrefactura['Id'].' ';
                    $query = " UPDATE facturas SET EstatusFacturacion = '0' WHERE Id = '".$facturaId."' ";
                    echo $run->update($query);

                }
            }
        }

        //metodo para verificar si un cliente tiene un doc emitido y uno vencido y enviar correo a tecnicos para el corte
        public function verificarDocumentosEmitidos(){
            $dataClient = array();
            $servicio_nombre_cliente = 'PRUEBA SISTEMA NO BORRAR';
            $servicio_codigo_cliente = '26339939-0FSAI03';
            $Mensaje = '<b>Cortar</b> Servicio del Cliente: <b>'.$servicio_nombre_cliente.'</b> código <b>'. $servicio_codigo_cliente.'</b>';

            $dataClient['ClienteNombre'] = $servicio_nombre_cliente;
            $dataClient['ServicioCodigo'] = $servicio_codigo_cliente;
            // $dataClient['correos'] = 'atrismartelo@teledata.cl, jcarrillo@teledata.cl, rmontoya@teledata.cl, fpezzuto@teledata.cl, kcardenas@teledata.cl, pagos@teledata.cl';
            $dataClient['correos'] = 'daniel30081990@gmail.com, dangel@teledata.cl';
            $dataClient['asunto'] = 'Actualizar Servicio '.$servicio_codigo_cliente;
            $dataClient['MensajeCorreo'] = $Mensaje;
            $run = new Method;
            $respCorreo = $run->enviarCorreos(2, $dataClient);
            echo $respCorreo;
        }
    	public function showInstalaciones(){
            $run = new Method;
            $UfClass = new Uf(); 
            $UF = $UfClass->getValue();

            $ToReturn = array();
            // ROUND(( servicios.CostoInstalacion * '".$UF."' - ( ( servicios.CostoInstalacion * '".$UF."' ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ),0) AS Valor,
            $query = "  SELECT
                            servicios.Id,
                            servicios.Rut,
                            servicios.Grupo,
                            ( CASE servicios.tipo_moneda WHEN 2 THEN ROUND(( servicios.CostoInstalacion * '".$UF."' - ( ( servicios.CostoInstalacion * '".$UF."' ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ),0)
                            ELSE ROUND(( servicios.CostoInstalacion  - ( ( servicios.CostoInstalacion  ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ),0) END ) AS Valor,
                            -- ROUND(( servicios.CostoInstalacion  - ( ( servicios.CostoInstalacion  ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ),0) AS Valor,
                            servicios.EstatusFacturacion,
                            servicios.FechaFacturacion,
                            personaempresa.nombre AS Cliente,
                            mantenedor_tipo_cliente.nombre AS TipoDocumento,
                            COALESCE ( grupo_servicio.Nombre, servicios.Grupo ) AS NombreGrupo 
                        FROM
                            servicios
                            INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut
                            LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = servicios.Grupo
                            INNER JOIN mantenedor_tipo_cliente ON personaempresa.tipo_Cliente = mantenedor_tipo_cliente.id
                        WHERE
                            servicios.EstatusFacturacion = 0 
                            AND servicios.CostoInstalacion > 0 
                            AND ( servicios.EstatusInstalacion = 1 OR servicios.FacturarSinInstalacion = 1 )";

            $servicios = $run->select($query);

            if($servicios){
                foreach($servicios as $servicio){
                    $Valor = $servicio['Valor'];
                    $IVA = $servicio['Valor'] * 0.19;
                    $Valor += round($IVA,0);
                    $data = array();
                    $data['Id'] = $servicio['Id']; 
                    $data['Rut'] = $servicio['Rut'];          
                    $data['Grupo'] = $servicio['Grupo'];       
                    $data['Cliente'] = $servicio['Cliente'];        
                    $data['UrlPdfBsale'] = ''; 
                    $data['Tipo'] = 1;
                    $data['Valor'] = $Valor; 
                    $data['EstatusFacturacion'] = 0;
                    $data['TipoDocumento'] = $servicio['TipoDocumento']; 
                    $data['NombreGrupo'] = $servicio['NombreGrupo'];

                    array_push($ToReturn,$data);
                }
            }

            $response_array['array'] = $ToReturn;

            echo json_encode($response_array);
    	}

        public function showLotes(){

            $run = new Method;

            $ToReturn = array();
            $query = "  SELECT
                            ROUND(SUM(
                                facturas_detalle.Total
                            ),0) AS Valor,
                            facturas.Rut,
                            facturas.Grupo,
                            facturas.EstatusFacturacion,
                            facturas.DocumentoIdBsale,
                            mantenedor_tipo_cliente.nombre AS TipoDocumento,
                            facturas.IVA,
                            personaempresa.nombre AS Cliente,
                            personaempresa.dv as DV,
                            -- devuelve el primero que encuentre que no sea nulo.
                            COALESCE (
                                personaempresa.posee_prefactura,
                                0
                            ) AS PoseePrefactura,
                            -- devuelve el primero que encuentre que no sea nulo.
                            COALESCE (
                                grupo_servicio.Nombre,
                                facturas.Grupo
                            ) AS NombreGrupo,
                            grupo_servicio.EsOC
                        FROM
                            facturas
                        INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.id 
                        LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = facturas.Grupo
                        WHERE
                            facturas_detalle.Valor > 0
                        AND facturas.TipoFactura = '2'
                        AND facturas.EstatusFacturacion = '0'
                        AND (facturas.Grupo != 1000 && facturas.Grupo != 1001)
                        AND facturas.deleted_at IS NULL
                        GROUP BY
                            facturas.Rut,
                            facturas.Grupo,
                            facturas.TipoDocumento,
                            facturas.IVA";
            // el 1000 es sin grupo y el 1001 es sin grupo con OC Porque ellos querian que hubieran facturas que no se agruparan
            // Y la unica manera que consegui para hacerlo fue asignarles un grupo asi
            $facturas = $run->select($query);

            if($facturas){

                foreach($facturas as $factura){
                    $Rut = $factura['Rut'];
                    $Grupo = $factura['Grupo'];
                    $data = array();
                    $data['Id'] = $Rut;
                    $data['Rut'] = $Rut . '-' . $factura['DV'];
                    $data['Grupo'] = $Grupo;   
                    $data['Cliente'] = $factura['Cliente'];   
                    $data['UrlPdfBsale'] = '';
                    $data['EstatusFacturacion'] = $factura['EstatusFacturacion'];
                    $data['Valor'] = $factura['Valor'];
                    $data['TipoDocumento'] = $factura['TipoDocumento'];
                    $data['NombreGrupo'] = $factura['NombreGrupo'];
                    $data['DocumentoIdBsale'] = $factura['DocumentoIdBsale'];
                    $data['PoseePrefactura'] = $factura['PoseePrefactura'];
                    if($factura['EsOC'] || $factura['PoseePrefactura']){
                        $query = "SELECT NumeroOC FROM facturas WHERE Rut = '".$Rut."' AND Grupo = '".$Grupo."' AND EstatusFacturacion = '0' LIMIT 1";
                        $OC = $run->select($query);
                        if($OC){
                            $OC = $OC[0];
                            if($OC['NumeroOC']){
                                $data['PermitirFactura'] = 1;
                            }else{
                                $data['PermitirFactura'] = 0;
                            }
                        }else{
                            $data['PermitirFactura'] = 0;
                        }
                    }else{
                        $data['PermitirFactura'] = 1;
                    }

                    array_push($ToReturn,$data);
                }
            }

            $query = "  SELECT
                            IFNULL(ROUND(SUM(
                                facturas_detalle.Total
                            ),0),0) AS Valor,
                            facturas.Id,
                            facturas.Rut,
                            facturas.Grupo,
                            facturas.EstatusFacturacion,
                            facturas.DocumentoIdBsale,
                            facturas.NumeroOC,
                            mantenedor_tipo_cliente.nombre AS TipoDocumento,
                            facturas.IVA,
                            personaempresa.nombre AS Cliente,
                            personaempresa.dv as DV,
                             -- devuelve el primero que encuentre que no sea nulo.
                             COALESCE (
                                personaempresa.posee_prefactura,
                                0
                            ) AS PoseePrefactura,
                            COALESCE (
                                grupo_servicio.Nombre,
                                facturas.Grupo
                            ) AS NombreGrupo,
                            grupo_servicio.EsOC
                        FROM
                            facturas
                        INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.id 
                        LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = facturas.Grupo
                        WHERE
                            facturas.TipoFactura = '2'
                        AND (facturas.Grupo = 1000 OR facturas.Grupo = 1001)
                        AND facturas.EstatusFacturacion = '0'
                        AND facturas.deleted_at IS NULL
                        GROUP BY
                            facturas.Id";
            $facturas = $run->select($query);
            if($facturas){

                foreach($facturas as $factura){
                    $Valor = $factura['Valor'];
                    $data = array();
                    $data['Id'] = $factura['Id'];
                    $data['Rut'] = $factura['Rut'] . '-' . $factura['DV'];          
                    $data['Grupo'] = $factura['Grupo'];   
                    $data['Cliente'] = $factura['Cliente'];
                    $data['UrlPdfBsale'] = '';
                    $data['Valor'] = $Valor;
                    $data['EstatusFacturacion'] = 0;
                    $data['TipoDocumento'] = $factura['TipoDocumento'];
                    $data['NombreGrupo'] = $factura['NombreGrupo'];
                    $data['DocumentoIdBsale'] = $factura['DocumentoIdBsale'];
                    $data['PoseePrefactura'] = $factura['PoseePrefactura'];
                    if($factura['EsOC'] || $factura['PoseePrefactura']){
                        if($factura['NumeroOC']){
                            $data['PermitirFactura'] = 1;
                        }else{
                            $data['PermitirFactura'] = 0;
                        }
                    }else{
                        $data['PermitirFactura'] = 1;
                    }

                    array_push($ToReturn,$data);
                }
            }

            $response_array['array'] = $ToReturn;
            echo json_encode($response_array);
        }

        public function showIndividuales(){

            $run = new Method;

            $ToReturn = array();
            $query = "  SELECT
                            ROUND(SUM(
                                facturas_detalle.Total
                            ),0) AS Valor,
                            facturas.Id,
                            facturas.Rut,
                            facturas.Grupo,
                            facturas.EstatusFacturacion,
                            facturas.DocumentoIdBsale,
                            mantenedor_tipo_cliente.nombre AS TipoDocumento,
                            facturas.IVA,
                            personaempresa.nombre AS Cliente,
                            COALESCE (
                                grupo_servicio.Nombre,
                                facturas.Grupo
                            ) AS NombreGrupo
                        FROM
                            facturas
                        INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.id 
                        LEFT JOIN grupo_servicio ON grupo_servicio.IdGrupo = facturas.Grupo
                        WHERE
                            facturas_detalle.Valor > 0
                        AND facturas.TipoFactura = '1'
                        AND facturas.EstatusFacturacion = '0'
                        AND facturas.deleted_at IS NULL
                        GROUP BY
                            facturas.Id";

            $facturas = $run->select($query);

            if($facturas){

                foreach($facturas as $factura){
                    $Valor = $factura['Valor'];
                    $data = array();
                    $data['Id'] = $factura['Id'];
                    $data['Rut'] = $factura['Rut'];          
                    $data['Grupo'] = $factura['Grupo'];   
                    $data['Cliente'] = $factura['Cliente'];   
                    $data['UrlPdfBsale'] = '';
                    $data['EstatusFacturacion'] = $factura['EstatusFacturacion'];
                    $data['Valor'] = $Valor;
                    $data['EstatusFacturacion'] = 0;
                    $data['TipoDocumento'] = $factura['TipoDocumento'];
                    $data['NombreGrupo'] = $factura['NombreGrupo'];
                    $data['DocumentoIdBsale'] = $factura['DocumentoIdBsale'];
                    array_push($ToReturn,$data);
                }
            }

            $response_array['array'] = $ToReturn;

            echo json_encode($response_array);
        }
        // muestra detalles de las instalaciones
        public function showInstalacion($Id){            

            $run = new Method;

            $UfClass = new Uf(); 
            $UF = $UfClass->getValue();
            // ROUND((
            //     servicios.CostoInstalacion * '".$UF."' - (
            //         (
            //             servicios.CostoInstalacion * '".$UF."'
            //         ) * (
            //             servicios.CostoInstalacionDescuento / 100
            //         )
            //     )
            // ),0) AS Valor,
            $query = "  SELECT
                            facturas_detalle.Id AS detalleId,
                            facturas_detalle.FacturaId AS facturaId,
                            facturas_detalle.documentDetailIdBsale AS detalleIdBsale,
                            servicios.Id,
                            servicios.Codigo,
                            ( CASE servicios.tipo_moneda WHEN 2 THEN ROUND(( servicios.CostoInstalacion * '".$UF."' - ( ( servicios.CostoInstalacion * '".$UF."' ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ),0)
                            ELSE ROUND(( servicios.CostoInstalacion  - ( ( servicios.CostoInstalacion  ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ),0) END ) AS Valor,
                            -- ROUND((
                            --     servicios.CostoInstalacion  - 
                            --     (( servicios.CostoInstalacion ) * (  servicios.CostoInstalacionDescuento / 100 ))), 0) AS Valor,
                            -- ( CASE servicios.IdServicio WHEN 7 THEN servicios.NombreServicioExtra ELSE servicios.Descripcion END ) AS Nombre,
                            ( CASE  WHEN servicios.Descripcion = '' THEN 'Costo de instalación / Habilitación' ELSE servicios.Descripcion END ) AS Nombre,
                            mantenedor_tipo_factura.descripcion AS Descripcion
                        FROM
                            servicios
                        LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio
                        LEFT JOIN mantenedor_tipo_factura ON mantenedor_tipo_factura.id = servicios.TipoFactura
                        -- agregue facturas_detalle para la solictud de carlos
                        LEFT JOIN facturas_detalle ON servicios.Id = facturas_detalle.IdServicio
                        WHERE
                            servicios.Id = '".$Id."'
                        AND (
                            servicios.EstatusInstalacion = 1
                            OR servicios.FacturarSinInstalacion = 1
                        )
                        AND servicios.EstatusFacturacion = 0
                        AND servicios.CostoInstalacion > 0
                        AND facturas_detalle.delete_at IS NULL
                        AND facturas_detalle.documentDetailIdBsale IS NULL";

            $servicios = $run->select($query);
            $array = array();

            if($servicios){
                $totalDetalles = count($servicios);
                foreach($servicios as $servicio){
                    $data = $servicio;
                    $Valor = $servicio['Valor'];
                    $IVA = $servicio['Valor'] * 0.19;
                    $Valor += round($IVA,0);
                    // $data['Valor'] = $Valor;
                    $data['Valor'] = $servicio['Valor'];
                    $data['facturaId'] = $servicio['facturaId'];
                    $data['detalleId'] = $servicio['detalleId'];
                    $data['detalleIdBsale'] = $servicio['detalleIdBsale'];
                    $data['totalDetalles'] = $totalDetalles;
                    array_push($array,$data);
                }

                $response_array['array'] = $array;

                echo json_encode($response_array);
            }
        }

        public function showLote($Rut,$Grupo, $DocEmitidos = false){

            $run = new Method;
            if($Grupo == 1000){
                $query = "  SELECT
                            facturas_detalle.Id AS detalleId,
                            ROUND((
                                facturas_detalle.Total
                            ),0) AS Valor,
                            facturas_detalle.IdServicio as idServicio,
                            facturas_detalle.documentDetailIdBsale AS detalleIdBsale,
                            personaempresa.nombre AS Nombre,
                            facturas_detalle.Codigo,
                            facturas_detalle.Concepto,
                            facturas.Id AS facturaId,
                            facturas.IVA,
                            servicios.Descripcion
                        FROM
                            facturas
                        INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        INNER JOIN servicios ON servicios.Id = facturas_detalle.IdServicio
                        WHERE
                            facturas.TipoFactura = '2'
                        AND facturas.id = '".$Rut."'
                        AND facturas.Grupo = '".$Grupo."'
                        -- AND facturas.EstatusFacturacion = 0
                        AND facturas_detalle.Valor > 0"; 
            }else{
                $query = "  SELECT
                facturas_detalle.Id AS detalleId,
                ROUND((
                    facturas_detalle.Total
                ),0) AS Valor,
                facturas_detalle.IdServicio as idServicio,
                facturas_detalle.documentDetailIdBsale AS detalleIdBsale,
                personaempresa.nombre AS Nombre,
                facturas_detalle.Codigo,
                facturas_detalle.Concepto,
                facturas.Id AS facturaId,
                facturas.IVA,
                servicios.Descripcion
            FROM
                facturas
            INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id
            INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
            INNER JOIN servicios ON servicios.Id = facturas_detalle.IdServicio
            WHERE
                facturas.TipoFactura = '2'
            AND facturas.Rut = '".$Rut."'
            AND facturas.Grupo = '".$Grupo."'
            -- AND facturas.EstatusFacturacion = 0
            AND facturas_detalle.Valor > 0 "; 
            }
            
            if($DocEmitidos){
                // echo ' para ver docs emitidos rut es '. $Rut.' Grupo es '.$Grupo;
                $query .= " AND facturas.EstatusFacturacion = 1 ";
                // OR facturas.EstatusFacturacion = 2
            }else{
                // echo ' para ver docs por emitir ';
                $query .= " AND facturas.EstatusFacturacion = 0 ";
            }
            $facturas = $run->select($query);
            
            $array = array();
            if($facturas){
                $totalDetalles = count($facturas);
                foreach($facturas as $factura){
                    $data = $factura;
                    $Valor = $factura['Valor'];
                    $data['idServicio'] = $factura['idServicio'];
                    $data['Codigo'] = $data['Codigo'];
                    if($data['Descripcion']){
                        $data['Concepto'] .=  ' - '.$data['Descripcion'];
                    }
                    $data['Concepto'] = $data['Concepto'];
                    $data['Valor'] = $Valor;
                    $data['facturaId'] = $factura['facturaId'];
                    $data['detalleId'] = $factura['detalleId'];
                    $data['totalDetalles'] = $totalDetalles;
                    
                    array_push($array,$data);
                }

                $response_array['array'] = $array;
                echo json_encode($response_array);
            }
        }

        public function showIndividual($Id){            

            $run = new Method;

            $query = "  SELECT
                            facturas_detalle.Id AS detalleId,
                            ROUND((
                                facturas_detalle.Total
                            ),0) AS Valor,
                            personaempresa.nombre AS Nombre,
                            facturas_detalle.Concepto AS Concepto,
                            facturas_detalle.Codigo,
                            facturas_detalle.documentDetailIdBsale,
                            facturas.Id AS facturaId,
                            facturas.IVA
                        FROM
                            facturas
                        INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id
                        INNER JOIN personaempresa ON personaempresa.rut = facturas.Rut
                        WHERE
                            facturas.Id = '".$Id."'
                        AND facturas_detalle.Valor > 0";
            $facturas = $run->select($query);
            $array = array();

            if($facturas){
                $totalDetalles = count($facturas);
                foreach($facturas as $factura){
                    $data = $factura;
                    $Valor = $factura['Valor'];
                    $data['Valor'] = $Valor;
                    $data['facturaId'] = $factura['facturaId'];
                    $data['detalleId'] = $data['detalleId'];
                    $data['totalDetalles'] = $totalDetalles;
                    array_push($array,$data);
                }

                $response_array['array'] = $array;

                echo json_encode($response_array);
            }
        }

        public function storeFactura($RutId, $Grupo, $Tipo){

            if(in_array  ('curl', get_loaded_extensions())) {

                $response_array = array();
                if($Tipo == 1){
                    $query = "  SELECT facturas_detalle.*, facturas.FechaFacturacion, facturas.Rut, facturas.NumeroOC, IFNULL(facturas.FechaOC, '1970-01-31') as FechaOC, facturas.Referencia
                                FROM facturas 
                                INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id 
                                WHERE facturas.Id = '".$RutId."'
                                AND facturas.EstatusFacturacion = 0
                                AND facturas_detalle.Valor > 0";
                    // $expirationDate = time() + 1728000;
                    // $FechaVencimiento = date('Y-m-d', $expirationDate);
                }else if($Tipo == 2){
                    if($Grupo == 1000 OR $Grupo == 1001){
                        $Concat = " AND facturas.Id = '".$RutId."'";
                    }else{
                        $Concat = " AND facturas.Rut = '".$RutId."' AND facturas.Grupo = '".$Grupo."' AND facturas.TipoFactura = '".$Tipo."'";
                    }
                    $query = "  SELECT facturas_detalle.*, facturas.FechaFacturacion, facturas.Rut, facturas.NumeroOC, IFNULL(facturas.FechaOC, '1970-01-31') as FechaOC, facturas.Referencia
                                FROM facturas 
                                INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id 
                                WHERE facturas.EstatusFacturacion = 0
                                AND facturas_detalle.Valor > 0"                                 
                                .$Concat;
                    // $expirationDate = time() + 1728000;
                    // $FechaVencimiento = date('Y-m-d', $expirationDate);
                }else{
                    //else significa que se creo un servicio
                    $query = "  SELECT servicios.*, servicios.CostoInstalacion as Valor, servicios.CostoInstalacionDescuento as Descuento, ( CASE servicios.IdServicio WHEN 7 THEN servicios.NombreServicioExtra ELSE mantenedor_servicios.servicio END ) AS Servicio, '1' as Cantidad, 0 as NumeroOC, '1970-01-31' as FechaOC, 'Costo de instalación / Habilitación' as Concepto, 0 as Referencia
                                FROM servicios 
                                LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
                                WHERE servicios.Id = '".$RutId."'
                                AND servicios.EstatusFacturacion = 0
                                AND servicios.CostoInstalacion > 0";
                    // $expirationDate = time() + 604800;
                    // $FechaVencimiento = date('Y-m-d', $expirationDate);
                }

                $run = new Method;
                $Detalles = $run->select($query);
                $UfClass = new Uf(); 
                $UF = $UfClass->getValue();
                // $Detalles trae los datos de la tabla servicos asociados al servicios.Id
                if($Detalles){
                    $Detalle = $Detalles[0];
                    $Rut = $Detalle['Rut'];
                    $NumeroOC = $Detalle['NumeroOC'];
                    $FechaOC = $Detalle['FechaOC'];
                    // $Cliente trae los datos de la tabla personaempresa asociados al personaempresa.rut
                    $Cliente = $this->getCliente($Rut);

                    if($Cliente){
                        $TipoDocumento = $Cliente['tipo_cliente'];
                        //aqui el parametro 2 es para prueba con la API
                        $FacturaBsale = $this->sendFacturaBsale($Cliente,$Detalles,$UF,$Tipo,1);

                        if($FacturaBsale['status'] == 1){
                            $UrlPdf = $FacturaBsale['urlPdf'];
                            $DocumentoId = $FacturaBsale['id'];
                            $informedSii = $FacturaBsale['informedSii'];
                            $responseMsgSii = $FacturaBsale['responseMsgSii'];
                            $NumeroDocumento = $FacturaBsale['number'];
                            $FechaVencimiento = gmdate("Y-m-d", $FacturaBsale['expirationDate']);
                            // $FechaVencimiento = date('Y-m-d', $FacturaBsale['expirationDate']);
                           
                            
                        }else{
                            $response_array['Message'] = $FacturaBsale['Message'];
                            $response_array['status'] = 0;
                            echo json_encode($response_array);
                            return;
                            // $UrlPdf = '0';
                            // $DocumentoId = '0';
                            // $informedSii = '0';
                            // $responseMsgSii = '0';
                            // $NumeroDocumento = '0';
                        }
                        
                        //Para actualizar los datos del servicio con los datos de Bsale
                        $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, FechaOC) VALUES ('".$Rut."', '".$Grupo."', '".$Tipo."', '1', '".$DocumentoId."', '".$UrlPdf."', '".$informedSii."', '".$responseMsgSii."', NOW(), NOW(), '".$TipoDocumento."', '".$FechaVencimiento."', 0.19, '".$NumeroDocumento."', '".$NumeroOC."', '".$FechaOC."')";
                        $FacturaId = $run->insert($query);

                        if($FacturaId){
                            if($UrlPdf){
                                // $this->almacenarDocumento($FacturaId,1,$UrlPdf);
                                //aqui envia correos 
                                $this->enviarDocumento($FacturaId);
                                
                                
                            }
                            foreach($Detalles as $Detalle){
                                $Codigo = $Detalle['Codigo'];
                                $Valor = floatval($Detalle['Valor']);
                                if($Tipo == 1){
                                    $IdServicio = $Detalle['IdServicio'];
                                    $Concepto = $Detalle["Concepto"];
                                }else if($Tipo == 2){
                                    $IdServicio = $Detalle['IdServicio'];
                                    $Concepto = $Detalle["Concepto"];
                                }else{
                                    $IdServicio = $Detalle['Id'];
                                    $Concepto = $Detalle['Servicio'] . ' - ' . 'Costo de instalación / Habilitación';
                                    if($Detalle['Conexion']){
                                        $Concepto .= ' - ' . $Detalle['Conexion'];
                                    }
                                    if($Detalle["tipo_moneda"] == '2')
                                    $Valor = $Valor * $UF;
                                    else
                                    $Valor = $Valor;
                                }
                                $Descuento = $Detalle['Descuento'];
                                // if($Descuento > 0){
                                //     $Concepto .= ' - ' . $Descuento.'% Descuento';
                                // }
                                $Cantidad = $Detalle['Cantidad'];
                                $Neto = $Valor * $Cantidad;
                                $DescuentoValor = $Neto * ( $Descuento / 100 );
                                $Neto -= $DescuentoValor;
                                $Impuesto = $Neto * 0.19;
                                $Total = $Neto + $Impuesto;
                                $Total = round($Total,0);
                                //aqui comienza el cambio en la bd al facturar
                                $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Cantidad."', '".$Descuento."', '".$IdServicio."', '".$Total."', '".$Codigo."')";
                                $FacturaDetalleId = $run->insert($query);
                                if($Tipo == 3){
                                    if($FacturaDetalleId){
                                        $query = "UPDATE servicios SET EstatusFacturacion = '1', FechaFacturacion = NOW() WHERE Id = '".$IdServicio."'";
                                        $update = $run->update($query);
                                    }else{
                                        $query = "DELETE FROM facturas WHERE Id = '".$FacturaId."'";
                                        $delete = $run->delete($query,false);
                                        $query = "DELETE FROM facturas_detalle WHERE FacturaId = '".$FacturaId."'";
                                        $delete = $run->delete($query,false);
                                        $response_array['Message'] = 'Error Detalle';
                                        $response_array['status'] = 0;
                                        break;
                                    }
                                }
                            }
                            if($Tipo == 1){
                                $query = "SELECT Id FROM facturas WHERE Id = '".$RutId."'";
                                $facturas = $run->select($query);
                                foreach($facturas as $factura){
                                    $DeleteId = $factura['Id'];
                                    $query = "DELETE FROM facturas_detalle WHERE FacturaId = '".$DeleteId."'";
                                    $delete = $run->delete($query,false);
                                    $query = "DELETE FROM facturas WHERE Id = '".$DeleteId."'";
                                    $delete = $run->delete($query,false);
                                }
                            }else if($Tipo == 2){
                                $query = "SELECT Id FROM facturas WHERE EstatusFacturacion = 0".$Concat;
                                $facturas = $run->select($query);
                                foreach($facturas as $factura){
                                    $DeleteId = $factura['Id'];
                                    $query = "DELETE FROM facturas_detalle WHERE FacturaId = '".$DeleteId."'";
                                    $delete = $run->delete($query,false);
                                    $query = "DELETE FROM facturas WHERE Id = '".$DeleteId."'";
                                    $delete = $run->delete($query,false);
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

                $Facturas = explode(",", $Facturas);
                $UfClass = new Uf(); 
                $UF = $UfClass->getValue();
                // $expirationDate = time() + 1728000;
                // $FechaVencimiento = date('Y-m-d', $expirationDate);

                foreach($Facturas as $Factura){

                    if($Factura){

                        $response_array['Facturas'][$Factura] = array();
                        $RutGrupo = explode("-", $Factura);
                        $Rut = $RutGrupo[0];
                        $Grupo = $RutGrupo[1];

                        if($Grupo == 1000 OR $Grupo == 1001){
                            $Concat = " AND facturas.Id = '".$Rut."'";
                        }else{
                            $Concat = " AND facturas.Rut = '".$Rut."' AND facturas.Grupo = '".$Grupo."'";
                        }

                        $query = "  SELECT
                                        facturas_detalle.*,
                                        facturas.FechaFacturacion,
                                        facturas.Rut,
                                        facturas.NumeroOC, 
                                        IFNULL(facturas.FechaOC, '1970-01-31') as FechaOC, 
                                        facturas.Referencia
                                    FROM
                                        facturas
                                        INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id 
                                        AND facturas.TipoFactura = '2' 
                                        AND facturas.EstatusFacturacion = 0 
                                        AND facturas_detalle.Valor > 0"
                                        .$Concat;

                        $run = new Method;
                        $Detalles = $run->select($query);

                        if($Detalles){
                            $Detalle = $Detalles[0];
                            $Rut = $Detalle['Rut'];

                            $Cliente = $this->getCliente($Rut);

                            if($Cliente){

                                $TipoDocumento = $Cliente['tipo_cliente'];
                                //aqui2
                                $FacturaBsale = $this->sendFacturaBsale($Cliente,$Detalles,$UF,2,1);

                                if($FacturaBsale['status'] == 1){
                                    $UrlPdf = $FacturaBsale['urlPdf'];
                                    $DocumentoId = $FacturaBsale['id'];
                                    $informedSii = $FacturaBsale['informedSii'];
                                    $responseMsgSii = $FacturaBsale['responseMsgSii'];
                                    $NumeroDocumento = $FacturaBsale['number'];
                                    // $expirationDate = date('Y-m-d', $FacturaBsale['expirationDate']);
                                    $expirationDate = gmdate("Y-m-d", $FacturaBsale['expirationDate']);
                                }else{
                                    $response_array['Message'] = $FacturaBsale['Message'];
                                    $response_array['status'] = 0;
                                    echo json_encode($response_array);
                                    return;
                                    // $UrlPdf = '0';
                                    // $DocumentoId = '0';
                                    // $informedSii = '0';
                                    // $responseMsgSii = '0';
                                    // $NumeroDocumento = '0';
                                }

                                //Para actualizar los datos del servicios con los datos de Bsale

                                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES ('".$Rut."', '".$Grupo."', '2', '1', '".$DocumentoId."', '".$UrlPdf."', '".$informedSii."', '".$responseMsgSii."', NOW(), NOW(), '".$TipoDocumento."', '".$expirationDate."', 0.19, '".$NumeroDocumento."')";
                                $FacturaId = $run->insert($query);

                                if($FacturaId){
                                    if($UrlPdf){
                                        // $this->almacenarDocumento($FacturaId,1,$UrlPdf);
                                        $this->enviarDocumento($FacturaId); 
                                    }
                                    foreach($Detalles as $Detalle){
                                        $Codigo = $Detalle['Codigo'];
                                        $IdServicio = $Detalle['IdServicio'];
                                        $Valor = floatval($Detalle['Valor']);
                                        $Concepto = $Detalle["Concepto"];
                                        $Descuento = $Detalle['Descuento'];
                                        if($Descuento > 0){
                                            $Concepto .= ' - ' . $Descuento.'% Descuento';
                                        }
                                        $Cantidad = 1;
                                        $Neto = $Valor * $Cantidad;
                                        $DescuentoValor = $Neto * ( $Descuento / 100 );
                                        $Neto -= $DescuentoValor;
                                        $Impuesto = $Neto * 0.19;
                                        $Total = $Neto + $Impuesto;
                                        $Total = round($Total,0);

                                        $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Cantidad."', '".$Descuento."', '".$IdServicio."', '".$Total."', '".$Codigo."')";
                                        $FacturaDetalleId = $run->insert($query);
                                    }

                                    $response_array['Facturas'][$Factura]['Rut'] = $Rut;
                                    $response_array['Facturas'][$Factura]['Grupo'] = $Grupo;
                                    $response_array['Facturas'][$Factura]['UrlPdf'] = $UrlPdf;
                                    $response_array['status'] = 1; 

                                    $query = "SELECT Id FROM facturas WHERE EstatusFacturacion = 0".$Concat;
                                    $pagadas = $run->select($query);
                                    foreach($pagadas as $pagada){
                                        $DeleteId = $pagada['Id'];
                                        $query = "DELETE FROM facturas_detalle WHERE FacturaId = '".$DeleteId."'";
                                        $delete = $run->delete($query,false);
                                        $query = "DELETE FROM facturas WHERE Id = '".$DeleteId."'";
                                        $delete = $run->delete($query,false);
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
        // metodo para generar facturas automaticamente el 1ro de cada mes
        public function generarFacturas(){
            
            $run = new Method;
            
            $queryEstatusFacturacion = "UPDATE facturas SET EstatusFacturacion = '0' WHERE EstatusFacturacion = '3' ";
            $run->update($queryEstatusFacturacion);
           
            $Hoy = date('Y-m-d');
            // $dt = new DateTime('2019-04-01');
            $dt = new DateTime();
            $Anio = $dt->format('Y');
            //  las facturas que se generan cada mes son del mes anterior con el metodo generarMes disminuye 1 mes
            $MesFacturacion = $this->generarMes($dt);
            $Facturas = array();
            // el codigo comentado en la query es por una persona no puede tener mas de n facturas pendientes por facturar de n servicio
            // Ese n depende del tipo de cliente que sea
            // La consulta compara la cantidad de facturas pendientes con una columna en tipo cliente
            // Y si tiene mas facturas que en la columna, no entra al if
            $query = "  SELECT
                            s.*,
                            ( CASE s.IdServicio WHEN 7 THEN s.NombreServicioExtra ELSE ms.servicio END ) AS Servicio,
                            p.tipo_cliente AS TipoDocumento,
                            mtf.tipo_facturacion AS TipoFacturacion 
                        -- ,CASE
                        --         WHEN (
                        --             (
                        --             SELECT
                        --                 COUNT( fd.Id )
                        --             FROM
                        --                 facturas_detalle fd
                        --                 INNER JOIN facturas f ON f.Id = fd.FacturaId
                        --             WHERE
                        --                 s.Id = fd.IdServicio
                        --                 AND f.TipoFactura = 2
                        --                 AND f.EstatusFacturacion = 0
                        --             ) >= ( SELECT limite_facturas FROM clase_clientes WHERE id = p.clase_cliente )
                        --             OR ( SELECT limite_facturas FROM clase_clientes WHERE id = p.clase_cliente ) = 0
                        --             ) THEN
                        --             '0' ELSE '1'
                        --         END AS PermitirFactura
                            
                        FROM
                            servicios s
                            INNER JOIN personaempresa p ON s.Rut = p.rut
                            INNER JOIN mantenedor_servicios ms ON s.IdServicio = ms.IdServicio
                            INNER JOIN mantenedor_tipo_factura mtf ON s.TipoFactura = mtf.id 
                        WHERE
                            s.EstatusServicio = 1 OR s.EstatusServicio = 2";
            $Servicios = $run->select($query);

            if($Servicios){
                $UfClass = new Uf(); 
                $UF = $UfClass->getValue();
                $totalBoletas = 0;
                $totalFacturas = 0;
                $cantidadBoletas = 0;
                $cantidadFacturas = 0;
                $dataClient = array();
                // $dataClient['correos'] = 'dangel@teledata.cl';
                $dataClient['correos'] = 'sergio@teledata.cl, teledatadte@teledata.cl, fpezzuto@teledata.cl, kcardenas@teledata.cl, dangel@teledata.cl';

                foreach($Servicios as $Servicio){
                    $Id = $Servicio['Id'];
                    $FechaInicioDesactivacion = $Servicio['FechaInicioDesactivacion'];
                    $FechaFinalDesactivacion = $Servicio['FechaFinalDesactivacion'];
                    // $PermitirFactura = $Servicio['PermitirFactura'];
                    $PermitirFactura = 1;
                    $TipoFacturacion = $Servicio['TipoFacturacion'];
                    // FechaInicioDesactivacion y FechaFinalDesactivacion es por si tiene suspendido el servicio
                    if(($FechaInicioDesactivacion >= $Hoy OR $FechaFinalDesactivacion < $Hoy) && $PermitirFactura && $TipoFacturacion){
                        $FechaUltimoCobro = $Servicio['FechaUltimoCobro'];
                        $FechaUltimoCobro = new DateTime($FechaUltimoCobro);                        
                        $Concepto = $Servicio['Servicio'];
                        //TipoFacturacion = 1 es mensual, = 2 podria ser para semestral, aun no se usa, el 3 es para anual
                        if($TipoFacturacion == '1'){
                            // agrego 1 mes a fecha ultimo cobro para que no genere la factura nuevamente si le cobro el servicio por 1ra vez al finalizar tarea
                            $Concepto .= ' - Mes ' . $MesFacturacion;
                            $FechaUltimoCobro->add(new DateInterval("P1M"));
                        }elseif($TipoFacturacion == '2'){
                            // agrego 6 meses a fecha ultimo cobro
                            $MesUltimoCobro = $this->generarMes($FechaUltimoCobro);
                            $Concepto .= ' - Semestre '. $MesUltimoCobro . ' / ' . $MesFacturacion;
                            $FechaUltimoCobro->add(new DateInterval("P6M"));
                        }else{
                            $Concepto .= ' - Año ' . $Anio;
                            //agrego 1 ano a fecha ultimo cobro
                            $FechaUltimoCobro->add(new DateInterval("P1Y"));
                        }
                          // luego de agregar un mes, 6 meses o 1 año al ultimo cobro, comprueba si es <= a hoy
                        // toca cobrar, paso 1 mes
                        if($FechaUltimoCobro <= $dt){
                            $Rut = $Servicio['Rut'];
                            $Grupo = $Servicio['Grupo'];
                            $Conexion = $Servicio['Conexion'];
                            if($Conexion){
                                $Concepto .= ' - ' . $Conexion;
                            }
                            if(isset($Facturas[$Rut.'-'.$Grupo])){
                                $FacturaId = $Facturas[$Rut.'-'.$Grupo];
                            }else{
                                $TipoDocumento = $Servicio['TipoDocumento'];
                                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento) VALUES ('".$Rut."', '".$Grupo."', '2', '0', '0', '', '0', '', NOW(), NOW(), '".$TipoDocumento."', NOW(), 0.19, 0)";
                                $FacturaId = $run->insert($query);
                                $Facturas[$Rut.'-'.$Grupo] = $FacturaId;
                            }
                            if($FacturaId){
                                $Codigo = $Servicio['Codigo'];
                                $Valor = $Servicio['Valor'];
                                $Valor = $Valor * $UF;
                                $Descuento = $Servicio['Descuento'];
                                $Cantidad = 1;
                                $Neto = $Valor * $Cantidad;
                                $DescuentoValor = $Neto * ( $Descuento / 100 );
                                $Neto -= $DescuentoValor;
                                $Impuesto = $Neto * 0.19;
                                $Total = $Neto + $Impuesto;
                                $Total = round($Total,0);
                                $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Cantidad."', '".$Descuento."', '".$Id."', '".$Total."', '".$Codigo."')";
                                $detalle = $run->insert($query);
                                if($detalle){
                                    $PrimerDiaDelMes = date('Y-m-01');
                                    // $PrimerDiaDelMes = date('2019-01-01');
                                    $query = "UPDATE servicios SET FechaUltimoCobro = '".$PrimerDiaDelMes."' WHERE Id = '".$Id."'";
                                    $data = $run->update($query);
                                    if($TipoDocumento == '2'){
                                        $totalFacturas += $Total;
                                        $cantidadFacturas++;
                                    }else if($TipoDocumento == '1'){
                                        $totalBoletas += $Total;
                                        $cantidadBoletas++;
                                    }
                                }
                            }
                        }
                    }
                }
                $dataClient['asunto'] = 'Resumen de tarea automática para generar docs por lotes - Fecha '.date('d-m-Y');
                $dataClient['MensajeCorreo'] = ' Si existe alguna anomalía en los datos contacte al equipo encargado, gracias.';
                $dataClient['Subtitulo'] = 'Se encontraron '.$cantidadFacturas.' Facturas por un total de $'.$totalFacturas;
                $dataClient['Subtitulo'] .= ' y '.$cantidadBoletas.' Boletas por un total de $'.$totalBoletas;
                $dataClient['Subtitulo2'] = '';
                $dataClient['Parrafo'][0] = '';
                $dataClient['Parrafo'][1] = '';
                $dataClient['Parrafo'][2] = '';
                $dataClient['Parrafo'][3] = '';               
                $dataClient['Parrafo'][4] = '<p style="text-align:center !important;"><a href="http://teledata.cl/" target="_blank"><img style="display:center !important; float:center !important;" src="http://teledata.cl/images_web/logo-teledata-200.png" /></a></p>';
                $html = $run->plantillaCorreo($dataClient);
                $dataClient['HTML'] = $html;
                $respCorreo = $run->enviarCorreos(3, $dataClient);
            }

            $response_array['status'] = 1;

            echo json_encode($response_array);

        }
        public function getTotalesInstalacion(){
            $run = new Method;
            $UfClass = new Uf(); 
            $UF = $UfClass->getValue();
            $totalBoletas = 0;
            $totalFacturas = 0;
            $cantidadBoletas = 0;
            $cantidadFacturas = 0;

            // esto estaba cuando solo se calculaba UF en el case else del select
            // SUM( servicios.CostoInstalacion * '".$UF."' - ( ( servicios.CostoInstalacion * '".$UF."' ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ) AS Valor           
            $query = "  SELECT 
                            ( CASE servicios.tipo_moneda WHEN 2 THEN SUM( servicios.CostoInstalacion * '".$UF."' - ( ( servicios.CostoInstalacion * '".$UF."' ) * ( servicios.CostoInstalacionDescuento / 100 ) ) )
                            ELSE SUM( servicios.CostoInstalacion  - ( ( servicios.CostoInstalacion  ) * ( servicios.CostoInstalacionDescuento / 100 ) ) ) END ) AS Valor,
                            personaempresa.tipo_cliente as TipoDocumento
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
                            (servicios.EstatusInstalacion = 1 OR servicios.FacturarSinInstalacion = 1)
                        GROUP BY
                                servicios.Id";
                            // servicios.Rut,
                            // servicios.Grupo";

            $servicios = $run->select($query);
            foreach($servicios as $servicio){
                $Valor = $servicio['Valor'];
                $IVA = $servicio['Valor'] * 0.19;
                $Valor += $IVA;
                $Valor = round($Valor,0);
                if($servicio['TipoDocumento'] == '2'){
                    $totalFacturas += $Valor;
                    $cantidadFacturas++;
                }else{
                    $totalBoletas += $Valor;
                    $cantidadBoletas++;
                }
            }

            $array = array('totalFacturas' => $totalFacturas, 'totalBoletas' => $totalBoletas, 'cantidadFacturas' => $cantidadFacturas, 'cantidadBoletas' => $cantidadBoletas);
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
                                facturas_detalle.Total
                            ) AS Valor,
                            facturas.IVA
                        FROM 
                            facturas 
                        INNER JOIN 
                            facturas_detalle 
                        ON 
                            facturas_detalle.FacturaId = facturas.Id 
                        WHERE 
                            facturas.EstatusFacturacion = 0 
                        AND
                            facturas.TipoFactura = 2
                        AND 
                            facturas_detalle.Valor > 0
                        AND facturas.deleted_at IS NULL
                        GROUP BY
                            facturas.Rut,
                            facturas.Grupo,
                            facturas.TipoDocumento,
                            facturas.IVA";
            $facturas = $run->select($query);
            foreach($facturas as $factura){
                $Valor = $factura['Valor'];
                if($factura['TipoDocumento'] == '2'){
                    $totalFacturas += $Valor;
                    $cantidadFacturas++;
                }else if($factura['TipoDocumento'] == '1'){
                    $totalBoletas += $Valor;
                    $cantidadBoletas++;
                }
            }
            
            $array = array('totalFacturas' => $totalFacturas, 'totalBoletas' => $totalBoletas, 'cantidadFacturas' => $cantidadFacturas, 'cantidadBoletas' => $cantidadBoletas);
            return $array;
        }
        public function getTotalesIndividual(){
            $run = new Method;
            $totalBoletas = 0;
            $totalFacturas = 0;
            $cantidadBoletas = 0;
            $cantidadFacturas = 0;

            $query = "  SELECT    
                            facturas.TipoDocumento, 
                            SUM(
                                facturas_detalle.Total
                            ) AS Valor,
                            facturas.IVA
                        FROM 
                            facturas 
                        INNER JOIN 
                            facturas_detalle 
                        ON 
                            facturas_detalle.FacturaId = facturas.Id 
                        WHERE 
                            facturas.EstatusFacturacion = 0 
                        AND
                            facturas.TipoFactura = 1
                        AND 
                            facturas_detalle.Valor > 0
                        AND facturas.deleted_at IS NULL
                        GROUP BY
                            facturas.Id";
            $facturas = $run->select($query);
            foreach($facturas as $factura){
                $Valor = $factura['Valor'];
                if($factura['TipoDocumento'] == '2'){
                    $totalFacturas += $Valor;
                    $cantidadFacturas++;
                }else{
                    $totalBoletas += $Valor;
                    $cantidadBoletas++;
                }
            }
            
            $array = array('totalFacturas' => $totalFacturas, 'totalBoletas' => $totalBoletas, 'cantidadFacturas' => $cantidadFacturas, 'cantidadBoletas' => $cantidadBoletas);
            return $array;
        }

        function generarMes($dt){
            $Mes = $dt->format('m');
            if($Mes == 1)
            $Mes = 12;
            else
            $Mes--;

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
        // no se usa generarFacturacionAutomatica
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

                        $Cliente = $this->getCliente($Rut);
                        
                        if($Cliente){

                            $TipoDocumento = $Cliente['tipo_cliente'];

                            $query = "SELECT * FROM facturas_detalle WHERE FacturaId = '".$Id."'";
                            $Detalles = $run->select($query);

                            $FacturaBsale = $this->sendFacturaBsale($Cliente,$Detalles,0,2,1);
                            if($FacturaBsale['status'] == 1){
                                $UrlPdf = $FacturaBsale['urlPdf'];
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
                                $this->almacenarDocumento($Id,1,$UrlPdf);
                                $this->enviarDocumento($Id);
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
        //metodo usado para facturacion y facturacion por lotes
        public function sendFacturaBsale($Cliente,$Detalles,$UF,$Tipo,$TipoToken){
            // si se quiere enviar datos de prueba a la api usar el token 2 para pruebas, de lo contrario la cagaras 
            // $TipoToken = 2;
            $run = new Method;
            if($TipoToken == 1){
                $query = "SELECT token_produccion as access_token FROM variables_globales";
            }else{
                $query = "SELECT token_prueba as access_token FROM variables_globales";
            }
            $variables_globales = $run->select($query);
            $access_token = $variables_globales[0]['access_token'];
            $clientId = null;
            /*
            if($Cliente['cliente_id_bsale']){
                $clientId = $Cliente['cliente_id_bsale'];
            }else{

                //CONSULTA AL CLIENTE

                $url = 'https://api.bsale.cl/v1/clients.json?code='.$Cliente['rut'].'-'.$Cliente['dv'];

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
                */
                    if($Cliente['provincia']){
                        $Provincia = $Cliente['provincia'];
                    }else{
                        $Provincia = 'Llanquihue';
                    }

                    if($Cliente['ciudad']){
                        $Ciudad = $Cliente['ciudad'];
                    }else{
                        $Ciudad = 'Puerto Varas';
                    }

                    $clientId = null;
                    if($Cliente['tipo_cliente'] == "1"){
                        $Cliente['contacto'] = $Cliente['nombre'];
                    }
                    $client = array(
                        "code"          => $Cliente['rut'].'-'.$Cliente['dv'],
                        "firstName"     => $Cliente['contacto'],
                        "lastName"      => "",
                        "email"         => $Cliente['correo'],
                        "phone"         => $Cliente['telefono'],
                        "address"       => $Cliente['direccion'],
                        "company"       => $Cliente['nombre'],
                        "city"          => $Provincia,
                        "municipality"  => $Ciudad,
                        "activity"      => $Cliente['giro']
                    );
            //     }
            // }

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
            $Total = 0;
            
            foreach($Detalles as $Detalle){
                $Valor = floatval($Detalle['Valor']);
                if(isset($Detalle['Descripcion'])){
                    if($Detalle['Descripcion']){
                        if($Tipo == 1 || $Tipo == 2)
                        $Detalle['Concepto'] .=  ' - '.$Detalle['Descripcion'];
                    }
                }
                $Concepto = $Detalle["Concepto"];
                $Cantidad = $Detalle['Cantidad'];
                if($Tipo == 1){
                    $Descuento = $Detalle['Descuento'];
                }else if($Tipo == 2){
                    $Descuentos = $this->aplicarDescuento($Detalle);
                    $Descuento = $Descuentos['DescuentoAplicado'];
                    $CantidadAplicada = $Descuentos['CantidadAplicada'];
                    if($CantidadAplicada == 0){
                        $Extra = '';
                    }else if($CantidadAplicada == 1){
                        $Extra = ' ('.$CantidadAplicada.' Descuento Aplicado)';
                    }else{
                        $Extra = ' ('.$CantidadAplicada.' Descuentos Aplicados)';
                    }
                    if($Descuento > 0){
                        $Concat = ' - ' . $Descuento.'% Descuento' . $Extra;
                    }else{
                        $Concat = '';
                    }
                    $Concepto .= $Concat;
                    
                }else{
                    $Descuento = floatval($Detalle["Descuento"]);
                    if($Descuento > 0){
                        $Concat = ' - ' . $Descuento.'% Descuento';
                    }else{
                        $Concat = '';
                    }
                    $Concepto .= $Concat;
                    if(isset($Detalle["tipo_moneda"]) && $Detalle["tipo_moneda"] == '2')
                    $Valor = $Valor * $UF;
                    else
                    $Valor = $Valor;
                }

                $detail = array("netUnitValue" => $Valor, "quantity" => $Cantidad, "taxId" => "[1]", "comment" => $Concepto, "discount" => $Descuento);

                array_push($details,$detail);
                $Total += $Valor;
            }
            $Detalle = $Detalles[0];
            if(isset($Detalle['Referencia'])){
                $Referencia = $Detalle['Referencia'];
                if($Referencia){
                    $last_index = count($details) - 1;
                    $details[$last_index]['comment'] .= PHP_EOL . ' ' . $Referencia;
                }
            }

            $payments = array();
            $payment = array("paymentTypeId" => $Cliente['tipo_pago_bsale_id'], "amount" => $Total, "recordDate" => time());
            array_push($payments,$payment);

            if(isset($Detalle['NumeroOC'])){
                $NumeroOC = $Detalle['NumeroOC'];
                if($NumeroOC){
                    $FechaOC = $Detalle['FechaOC'];
                    if($FechaOC){
                        $dateTime = new DateTime($FechaOC); 
                    }else{
                        $dateTime = new DateTime(); 
                    } 
                    $FechaOC = $dateTime->format('U'); 
                    $references = array();
                    $reference = array("number" => $NumeroOC, "referenceDate" => $FechaOC, "reason" => "Orden de Compra " . $NumeroOC, "codeSii" => 801);
                    array_push($references,$reference);
                }
            }
            // para generar la fecha de vencimiento
            // tipo_pago trae por ejemplo 20 dias
            // El explode agarra el 20
            // Y lo multiplica por todos esos valores para generar un timestamp
            // Ese timestamp se le suma al time actual
            // Y genera una fecha de 20 días después pero en formato timestamñ
            // osea que si se esta facturando hoy, y el tipo de pago es 20 días, la fecha de vencimiento va a ser el 5 de diciembre
            //Eso solo se trabaja si el primer explode es un numero, sino es un numero, la fecha de vencimiento es el día de hoy
            // Eso es para los tipo de pago efectivo, débito, etc
            $tipo_pago = $Cliente['tipo_pago'];
            $Explode = explode(' ',$tipo_pago);
            // ctype_digit — Chequear posibles caracteres numéricos
            if(ctype_digit($Explode[0])){
                $expirationDate = time() + (intval($Explode[0]) * 24 * 60 * 60);
            }else{
                //daria el dia actual
                $expirationDate = time();
            }

            // $expirationDate = 1543186789; //2018/11/25
        
            
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

            if($Cliente['tipo_cliente'] == "2"){
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
                "details"           => $details,
                "payments"          => $payments
            );
            
            if(isset($references)){
                $array['references'] = $references;
            }

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
            // print_r($FacturaBsale); exit;
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

        //obtiene servicios inactivos
        public function getServiciosInactivos($Rut) {
            $run = new Method;
            $data = array();
            $data2 = array();
            $total_data = array();
            $activos = 0;
            $vencidos = 0;
            $servicio['Tipo'] = 'Sin data';
            $data['error'] = '';
            if(isset($Rut) && $Rut != '') {
                $query_servicios = "SELECT
                Id,
                Grupo,
                Valor,
                Codigo,
                EstatusServicio,
                Conexion,
                mantenedor_servicios.servicio as Tipo
                FROM servicios
                INNER JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
                WHERE Rut = $Rut AND EstatusServicio != 1";

                $servicios = $run->select($query_servicios);
                $total_servicios =  count($servicios);

                if($total_servicios > 0) {
                    foreach($servicios as $servicio) {
                        $data['Codigo'] = $servicio['Codigo'];
                        $data['Conexion'] = $servicio['Conexion'];
                        $data['Valor'] = $servicio['Valor'];
                        $data['Grupo'] = $servicio['Grupo'];
                        $data['Id'] = $servicio['Id'];
                        $data['Estatus'] = $servicio['EstatusServicio'];
                        $data['Tipo'] = $servicio['Tipo'];
                        array_push($total_data, $data);
                    }
                }
            } 
            else 
            {
                $data['error'] = 'No Existe el Rut para hacer la busqueda';
                array_push($total_data, $data);
            }
            return json_encode($total_data);
        }


         //obtiene servicio activos
         public function getServiciosActivos($Rut) {
            $run = new Method;
            $data = array();
            $data2 = array();
            $total_data = array();
            $activos = 0;
            $vencidos = 0;
            $servicio['Tipo'] = 'Sin data';
            $data['error'] = '';
            if(isset($Rut) && $Rut != '') {
                $query_servicios = "SELECT
                Id,
                Grupo,
                Valor,
                Codigo,
                EstatusServicio,
                Conexion,
                mantenedor_servicios.servicio as Tipo
                FROM servicios
                INNER JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
                WHERE Rut = $Rut AND EstatusServicio = 1";

                $servicios = $run->select($query_servicios);
                $total_servicios =  count($servicios);

                if($total_servicios > 0) {
                    foreach($servicios as $servicio) {
                        $data['Codigo'] = $servicio['Codigo'];
                        $data['Conexion'] = $servicio['Conexion'];
                        $data['Valor'] = $servicio['Valor'];
                        $data['Grupo'] = $servicio['Grupo'];
                        $data['Id'] = $servicio['Id'];
                        $data['Estatus'] = $servicio['EstatusServicio'];
                        $data['Tipo'] = $servicio['Tipo'];
                        array_push($total_data, $data);
                    }
                }
            } 
            else 
            {
                $data['error'] = 'No Existe el Rut para hacer la busqueda';
                array_push($total_data, $data);
            }
            return json_encode($total_data);
        }

        //obtiene total servicio activos y inactivos
        public function getServicios($Rut) {
            $run = new Method;
            $data = array();
            $total_data = array();
            $activos = 0;
            $vencidos = 0;
            if(isset($Rut) && $Rut != '') {
                $query_servicios = "SELECT
                EstatusServicio
                FROM servicios
                WHERE Rut = $Rut ";

                $servicios = $run->select($query_servicios);
                $total_servicios =  count($servicios);

                if($total_servicios > 0) {
                    foreach($servicios as $servicio) {
                        if($servicio['EstatusServicio'] == 1) {
                            $activos+= 1;
                        } else {
                            $vencidos+=1;
                        }
                    }
                    $data['error'] = '';
                } else {
                    $data['error'] = '';
                }
            } 
            else 
            {
                $data['error'] = 'No Existe el Rut para hacer la busqueda';

            }
            $data['activos'] = $activos;
            $data['vencidos'] = $vencidos;
            array_push($total_data, $data);
            
            return json_encode($total_data);
        }

        public function filtrarDocPagados($Rut){

            $run = new Method;
            $ToReturn = array();
            $data = array();
            $dia = date("d");
            $mes = date("m");
            $ano = date("Y");
            $fecha_actual = $ano.'-'.$mes.'-'.$dia;

            $query_factura = "  SELECT
                                    facturas.Id,
                                    facturas.NumeroDocumento,
                                    facturas.FechaFacturacion,
                                    mantenedor_tipo_cliente.nombre AS TipoDocumento,
                                    facturas.FechaVencimiento 
                                FROM
                                    facturas
                                    INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id 
                                WHERE
                                    Rut = $Rut 
                                    AND EstatusFacturacion = 1 
                                    AND FechaVencimiento < '".$fecha_actual."'";

            
            // echo $Rut;
            $FacturasVencidas = $run->select($query_factura);
            $total_facturas =  count($FacturasVencidas);
            // echo $total_facturas;
            $id_facturas = '';
            $NumeroDocumento = '';
            $FechaFacturacion = '';
            $TipoDocumento = '';
            $fechaVencimiento = '';
            $factura_detalle_FacturaId = '';
            $factura_detalle_Total = '';
            $contador_vencidos = 0;
            $monto_deuda = 0;
            $pagos = 0;
            $deuda_restante = 0;
            

            if($total_facturas > 0) {
                foreach($FacturasVencidas as $factura) {
                    $id_facturas = $factura['Id'];
                    $NumeroDocumento = $factura['NumeroDocumento'];
                    $TipoDocumento = $factura['TipoDocumento'];
                    $FechaFacturacion = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');
                    $fechaVencimiento = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');
                    if($fechaVencimiento < $fecha_actual) {
                        $query_facturas_detalle = "SELECT
                        Id,
                        FacturaId,
                        Total
                        FROM facturas_detalle
                        WHERE FacturaId = $id_facturas ";
                        $facturas_detalle = $run->select($query_facturas_detalle);
                        $total_facturas_detalle = count($facturas_detalle);
                        if($total_facturas_detalle > 0) {
                            foreach($facturas_detalle as $factura_detalle) {
                                $factura_detalle_FacturaId = $factura_detalle['FacturaId'];
                                $factura_detalle_Total = $factura_detalle['Total'];
                                // echo $factura_detalle_Total.'/';
                                $query_facturas_pagos = "SELECT
                                Id,
                                FacturaId,
                                Monto
                                FROM facturas_pagos
                                WHERE FacturaId = $factura_detalle_FacturaId";
                                $facturas_pagos = $run->select($query_facturas_pagos);
                                $total_facturas_pagos = count($facturas_pagos);
                                
                                if($total_facturas_pagos > 0) {
                                    foreach($facturas_pagos as $factura_pago) {
                                        $fp_facturaId = $factura_pago['FacturaId'];
                                        $fp_monto = $factura_pago['Monto'];
                                        if($fp_monto >= $factura_detalle_Total)
                                        {
                                             //pago que realizo el cliente
                                            $data['NumeroDocumento'] = $NumeroDocumento;
                                            $data['TipoDocumento'] = $TipoDocumento;
                                            $data['FechaFacturacion'] = $FechaFacturacion;
                                            $data['FechaVencimiento'] = $fechaVencimiento;
                                            $data['id_factura'] = $factura_detalle_FacturaId;
                                            $data['deuda'] = $factura_detalle_Total;
                                            $data['pagos'] = floatval($factura_pago['Monto']);
                                            $deuda_restante = $factura_detalle_Total - $factura_pago['Monto'];
                                            $data['deuda_restante'] = $deuda_restante;
                                            array_push($ToReturn, $data);
                                        } //else significa que no pago el total
                                        else {
                                            //resto de el total a pagar menos el pago del cliente
                                            $monto_deuda -= $fp_monto;
                                        }
                                    } //else significa que no ha pagado nada
                                } else {
                                    
                                }
                            }
                        }
                        
                    }
                    $contador_vencidos+=1;
                    $monto_deuda+=$factura_detalle_Total;
                }
            }	
            echo json_encode($ToReturn);
        }

        public function filtrarDocVencidos($Rut){

            $run = new Method;
            $ToReturn = array();
            $data = array();
            $data2 = array();
            $data3 = array();
            $fecha_actual = date("Y-m-d");

            $query_factura = "SELECT
            facturas.Id,
            facturas.NumeroDocumento,
            facturas.FechaFacturacion,
            mantenedor_tipo_cliente.nombre AS TipoDocumento,
            facturas.FechaVencimiento
            FROM facturas
            INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id
            WHERE Rut = $Rut AND EstatusFacturacion = 1 AND FechaVencimiento < '".$fecha_actual."' ";

            
            // echo $Rut;
            $FacturasVencidas = $run->select($query_factura);
            $total_facturas =  count($FacturasVencidas);
            // echo $total_facturas;
            $id_facturas = '';
            $NumeroDocumento = '';
            $FechaFacturacion = '';
            $TipoDocumento = '';
            $fechaVencimiento = '';
            $factura_detalle_FacturaId = '';
            $factura_detalle_Total = 0;
            $contador_vencidos = 0;
            $monto_deuda = 0;
            $fp_monto = 0;
            $pagos = 0;
            $bandera = 0;

            if($total_facturas > 0) {
                foreach($FacturasVencidas as $factura) {
                    $factura_detalle_Total = 0;
                    $id_facturas = $factura['Id'];
                    $NumeroDocumento = $factura['NumeroDocumento'];
                    $TipoDocumento = $factura['TipoDocumento'];
                    
                    $FechaFacturacion = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');
                    $fechaVencimiento = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');
                    
                    $query_facturas_detalle = "SELECT
                    Id,
                    FacturaId,
                    Total
                    FROM facturas_detalle
                    WHERE FacturaId = $id_facturas ";
                    $facturas_detalle = $run->select($query_facturas_detalle);
                    $total_facturas_detalle = count($facturas_detalle);
                    if($total_facturas_detalle > 0) {
                        foreach($facturas_detalle as $factura_detalle) {
                            $factura_detalle_FacturaId = $factura_detalle['FacturaId'];
                            $factura_detalle_Total += $factura_detalle['Total'];
                            $monto_deuda += $factura_detalle['Total'];
                            // echo $factura_detalle_Total.'/';
                            $query_facturas_pagos = "SELECT
                            Id,
                            FacturaId,
                            Monto
                            FROM facturas_pagos
                            WHERE FacturaId = $factura_detalle_FacturaId ";
                            // WHERE FacturaId = $factura_detalle_FacturaId AND Monto < '".$factura_detalle_Total."' ";
                            $facturas_pagos = $run->select($query_facturas_pagos);
                            $total_facturas_pagos = count($facturas_pagos);
                            if($total_facturas_pagos > 0) {
                            
                                foreach($facturas_pagos as $factura_pago) {
                                    $fp_facturaId = $factura_pago['FacturaId'];    
                                    $fp_monto = $factura_pago['Monto'];
                                    $monto_deuda = $factura_detalle_Total - $fp_monto;
                                    if($fp_monto < $factura_detalle_Total) {
                                        $factura_detalle_Total;
                                        $data['pagos'] = $fp_monto;
                                        $bandera = 0;
                                    }  else {
                                        $bandera = 1;
                                    } 
                                } //else significa que no ha pagado nada
                            } else {

                                $bandera = 0;
                                $fp_monto = 0;
                                $monto_deuda = $factura_detalle_Total;
                            }
                        }
                    }
                    if($bandera != 1) {
                        $data['NumeroDocumento'] = $NumeroDocumento;
                        $data['TipoDocumento'] = $TipoDocumento;
                        $data['FechaFacturacion'] = $FechaFacturacion;
                        $data['FechaVencimiento'] = $fechaVencimiento;
                        $data['id_factura'] = $factura_detalle_FacturaId;
                        $data['deuda'] = $factura_detalle_Total;
                        $data['pagos'] = $fp_monto;
                        $data['deuda_restante'] = $monto_deuda;
                        array_push($ToReturn, $data ); 
                    }
                   
                }
            }	
            echo json_encode($ToReturn);
        }

        public function filtrarDocEmitidos($Rut){
            $ToReturn = array();
            $data = array();
            $query = "  SELECT
            (SELECT SUM( Total ) FROM facturas_detalle WHERE FacturaId = facturas.Id ) AS Total,
            facturas.NumeroDocumento, 
            facturas.FechaFacturacion,
            facturas.FechaVencimiento,
            facturas_pagos.Detalle as Detalle,
            personaempresa.nombre AS Cliente,
            facturas_pagos.FechaPago AS FechaPago,
            facturas_pagos.Monto AS Pagado,
            mt.nombre AS tipo_Factura

            FROM
                facturas
                LEFT JOIN facturas_pagos ON facturas_pagos.FacturaId = facturas.Id
                LEFT JOIN personaempresa ON personaempresa.rut = facturas.Rut
                INNER JOIN mantenedor_tipo_cliente mt ON facturas.TipoDocumento = mt.id
            WHERE
                facturas.Rut = $Rut AND facturas.EstatusFacturacion = '1' ";

        
            $run = new Method;
            $documentos = $run->select($query);
            $Total = 0;
            $saldo_doc = 0;
            $saldo_favor = 0;
            // echo '<pre>'; print_r($documentos); echo '</pre>'; return;


            if (count($documentos) > 0) {
        
                foreach($documentos as $documento){
                    
                    $FechaFacturacion = \DateTime::createFromFormat('Y-m-d',$documento['FechaFacturacion'])->format('d-m-Y');
                    $fechaVencimiento = \DateTime::createFromFormat('Y-m-d',$documento['FechaVencimiento'])->format('d-m-Y');
                    $saldo_doc = $documento['Total'] - $documento['Pagado'];
                    $saldo_favor = $documento['Pagado'] - $documento['Total'];
                    
                    $data['NumeroDocumento'] = $documento['NumeroDocumento'];
                    $data['TipoDocumento'] = $documento['tipo_Factura'];
                    $data['FechaFacturacion'] = $FechaFacturacion;
                    $data['FechaVencimiento'] = $fechaVencimiento;
                    $data['deuda'] = $documento['Total'];
                    $data['saldo_doc'] = $saldo_doc;
                    $data['pagos'] = $saldo_favor;
                    array_push($ToReturn, $data ); 
            
                }   
            }
            echo json_encode($ToReturn);


        }


        public function filtrarFacturas($startDate,$endDate,$Rut,$documentType,$NumeroDocumento){
            $run = new Method;
            $ToReturn = array();
            $query = "  SELECT
                            personaempresa.nombre as Cliente,
                            facturas.Id,
                            facturas.NumeroDocumento,
                            facturas.FechaFacturacion,
                            facturas.FechaVencimiento,
                            facturas.UrlPdfBsale,
                            facturas.Grupo,
                            facturas.TipoFactura,
                            mantenedor_tipo_cliente.nombre AS TipoDocumento,
                            facturas.IVA,
                            facturas.EstatusFacturacion,
                            IFNULL( ( SELECT SUM( Monto ) FROM facturas_pagos WHERE FacturaId = facturas.Id ), 0 ) AS TotalSaldo 
                        FROM
                            facturas
                            INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id 
                            INNER JOIN personaempresa ON facturas.Rut = personaempresa.rut 
                        WHERE
                            facturas.EstatusFacturacion != '0' AND facturas.EstatusFacturacion != '3' ";
            if($startDate){
                $dt = \DateTime::createFromFormat('Y/m/d',$startDate);
                $startDate = $dt->format('Y-m-d');
                $dt = \DateTime::createFromFormat('Y/m/d',$endDate);
                $endDate = $dt->format('Y-m-d');
                $query .= " AND facturas.FechaFacturacion BETWEEN '".$startDate."' AND '".$endDate."'";
            }
            if($Rut || $Rut == 0 && !$startDate && !$NumeroDocumento){

                $query .= " AND facturas.Rut = '".$Rut."'";
            }
            if($documentType){
                $query .= " AND facturas.TipoDocumento = '".$documentType."'";
            }
            if($NumeroDocumento){
                $query .= " AND facturas.NumeroDocumento = '".$NumeroDocumento."'";
            }
            $facturas = $run->select($query);
            if($facturas){
                include("FacturasDetalleClass.php");
                $FacturasDetalle = new FacturasDetalle();
                foreach($facturas as $factura){
                    $SaldoConNotaCredito = 0;
                    $Id = $factura['Id'];
                    $IVA = $factura['IVA'];  
                    $EstatusFacturacion = $factura['EstatusFacturacion'];
                    $TotalFactura = 0;
                    $query = "SELECT Total, (Descuento + IFNULL((SELECT SUM(Porcentaje) FROM descuentos_aplicados WHERE IdDetalle = facturas_detalle.Id),0)) as Descuento FROM facturas_detalle WHERE FacturaId = '".$Id."'";
                    $detalles = $run->select($query);
                    foreach($detalles as $detalle){
                        $Total = $detalle['Total'];
                        $Descuento = floatval($detalle['Descuento']) / 100;
                        $Descuento = $Total * $Descuento;
                        $Total -= $Descuento;
                        // $TotalFactura += round($Total,0);
                        $TotalFactura += $Total;
                    }
                    $TotalFactura = round($TotalFactura,0);
                    $SaldoFavor = 0;
                    $TotalSaldo = $factura['TotalSaldo'];
                    $TotalSaldo = $TotalFactura - $TotalSaldo;
                    $SaldoFavor = $factura['TotalSaldo'] - $TotalFactura;
                    if($SaldoFavor < 0)
                        $SaldoFavor = 0;
                    if($TotalSaldo < 0){
                        $TotalSaldo = 0;
                    }
                    $TotalSaldoFactura = $TotalSaldo;
                    if($EstatusFacturacion != 2){
                        $Acciones = 1;
                    }
                    else{
                        $TotalSaldo = 0;
                        $Acciones = 0;
                        $query = "SELECT  DevolucionAmount FROM devoluciones WHERE FacturaId = '".$Id."'";
                        $devoluciones = $run->select($query);
                        if($devoluciones){
                            $devolucion = $devoluciones[0];
                            $SaldoConNotaCredito = $TotalFactura - $devolucion['DevolucionAmount'];
                            $TotalSaldo = $TotalFactura - (double)$devolucion['DevolucionAmount'];
                            $query = "SELECT  Monto FROM facturas_pagos WHERE FacturaId = '".$Id."'";
                            $pagos = $run->select($query);
                            $TotalPagado = 0;
                            if($pagos){
                                foreach ($pagos as $pago) {
                                    $TotalPagado += $pago['Monto'];
                                }
                            }
                            $TotalSaldo = $TotalSaldo - $TotalPagado;
                            if($TotalSaldo < 0){
                                $TotalSaldo = 0;
                            }
                            $Acciones = 2;
                        }
                    }
                    
                    $Id = $factura['Id'];
                    $data = array();
                    $Detalle = '*';
                    if($Rut || $Rut == 0 ){
                        $Detalle = $FacturasDetalle->GetDetalle($Id);
                        $Detalle = $Detalle[0]['Concepto'];
                    }
                   
                    $data['Id'] = $Id;
                    $data['DocumentoId'] = $Id;
                    $data['Cliente'] = $factura['Cliente'];
                    $data['NumeroDocumento'] = $factura['NumeroDocumento'];
                    $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaFacturacion'])->format('d-m-Y');        
                    $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$factura['FechaVencimiento'])->format('d-m-Y');
                    $data['Detalle'] = $Detalle;  
                    $data['TotalFactura'] = $TotalFactura;
                    $data['TotalSaldo'] = $TotalSaldo;
                    $data['SaldoFavor'] = $SaldoFavor;
                    $data['UrlPdfBsale'] = $factura['UrlPdfBsale'];
                    $data['Grupo'] = $factura['Grupo'];
                    $data['TipoDocumento'] = $factura['TipoDocumento'];
                    $data['Acciones'] = $Acciones;
                    $data['EstatusFacturacion'] = 1;
                    $data['SaldoConNotaCredito'] = $SaldoConNotaCredito;
                    array_push($ToReturn,$data);
                    if($EstatusFacturacion == 2){
                        $query = "SELECT Id, FechaDevolucion, NumeroDocumento, UrlPdfBsale, DevolucionAnulada, DevolucionAmount FROM devoluciones WHERE FacturaId = '".$Id."'";
                        if($startDate){
                            $query .= " AND FechaDevolucion BETWEEN '".$startDate."' AND '".$endDate."'";
                        }
                        $devoluciones = $run->select($query);
                        if($devoluciones){
                            $devolucion = $devoluciones[0];
                            $DevolucionAnulada = $devolucion['DevolucionAnulada'];
                            if($DevolucionAnulada == 0){
                                $Acciones = 1;
                            }else{
                                $Acciones = 0;
                            }
                            $data = array();
                            $data['Id'] = $devolucion['Id'];
                            $data['DocumentoId'] = $Id;
                            $data['Cliente'] = $factura['Cliente'];
                            $data['NumeroDocumento'] = $devolucion['NumeroDocumento'].' Doc. Ref '.$factura['NumeroDocumento'];
                            $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$devolucion['FechaDevolucion'])->format('d-m-Y');        
                            $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$devolucion['FechaDevolucion'])->format('d-m-Y');
                            $data['Detalle'] = '*';
                            $devolucion['DevolucionAmount'] = (double)$devolucion['DevolucionAmount']; 
                            $data['TotalFactura'] = $devolucion['DevolucionAmount'];
                            // $data['TotalSaldo'] = $devolucion['DevolucionAmount'];
                            $data['TotalSaldo'] = 0;
                            $data['SaldoFavor'] = $SaldoFavor;
                            $data['UrlPdfBsale'] = $devolucion['UrlPdfBsale'];
                            $data['Grupo'] = $factura['Grupo'];
                            $data['TipoDocumento'] = 'Nota de crédito';
                            $data['Acciones'] = $Acciones;
                            $data['EstatusFacturacion'] = 2;
                            $data['SaldoConNotaCredito'] = $TotalFactura - $devolucion['DevolucionAmount'];
                            array_push($ToReturn,$data);
                            if($DevolucionAnulada == 1){
                                $DevolucionId = $devolucion['Id'];
                                $query = "SELECT Id, FechaAnulacion, NumeroDocumento, UrlPdfBsale FROM anulaciones WHERE DevolucionId = '".$DevolucionId."'";
                                $anulaciones = $run->select($query);
                                if($anulaciones){
                                    $anulacion = $anulaciones[0];
                                    $data = array();
                                    $data['Id'] = $anulacion['Id'];
                                    $data['DocumentoId'] = $Id;
                                    $data['Cliente'] = $factura['Cliente'];
                                    $data['NumeroDocumento'] = $anulacion['NumeroDocumento'];
                                    $data['FechaFacturacion'] = \DateTime::createFromFormat('Y-m-d',$anulacion['FechaAnulacion'])->format('d-m-Y');        
                                    $data['FechaVencimiento'] = \DateTime::createFromFormat('Y-m-d',$anulacion['FechaAnulacion'])->format('d-m-Y');        
                                    $data['TotalFactura'] = $TotalFactura;
                                    $data['TotalSaldo'] = $TotalSaldoFactura;
                                    $data['SaldoFavor'] = $SaldoFavor;
                                    $data['UrlPdfBsale'] = $anulacion['UrlPdfBsale'];
                                    $data['Grupo'] = $factura['Grupo'];
                                    $data['TipoDocumento'] = 'Nota de debito';
                                    $data['EstatusFacturacion'] = 3;
                                    $data['SaldoConNotaCredito'] = 0;
                                    array_push($ToReturn,$data);
                                }
                            }
                        }
                    }
                    // por num doc para ver n de credito
                    // if($NumeroDocumento){
                    //     $query = "SELECT Id, FechaDevolucion, NumeroDocumento, UrlPdfBsale, DevolucionAnulada, DevolucionAmount FROM devoluciones WHERE NumeroDocumento = '".$NumeroDocumento."'";
                    // }
                }
            }
            echo json_encode($ToReturn);
        }
        public function getPagos($id){
            $run = new Method;
            $ToReturn = array();

            $query = "  SELECT
                            facturas_pagos.*,
                            mantenedor_tipo_pago.nombre AS TipoPago,
                            usuarios.nombre AS Usuario 
                        FROM
                            facturas_pagos
                            INNER JOIN mantenedor_tipo_pago ON facturas_pagos.TipoPago = mantenedor_tipo_pago.id
                            LEFT JOIN usuarios ON facturas_pagos.IdUsuarioSession = usuarios.id 
                        WHERE
                            facturas_pagos.FacturaId = '".$id."'";

            $pagos = $run->select($query);

            if($pagos){

                foreach($pagos as $pago){

                    $data = array();
                    $data['Id'] = $pago['Id'];
                    $data['FechaPago'] = \DateTime::createFromFormat('Y-m-d',$pago['FechaPago'])->format('d-m-Y');    
                    $data['Monto'] = doubleval($pago['Monto']);    
                    $data['TipoPago'] = $pago['TipoPago'];
                    $data['Detalle'] = $pago['Detalle'];
                    $data['Usuario'] = $pago['Usuario'];
                    if($pago['TipoPago'] != 'Cheque al dia'){
                        $data['FechaEmisionCheque'] = 'N/A';        
                        $data['FechaVencimientoCheque'] = 'N/A';
                    }else{
                        $data['FechaEmisionCheque'] = \DateTime::createFromFormat('Y-m-d',$pago['FechaEmisionCheque'])->format('d-m-Y');        
                        $data['FechaVencimientoCheque'] = \DateTime::createFromFormat('Y-m-d',$pago['FechaVencimientoCheque'])->format('d-m-Y');
                    }
                    
                    array_push($ToReturn,$data);
                }
            }

            return $ToReturn;
        }
        public function getPagoNotaCredito($id){
            $run = new Method;
            $ToReturn = array();

            $query = "  SELECT
                            DevolucionAmount
                        FROM
                            devoluciones
                        WHERE
                            FacturaId = '".$id."'";
            $DevolucionAmount = $run->select($query);
            $data = array();
            $TotalDevolucion = 0;
            if($DevolucionAmount){
                foreach($DevolucionAmount as $Devolucion){
                    $TotalDevolucion = $Devolucion['DevolucionAmount'];   
                }
            }
            $data['TotalDevolucion'] = (double)($TotalDevolucion);
            return $data;
        }
        public function storePago($FacturaId,$FechaPago,$TipoPago,$Monto,$FechaEmisionCheque,$FechaVencimientoCheque){
            $response_array = array();
            $FacturaId = $_POST['FacturaId'];
            $FechaPago = $_POST['FechaPago'];
            $TipoPago = $_POST['TipoPago'];
            
            $Monto = $_POST['Monto'];
            $FechaEmisionCheque = $_POST['FechaEmisionCheque'];
            $FechaVencimientoCheque = $_POST['FechaVencimientoCheque'];
            $idUsuario = $_SESSION['idUsuario'];
            
            $FacturaId = isset($FacturaId) ? trim($FacturaId) : "";
            $FechaPago = isset($FechaPago) ? trim($FechaPago) : "";
            $TipoPago = isset($TipoPago) ? trim($TipoPago) : "";
            
            $Monto = isset($Monto) ? trim($Monto) : "";
            $FechaEmisionCheque = isset($FechaEmisionCheque) ? trim($FechaEmisionCheque) : "";
            $FechaVencimientoCheque = isset($FechaVencimientoCheque) ? trim($FechaVencimientoCheque) : "";

            if(!empty($FacturaId) && !empty($FechaPago) && !empty($TipoPago) && !empty($Monto)){

                $FechaPago = DateTime::createFromFormat('d-m-Y', $FechaPago)->format('Y-m-d');
                if($FechaEmisionCheque){
                    $FechaEmisionCheque = DateTime::createFromFormat('d-m-Y', $FechaEmisionCheque)->format('Y-m-d');
                }else{
                    $FechaEmisionCheque = '1969-01-31';
                }
                if($FechaVencimientoCheque){
                    $FechaVencimientoCheque = DateTime::createFromFormat('d-m-Y', $FechaVencimientoCheque)->format('Y-m-d');
                }else{
                    $FechaVencimientoCheque = '1969-01-31';
                }
                $array = array();

                $query = "INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Monto, FechaEmisionCheque, FechaVencimientoCheque, IdUsuarioSession) VALUES ('".$FacturaId."','".$FechaPago."','".$TipoPago."','".$Monto."','".$FechaEmisionCheque."','".$FechaVencimientoCheque."','".$idUsuario."')";
                $run = new Method;
                $id = $run->insert($query);
                if($id){
                    $ToReturn = 1; 
                }else{
                    $ToReturn = 0; 
                }

            }else{
                $ToReturn = 2; 
            }

            return $ToReturn;
        }
        public function deletePago($id){
            $query = "DELETE FROM facturas_pagos WHERE Id = ".$id;
            $run = new Method;
            $data = $run->delete($query);
            return $data;
        }
        public function getCliente($Rut){
            $run = new Method;
            $query = "  SELECT
                            personaempresa.*, provincias.nombre AS provincia,
                            ciudades.nombre AS ciudad,
                            mantenedor_tipo_pago_bsale.nombre AS tipo_pago
                        FROM
                            personaempresa
                        INNER JOIN ciudades ON personaempresa.ciudad = ciudades.id
                        INNER JOIN provincias ON ciudades.provincia_id = provincias.id
                        INNER JOIN mantenedor_tipo_pago_bsale ON personaempresa.tipo_pago_bsale_id = mantenedor_tipo_pago_bsale.id
                        WHERE
                            personaempresa.rut = '".$Rut."'";
            $Cliente = $run->select($query);
            if($Cliente){
                return $Cliente[0];
            }else{
                return array();
            }
        }
        public function getOC($RutId, $Grupo, $Tipo){
            if($Tipo == 1){
                $query = "  SELECT facturas.NumeroOC, IFNULL(facturas.FechaOC, '1970-01-31') as FechaOC
                            FROM facturas 
                            WHERE facturas.Id = '".$RutId."'
                            AND facturas.EstatusFacturacion = 0";
            }else if($Tipo == 2){
                if($Grupo == 1000 OR $Grupo == 1001){
                    $Concat = " AND facturas.Id = '".$RutId."'";
                }else{
                    $Concat = " AND facturas.Rut = '".$RutId."' AND facturas.Grupo = '".$Grupo."'";
                }
                $query = "  SELECT facturas.NumeroOC, IFNULL(facturas.FechaOC, '1970-01-31') as FechaOC
                            FROM facturas 
                            WHERE facturas.TipoFactura = '".$Tipo."'
                            AND facturas.EstatusFacturacion = 0"
                            .$Concat;
            }else{
                $query = "  SELECT 0 as NumeroOC, '1970-01-31' as FechaOC
                            FROM servicios 
                            WHERE servicios.Id = '".$RutId."'
                            AND servicios.EstatusFacturacion = 0
                            AND servicios.CostoInstalacion > 0";
            }
            $run = new Method;
            $Detalles = $run->select($query);
            if($Detalles){
                $Detalle = $Detalles[0];
                $NumeroOC = $Detalle['NumeroOC'];
                $FechaOC = $Detalle['FechaOC'];
                if(!$FechaOC OR $FechaOC == '1970-01-31'){
                    $FechaOC = '';
                }
            }
            return array('NumeroOC' => $NumeroOC, 'FechaOC' => $FechaOC);
        }
        public function storeOC($RutId, $Grupo, $Tipo, $NumeroOC, $FechaOC){
            if($Tipo == 1){
                $query = "  UPDATE facturas SET NumeroOC = '".$NumeroOC."', FechaOC = '".$FechaOC."' WHERE Id = '".$RutId."'";
            }else if($Tipo == 2){
                if($Grupo == 1000 OR $Grupo == 1001){
                    $query = "  UPDATE facturas SET NumeroOC = '".$NumeroOC."', FechaOC = '".$FechaOC."' WHERE Id = '".$RutId."'";
                }else{
                    $query = "  UPDATE facturas SET NumeroOC = '".$NumeroOC."', FechaOC = '".$FechaOC."' WHERE Rut = '".$RutId."' AND Grupo = '".$Grupo."' AND TipoFactura = '".$Tipo."' AND EstatusFacturacion = 0";
                }
            }else{
                $query = "  UPDATE servicios SET NumeroOC = '".$NumeroOC."', FechaOC = '".$FechaOC."' WHERE Id = '".$RutId."'";
            }
            $run = new Method;
            $update = $run->update($query);
            return $update;
        }

        public function showPrefactura($RutId, $Grupo, $Tipo){
            if(in_array  ('curl', get_loaded_extensions())) {
                $response_array = array();
                if($Tipo == 1){
                    $query = "  SELECT facturas_detalle.*, facturas.FechaFacturacion, facturas.Rut, facturas.NumeroOC, IFNULL(facturas.FechaOC, '1970-01-31') as FechaOC, facturas.Referencia, servicios.Descripcion
                                FROM facturas 
                                INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id
                                LEFT JOIN servicios ON servicios.Id = facturas_detalle.IdServicio
                                WHERE facturas.Id = '".$RutId."'
                                AND facturas.EstatusFacturacion = 0
                                AND facturas_detalle.Valor > 0";
                    $NombrePdf = $RutId.'_'.'1';
                }else if($Tipo == 2){
                    if($Grupo == 1000 OR $Grupo == 1001){
                        $Concat = " AND facturas.Id = '".$RutId."'";
                    }else{
                        $Concat = " AND facturas.Rut = '".$RutId."' AND facturas.Grupo = '".$Grupo."'";
                    }
                    $query = "  SELECT facturas_detalle.*, facturas.FechaFacturacion, facturas.Rut, facturas.NumeroOC, IFNULL(facturas.FechaOC, '1970-01-31') as FechaOC, facturas.Referencia, servicios.Descripcion
                                FROM facturas 
                                INNER JOIN facturas_detalle ON facturas_detalle.FacturaId = facturas.Id
                                INNER JOIN servicios ON servicios.Id = facturas_detalle.IdServicio
                                WHERE facturas.TipoFactura = '".$Tipo."'
                                AND facturas.EstatusFacturacion = 0
                                AND facturas_detalle.Valor > 0"
                                .$Concat;
                    $NombrePdf = $RutId.'_'.$Grupo.'_'.$Tipo;
                }else{
                    $query = "  SELECT servicios.*, servicios.CostoInstalacion as Valor, servicios.CostoInstalacionDescuento as Descuento, ( CASE servicios.IdServicio WHEN 7 THEN servicios.NombreServicioExtra ELSE mantenedor_servicios.servicio END ) AS Servicio, '1' as Cantidad, 0 as NumeroOC, '1970-01-31' as FechaOC, ( CASE  WHEN  servicios.Descripcion = '' THEN 'Costo de instalación / Habilitación' ELSE servicios.Descripcion END ) AS Concepto, 0 as Referencia
                                FROM servicios 
                                LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
                                WHERE servicios.Id = '".$RutId."'
                                AND servicios.EstatusFacturacion = 0
                                AND servicios.CostoInstalacion > 0";
                    $NombrePdf = $RutId.'_'.'2';
                }

                $UrlLocal = "/var/www/html/Teledata/facturacion/prefacturas/".$NombrePdf.".pdf";
                
                $run = new Method;
                $Detalles = $run->select($query);
                // if(!file_exists("/var/www/html/Teledata/facturacion/prefacturas/".$NombrePdf.".pdf") || $Tipo == 2){
                if($NombrePdf || $Tipo == 2){
                    $run = new Method;
                    $Detalles = $run->select($query);
                    $UfClass = new Uf(); 
                    $UF = $UfClass->getValue();
                    
                    if($Detalles){
                        
                        $Detalle = $Detalles[0];
                        // print_r($Detalles); exit;
                        $Rut = $Detalle['Rut'];
                        $Cliente = $this->getCliente($Rut);
                        if($Cliente){
                            // el parametro 2 es para la API de prueba
                            $FacturaBsale = $this->sendFacturaBsale($Cliente,$Detalles,$UF,$Tipo,2);
                            if($FacturaBsale['status'] == 1){
                                $urlPdf = $FacturaBsale['urlPdf'];
                                // version 2 para grabar los datos del pdf
                                // $PdfContent = $run->obtenerPDF($urlPdf);
                                // version 1 para grabar los datos del pdf
                                // $PdfContent = file_get_contents($urlPdf);
                                // if($PdfContent){
                                    // $UrlLocal = "/var/www/html/Teledata/facturacion/prefacturas/".$NombrePdf.".pdf";
                                    // aqui
                                    // $UrlLocal = "http://localhost/LUIS/Teledata/facturacion/prefacturas/".$NombrePdf.".pdf";
                                    
                                    // file_put_contents($UrlLocal, $PdfContent);
                                    // $response_array['NombrePdf'] = $NombrePdf;
                                    $response_array['NombrePdf'] = $urlPdf;
                                    $response_array['status'] = 1;
                                // }else{
                                //     $response_array['Message'] = 'Error al obtener los datos '.$urlPdf. ' PdfContent '.$PdfContent;
                                //     $response_array['status'] = 5;
                                // }
                                
                            }else{
                                $response_array['Message'] = $FacturaBsale['Message'];
                                $response_array['status'] = 0;
                            }
                        }else{
                            $response_array['Message'] = 'Error cliente';
                            $response_array['status'] = 4;
                        }
                    }else{
                        $response_array['Message'] = 'Error detalle';
                        $response_array['status'] = 3;
                    }
                }else{
                    $response_array['NombrePdf'] = $NombrePdf;
                    $response_array['status'] = 1;
                }
            }else{
                $response_array['Message'] = 'Error curl';
                $response_array['status'] = 99;
            }
            //esto envia correo con la prefactura para ver como se enviaran los correos
            // $respCorreo = $this->enviarDocumentoPrefactura($RutId, $Tipo, $Grupo,  $UrlLocal);
            return $response_array;
        }

        public function storeDevolucion($Id, $Motivo, $tipoNotaCredito = false, $DetallesSeleccionados = false){

            if(in_array  ('curl', get_loaded_extensions())) {
                if($DetallesSeleccionados){
                    $DetallesSeleccionados = explode(",", $DetallesSeleccionados);
                }
                $response_array = array();
                $query = "  SELECT
                                Rut,
                                DocumentoIdBsale
                            FROM
                                facturas
                            WHERE
                                Id = '".$Id."'";

                $run = new Method;
                $Facturas = $run->select($query);

                if($Facturas){

                    $Factura = $Facturas[0];
                    $Rut = $Factura['Rut'];
                    $DocumentoIdBsale = $Factura['DocumentoIdBsale'];
                    $Cliente = $this->getCliente($Rut);
                    if($Cliente){
                        // echo 'Dentro de storeDevolucion DetallesSeleccionados es '.$DetallesSeleccionados; echo "\n";
                        $DevolucionBsale = $this->sendDevolucionBsale($Cliente,$DocumentoIdBsale,$Motivo,1, $tipoNotaCredito, $DetallesSeleccionados);

                        if($DevolucionBsale['status'] == 1){
                            $DevolucionIdBsale = $DevolucionBsale['id'];
                            $priceAdjustment = $DevolucionBsale['priceAdjustment'];
                            $editTexts = $DevolucionBsale['editTexts'];
                            $DevolucionAmount = (double)$DevolucionBsale['amount'];
                            $NotaCredito = $DevolucionBsale['credit_note'];
                            $DocumentoIdBsale = $NotaCredito['id'];
                        }else{
                            $response_array['Message'] = $DevolucionBsale['Message'];
                            $response_array['tipo'] = 'Devolucion';
                            $response_array['status'] = 0;
                            echo json_encode($response_array);
                            return;
                        }
                        $DocumentoBsale = $this->getDocumentoBsale($DocumentoIdBsale,1);
                        if($DocumentoBsale['status'] == 1){
                            $UrlPdf = $DocumentoBsale['urlPdf'];
                            $NumeroDocumento = $DocumentoBsale['number'];
                        }else{
                            $response_array['Message'] = $DocumentoBsale['Message'];
                            $response_array['status'] = 'Documento';
                            echo json_encode($response_array);
                            return;
                        }
                        if($UrlPdf){                        
                            // $this->almacenarDocumento($Id,2,$UrlPdf);
                            // $respCorreo = $run->enviarCorreos(2, $dataClient);
                            // echo 'Insert Nota de Credito '.$respCorreo; echo "\n";
                        }

                        $query = "INSERT INTO devoluciones(FacturaId, DevolucionIdBsale, DocumentoIdBsale, UrlPdfBsale, Motivo, FechaDevolucion, HoraDevolucion, NumeroDocumento, DevolucionAnulada, DevolucionAmount, priceAdjustment, editTexts) VALUES ('".$Id."', '".$DevolucionIdBsale."', '".$DocumentoIdBsale."', '".$UrlPdf."','".$Motivo."', NOW(), NOW(),'".$NumeroDocumento."', '0', '".$DevolucionAmount."', '".$priceAdjustment."', '".$editTexts."' )";
                        $DevolucionId = $run->insert($query);

                        if($DevolucionId){
              
                            $query = "UPDATE facturas SET EstatusFacturacion = '2', FechaFacturacion = NOW() WHERE Id = '".$Id."'";
                            $update = $run->update($query);
                            $dataClient = array();
                            // $dataClient['correos'] = 'dangel@teledata.cl';
                            $dataClient['correos'] = 'teledatadte@teledata.cl, kcardenas@teledata.cl, cjurgens@teledata.cl, fpezzuto@teledata.cl, esalas@teledata.cl, dangel@teledata.cl';
                            $dataClient['asunto'] = 'Nota de Crédito #'.$NumeroDocumento .' Doc. Referencia ';
                            $dataClient['UrlPdf'] = $UrlPdf;
                            $dataClient['TipoDoc'] = 'Nota de Crédito';
                            $this->enviarDocumento($Id, $dataClient);
                            $response_array['Id'] = $Id;
                            $response_array['UrlPdf'] = $UrlPdf;
                            $response_array['status'] = 1; 

                        }else{
                            $response_array['Message'] = 'Error Devolucion';
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
        public function getDetallesDocumentoBsale($referenceDocumentId,$access_token, $type = 1, $DetallesSeleccionados = false){
            $url='https://api.bsale.cl/v1/documents/'.$referenceDocumentId.'/details.json';
            // echo 'Dentro de getDetallesDocumentoBsale getDetallesDocumentoBsale es '.print_r($getDetallesDocumentoBsale); echo "\n"; exit;
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
            $DetallesBsale = json_decode($response, true);
            $details = array();
            if(isset($DetallesBsale['items'])){
                foreach($DetallesBsale['items'] as $Detalle){
                    $documentDetailId = $Detalle['id'];
                    if($type == 1 OR $type == 3){
                        $unitValue = 0;
                    }else{
                        // devolución para ajustar el precio de los productos
                        $unitValue = $Detalle['netUnitValue'];
                        
                    }
                    if($type == 2 OR $type == 3){
                        $quantity = 0;
                    }else{
                        $quantity = $Detalle['quantity'];
                    }
                    if($type == 2){
                        $run = new Method;
                        // print_r($DetallesSeleccionados);exit;
                        $encontrado = $run->encontrarEnArray($DetallesSeleccionados, $documentDetailId);
                        // echo "documentDetailId ".$documentDetailId." documentDetailId".$documentDetailId; echo "\n";
                        if($encontrado){
                            // echo "entro"; echo "\n";
                            $detail = array("documentDetailId" => $documentDetailId, "unitValue" => $unitValue, "quantity" => $quantity);
                            array_push($details,$detail);
                        }
                    }else{
                        // echo "Entro en otro tipo"; "\n";
                        $detail = array("documentDetailId" => $documentDetailId, "unitValue" => $unitValue, "quantity" => $quantity);
                        array_push($details,$detail);
                    }
                    
                }
            }
            return $details;
        }
        public function getReferenciasDocumentoBsale($referenceDocumentId,$access_token){
            $url='https://api.bsale.cl/v1/documents/'.$referenceDocumentId.'/references.json';

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
            $ReferenciasBsale = json_decode($response, true);
            $references = array();
            foreach($ReferenciasBsale['items'] as $Referencia){
                $NumeroOC = $Referencia['number'];
                $FechaOC = $Referencia['referenceDate'];
                $reference = array("number" => $NumeroOC, "referenceDate" => $FechaOC, "reason" => "Orden de Compra " . $NumeroOC, "codeSii" => 801);
                array_push($references,$reference);
            }
            return $references;
        }
        public function sendDevolucionBsale($Cliente,$referenceDocumentId,$motive,$TipoToken, $tipoNotaCredito = false, $DetallesSeleccionados = false){
            // echo 'Dentro de sendDevolucionBsale DetallesSeleccionados es '.$DetallesSeleccionados; echo "\n";
            $run = new Method;
            if($TipoToken == 1){
                $query = "SELECT token_produccion as access_token FROM variables_globales";
            }else{
                $query = "SELECT token_prueba as access_token FROM variables_globales";
            }
            $variables_globales = $run->select($query);
            $access_token = $variables_globales[0]['access_token'];
            $details = $this->getDetallesDocumentoBsale($referenceDocumentId,$access_token, $tipoNotaCredito, $DetallesSeleccionados);
            // print_r($details);
            if($Cliente['provincia']){
                $Provincia = $Cliente['provincia'];
            }else{
                $Provincia = 'Llanquihue';
            }

            if($Cliente['ciudad']){
                $Ciudad = $Cliente['ciudad'];
            }else{
                $Ciudad = 'Puerto Varas';
            }
            $client = array(
                "code"          => $Cliente['rut'].'-'.$Cliente['dv'],
                "firstName"     => $Cliente['contacto'],
                "lastName"      => "",
                "email"         => $Cliente['correo'],
                "phone"         => $Cliente['telefono'],
                "address"       => $Cliente['direccion'],
                "company"       => $Cliente['nombre'],
                "city"          => $Provincia,
                "municipality"  => $Ciudad,
                "activity"      => $Cliente['giro']
            );

            //CREACION DE LA DEVOLUCION

            $url='https://api.bsale.cl/v1/returns.json';

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
            $priceAdjustment = 0;
            $editTexts = 0;
            if($tipoNotaCredito == 2){
                $priceAdjustment = 1;
            }
            if($tipoNotaCredito == 3){
                $editTexts = 1;
            }
            //CONSTRUCCION DEL ARRAY DE DEVOLUCION

            $array = array(
                "documentTypeId"        => 2,
                "officeId"              => 1,
                "referenceDocumentId"   => $referenceDocumentId,
                "emissionDate"          => time(),
                "expirationDate"        => time(),
                "motive"                => $motive,
                "declareSii"            => 1,
                "priceAdjustment"       => $priceAdjustment,
                "editTexts"             => $editTexts,
                "type"                  => 0,
                "details"               => $details,
                "client"                => $client
            );
            // Parsea a JSON
            $data = json_encode($array);

            // Agrega parámetros
            curl_setopt($session, CURLOPT_POSTFIELDS, $data);

            // Ejecuta cURL
            $response = curl_exec($session);

            // // Cierra la sesión cURL
            curl_close($session);

            //Esto es sólo para poder visualizar lo que se está retornando
            $DevolucionBsale = json_decode($response, true);
            $DocumentoId = isset($DevolucionBsale['id']) ? trim($DevolucionBsale['id']) : "";
            if($DocumentoId){
                $DevolucionBsale['status'] = 1;
            }else{
                $Message = $DevolucionBsale['error'];
                $DevolucionBsale = array();
                $DevolucionBsale['Message'] = $Message;
                $DevolucionBsale['status'] = 0;
            }
            return $DevolucionBsale;
        }
        public function getDocumentoBsale($Id,$TipoToken){
            $run = new Method;
            if($TipoToken == 1){
                $query = "SELECT token_produccion as access_token FROM variables_globales";
            }else{
                $query = "SELECT token_prueba as access_token FROM variables_globales";
            }
            $variables_globales = $run->select($query);
            $access_token = $variables_globales[0]['access_token'];

            $url='https://api.bsale.cl/v1/documents/'.$Id.'.json?expand=[details]';

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

            //Esto es sólo para poder visualizar lo que se está retornando
            $DocumentoBsale = json_decode($response, true);
            $DocumentoId = isset($DocumentoBsale['id']) ? trim($DocumentoBsale['id']) : "";
            if($DocumentoId){
                $DocumentoBsale['status'] = 1;
            }else{
                $Message = $DocumentoBsale['error'];
                $DocumentoBsale = array();
                $DocumentoBsale['Message'] = $Message;
                $DocumentoBsale['status'] = 0;
            }
            return $DocumentoBsale;
        }
        public function anularDevolucion($Id){

            if(in_array  ('curl', get_loaded_extensions())) {

                $response_array = array();
                $query = "  SELECT
                                DevolucionIdBsale, DocumentoIdBsale, FacturaId
                            FROM
                                devoluciones
                            WHERE
                                Id = '".$Id."'";

                $run = new Method;
                $Devoluciones = $run->select($query);

                if($Devoluciones){

                    $Devolucion = $Devoluciones[0];
                    $DevolucionIdBsale = $Devolucion['DevolucionIdBsale'];
                    $DocumentoIdBsale = $Devolucion['DocumentoIdBsale'];
                    $AnulacionBsale = $this->sendAnulacionBsale($DevolucionIdBsale,$DocumentoIdBsale,1);

                    if($AnulacionBsale['status'] == 1){
                        $AnulacionIdBsale = $AnulacionBsale['id'];
                        $NotaDebito = $AnulacionBsale['debit_note'];
                        $DocumentoIdBsale = $NotaDebito['id'];
                    }else{
                        $response_array['Message'] = $AnulacionBsale['Message'];
                        $response_array['tipo'] = 'Anulacion';
                        $response_array['status'] = 0;
                        echo json_encode($response_array);
                        return;
                    }
                    $DocumentoBsale = $this->getDocumentoBsale($DocumentoIdBsale,1);
                    if($DocumentoBsale['status'] == 1){
                        $UrlPdf = $DocumentoBsale['urlPdf'];
                        $NumeroDocumento = $DocumentoBsale['number'];
                    }else{
                        $response_array['Message'] = $DocumentoBsale['Message'];
                        $response_array['status'] = 'Documento';
                        echo json_encode($response_array);
                        return;
                    }
                    if($UrlPdf){     
                        $FacturaId = $Devolucion['FacturaId'];                   
                        // $this->almacenarDocumento($FacturaId,3,$UrlPdf);
                        // $this->enviarDocumento($FacturaId);
                        
                    }

                    $query = "INSERT INTO anulaciones(DevolucionId, AnulacionIdBsale, DocumentoIdBsale, UrlPdfBsale, FechaAnulacion, HoraAnulacion, NumeroDocumento) VALUES ('".$Id."', '".$AnulacionIdBsale."', '".$DocumentoIdBsale."', '".$UrlPdf."', NOW(), NOW(),'".$NumeroDocumento."')";
                    $DevolucionId = $run->insert($query);

                    if($DevolucionId){
            
                        $query = "UPDATE devoluciones SET DevolucionAnulada = '1', FechaDevolucion = NOW() WHERE Id = '".$Id."'";
                        $update = $run->update($query);
                                
                        $response_array['Id'] = $Id;
                        $response_array['UrlPdf'] = $UrlPdf;
                        $response_array['status'] = 1; 

                    }else{
                        $response_array['Message'] = 'Error Anulacion';
                        $response_array['status'] = 0;
                    }
                 
                }else{
                    $response_array['status'] = 3;
                }
            }else{
                $response_array['status'] = 99;
            }

            echo json_encode($response_array);
        }
        public function sendAnulacionBsale($DevolucionId,$referenceDocumentId,$TipoToken){
            $run = new Method;
            if($TipoToken == 1){
                $query = "SELECT token_produccion as access_token FROM variables_globales";
            }else{
                $query = "SELECT token_prueba as access_token FROM variables_globales";
            }
            $variables_globales = $run->select($query);
            $access_token = $variables_globales[0]['access_token'];

            //CREACION DE LA ANULACION

            $url='https://api.bsale.cl/v1/returns/'.$DevolucionId.'/annulments.json';

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

            //CONSTRUCCION DEL ARRAY DE DEVOLUCION

            $array = array(
                "documentTypeId"        => 17,
                "referenceDocumentId"   => $referenceDocumentId,
                "emissionDate"          => time(),
                "expirationDate"        => time(),
                "declareSii"            => 1
            );

            // Parsea a JSON
            $data = json_encode($array);

            // Agrega parámetros
            curl_setopt($session, CURLOPT_POSTFIELDS, $data);

            // Ejecuta cURL
            $response = curl_exec($session);

            // // Cierra la sesión cURL
            curl_close($session);

            //Esto es sólo para poder visualizar lo que se está retornando
            $AnulacionBsale = json_decode($response, true);
            $DocumentoId = isset($AnulacionBsale['id']) ? trim($AnulacionBsale['id']) : "";
            if($DocumentoId){
                $AnulacionBsale['status'] = 1;
            }else{
                $Message = $AnulacionBsale['error'];
                $AnulacionBsale = array();
                $AnulacionBsale['Message'] = $Message;
                $AnulacionBsale['status'] = 0;
            }
            return $AnulacionBsale;
        }
        public function getReferencia($RutId, $Grupo, $Tipo){
            if($Tipo == 1){
                $query = "  SELECT Referencia
                            FROM facturas 
                            WHERE facturas.Id = '".$RutId."'
                            AND facturas.EstatusFacturacion = 0";
            }else if($Tipo == 2){
                if($Grupo == 1000 OR $Grupo == 1001){
                    $Concat = " AND facturas.Id = '".$RutId."'";
                }else{
                    $Concat = " AND facturas.Rut = '".$RutId."' AND facturas.Grupo = '".$Grupo."'";
                }
                $query = "  SELECT Referencia
                            FROM facturas 
                            WHERE facturas.TipoFactura = '".$Tipo."'
                            AND facturas.EstatusFacturacion = 0"
                            .$Concat;
            }else{
                $query = "  SELECT 0 as Referencia
                            FROM servicios 
                            WHERE servicios.Id = '".$RutId."'
                            AND servicios.EstatusFacturacion = 0
                            AND servicios.CostoInstalacion > 0";
            }
            $run = new Method;
            $Detalles = $run->select($query);
            if($Detalles){
                $Detalle = $Detalles[0];
                $Referencia = $Detalle['Referencia'];
            }else{
                $Referencia = '';
            }
            return array('Referencia' => $Referencia);
        }
        public function storeReferencia($RutId, $Grupo, $Tipo, $Referencia){
            if($Tipo == 1){
                $query = "  UPDATE facturas SET Referencia = '".$Referencia."' WHERE Id = '".$RutId."'";
            }else if($Tipo == 2){
                if($Grupo == 1000 OR $Grupo == 1001){
                    $query = "  UPDATE facturas SET Referencia = '".$Referencia."' WHERE Id = '".$RutId."'";
                }else{
                    $query = "  UPDATE facturas SET Referencia = '".$Referencia."' WHERE Rut = '".$RutId."' AND Grupo = '".$Grupo."' AND TipoFactura = '".$Tipo."' AND EstatusFacturacion = 0";
                }
            }else{
                $query = "  UPDATE servicios SET Referencia = '".$Referencia."' WHERE Id = '".$RutId."'";
            }
            $run = new Method;
            $update = $run->update($query);
            return $update;
        }
        public function deleteFactura($RutId, $Grupo, $Tipo){
            $response_array = array();
            $run = new Method;
            if($Tipo == 1){
                $query = "  SELECT Id
                            FROM facturas 
                            WHERE facturas.Id = '".$RutId."'";
            }else if($Tipo == 2){
                if($Grupo == 1000 OR $Grupo == 1001){
                    $Concat = " AND facturas.Id = '".$RutId."'";
                }else{
                    $Concat = " AND facturas.Rut = '".$RutId."' AND facturas.Grupo = '".$Grupo."' AND facturas.TipoFactura = '".$Tipo."'";
                }
                $query = "  SELECT Id
                            FROM facturas 
                            WHERE facturas.EstatusFacturacion = 0"                                 
                            .$Concat;
            }else{
                $query = "  SELECT Id
                            FROM servicios  
                            WHERE servicios.Id = '".$RutId."'";
            }
            $facturas = $run->select($query);
            foreach($facturas as $factura){
                $Id = $factura['Id'];
                if($Tipo != 3){
                    $query = "UPDATE facturas SET deleted_at = NOW() WHERE Id = '".$Id."'";
                    $delete = $run->delete($query);
                }else{
                    $query = "UPDATE servicios SET CostoInstalacionBackup = servicios.CostoInstalacion, CostoInstalacion = 0 WHERE Id = '".$Id."'";
                    $delete = $run->update($query);
                }
            }
            $response_array['status'] = 1;
            echo json_encode($response_array);
        }
        // funcion para contar el total de documentos segun su tipo
        public static function countDocumentos($tipo, $urlbsale){
            $run = new Method;
            $query = "SELECT token_produccion as access_token FROM variables_globales";
            $variables_globales = $run->select($query);
            $access_token = $variables_globales[0]['access_token'];
            //Total DOCUMENTOS
            if($tipo == 1){
                $url='https://api.bsale.cl/v1/documents.json';
            }elseif($tipo == 2){
                //Total Notas de Creditos
                $url='https://api.bsale.cl/v1/returns.json';
            }elseif($tipo == 3){
                $url = $urlbsale;
            }
            // Total Notas de Debito
            // en proceso
            
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
            $Documents = json_decode($response, true);
            if($tipo == 3){
                return $Documents;
            }else{
                return $Documents['count'];
            }
            
        }
        // metodo para sincronizar fac de bsale al ERP
        public function sincronizarConBsale(){
            $run = new Method;
            $query = "SELECT token_produccion as access_token FROM variables_globales";
            $variables_globales = $run->select($query);
            $access_token = $variables_globales[0]['access_token'];
            // para traer todos los documentos se pasa el 1
            // $limitDocumentos = self::countDocumentos(1, '');
            $url='https://api.bsale.cl/v1/documents.json';
            $limitDocumentos = $run->contador(1, $url);
            //DOCUMENTOS
            
            $url='https://api.bsale.cl/v1/documents.json?expand=[references,client,details]&limit='.$limitDocumentos;
            
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
            $DocumentosBsale = json_decode($response, true);
            $dataClient = array();
            $dataClient['correos'] = 'teledatadte@teledata.cl, kcardenas@teledata.cl, cjurgens@teledata.cl, fpezzuto@teledata.cl, esalas@teledata.cl, dangel@teledata.cl';
            $dataClient['asunto'] = '';
            $dataClient['MensajeCorreo'] = '';
            $ContadorFacActualiza = 0;
            $ContadorFacInserta = 0;
            foreach($DocumentosBsale['items'] as $DocumentoBsale){
                $DocumentoId = $DocumentoBsale['id'];
                $document_type = $DocumentoBsale['document_type'];
                $TipoDocumento = $document_type['id'];
                if($TipoDocumento == 22){
                    $TipoDocumento = 1;
                }else if($TipoDocumento == 5){
                    $TipoDocumento = 2;
                }else{
                    $TipoDocumento = 3;
                }
                if($TipoDocumento == 1 OR $TipoDocumento == 2){
                    $query = "SELECT Id, UrlPdfBsale, CountDTE, DocumentoIdBsale FROM facturas WHERE DocumentoIdBsale = '".$DocumentoId."'";
                    $Factura = $run->select($query);
                    // echo '<pre>'; print_r($Factura); echo '</pre>';exit;
                    if(!$Factura){
                        $UrlPdf = $DocumentoBsale['urlPdf'];
                        $informedSii = $DocumentoBsale['informedSii'];
                        $responseMsgSii = $DocumentoBsale['responseMsgSii'];
                        $NumeroDocumento = $DocumentoBsale['number'];
                        // $FechaFacturacion = date('Y-m-d', $DocumentoBsale['emissionDate']);
                        $FechaFacturacion = gmdate('Y-m-d', $DocumentoBsale['emissionDate']);
                        // $HoraFacturacion = date('H:i:s', $DocumentoBsale['emissionDate']);
                        $HoraFacturacion = gmdate('H:i:s', $DocumentoBsale['emissionDate']);
                        // $FechaVencimiento = date('Y-m-d', $DocumentoBsale['expirationDate']);
                        $FechaVencimiento = gmdate('Y-m-d', $DocumentoBsale['expirationDate']);
                        $references = $DocumentoBsale['references'];
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
                        $client = $DocumentoBsale['client'];
                        $code = $client['code'];
                        $Explode = explode('-',$code);
                        $Rut = $Explode[0];
                        if($Rut){
                            $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale,
                             responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, NumeroDocumento, NumeroOC, 
                             FechaOC, CountDTE) VALUES ('".$Rut."', '".$Grupo."', '4', '1', '".$DocumentoId."', '".$UrlPdf."', '".$informedSii."', '".$responseMsgSii."', '".$FechaFacturacion."', '".$HoraFacturacion."', '".$TipoDocumento."', '".$FechaVencimiento."', 0.19, '".$NumeroDocumento."', '".$NumeroOC."', '".$FechaOC."', '".$referencesCount."')";
                            $Id = $run->insert($query);
                            if($Id){
                                $ContadorFacInserta += 1;
                                $dataClient['asunto'] = 'Sincronización de Documento desde bsale a la BD del ERP ';
                                $dataClient['MensajeCorreo'] .= 'Se ha insertado el Doc Rut: <b>'.$code.'</b> N Doc:<b>'.$NumeroDocumento.'</b> desde Bsale a la BD del ERP <br> PDF Doc Bsale:'. $UrlPdf.' <br> <b> Por favor verificar que los datos concuerden con los reales.</b> <br> Gracias.<br><br><br>';
                                $details = $DocumentoBsale['details'];
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
                                        // $dte_code = self::countDocumentos(3, $dte_code);
                                        $dte_code = $run->contador(3, $dte_code);
                                        $url = $dte_code['href'];
                                        $dtecodeID = $dte_code['id'];
                                        $name = $dte_code['name'];
                                        $codeSii = $dte_code['codeSii'];
                                        $state = $dte_code['state'];
                                        $query = "INSERT INTO dte_code(url, dte_code_id, name, codeSii, state, FacturaId, DocumentoIdBsale) VALUES ('".$url."', '".$dtecodeID."', '".$name."', '".$codeSii."', '".$state."', '".$Id."', '".$DocumentoId."')";
                                        $FacturaDTEId = $run->insert($query);
                                    }
                                }
                            }
                        }
                    }else{
                        $Id = $Factura[0]['Id'];
                        $UrlPdf = $Factura[0]['UrlPdfBsale'];
                        $DocumentoIdBsale = $Factura[0]['DocumentoIdBsale'];
                        $NumeroDocumento = $DocumentoBsale['number'];
                        //actualizo los datos de las facturas en la bd
                        
                        $informedSii = $DocumentoBsale['informedSii'];
                        $responseMsgSii = $DocumentoBsale['responseMsgSii'];
                        $FechaFacturacion = gmdate('Y-m-d', $DocumentoBsale['emissionDate']);
                        $FechaVencimiento = gmdate('Y-m-d', $DocumentoBsale['expirationDate']);
                        $references = $DocumentoBsale['references'];
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
                        $client = $DocumentoBsale['client'];
                        $code = $client['code'];
                        $Explode = explode('-',$code);
                        $Rut = $Explode[0];
                        if($Rut){
                            $query = "UPDATE facturas set informedSiiBsale = '".$informedSii."', responseMsgSiiBsale = '".$responseMsgSii."',  FechaFacturacion = '".$FechaFacturacion."',
                                    FechaVencimiento = '".$FechaVencimiento."', NumeroOC = '".$NumeroOC."', FechaOC = '".$FechaOC."', CountDTE = '".$referencesCount."'
                                    WHERE DocumentoIdBsale = '".$DocumentoIdBsale."' ";
                            $update = $run->update2($query);
                            //envia correo al actualizar facturas
                            // if($update){
                            //     $ContadorFacActualiza += 1;
                            //     $dataClient['asunto'] = 'Sincronización de Documento desde bsale a la BD del ERP ';
                            //     $dataClient['MensajeCorreo'] .= 'Se ha actualizado el Doc Rut: <b>'.$code.'</b> N Doc:<b>'.$NumeroDocumento.'</b> desde Bsale a la BD del ERP <br> PDF Doc Bsale:'. $UrlPdf.' <br> <b> Por favor verificar que los datos concuerden con los reales.</b> <br> Gracias.<br><br><br>';
                            // }
                            $query = "SELECT COUNT(*) AS `totalDTE` FROM dte_code WHERE DocumentoIdBsale = '".$DocumentoId."' ";
                            $TotalDTE = $run->select($query);
                            $totalDTE = $TotalDTE[0]['totalDTE'];
                            if($referencesCount != $totalDTE){
                                $query = "DELETE FROM dte_code WHERE DocumentoIdBsale = '".$DocumentoIdBsale."' ";
                                $delete = $run->delete($query, false);
                                if($delete && $referencesCount > 0 ){
                                    //si existen references, exiten dte_code y los inserta
                                    if($references){
                                        
                                        foreach($references as $reference){
                                            $dte_code = $reference['dte_code'];
                                            $dte_code = $dte_code['href'];
                                            // el 3 es para traer datos de https://api.bsale.cl/v1/dte_codes/20.json y obtener info del dte_code
                                            // $dte_code = self::countDocumentos(3, $dte_code);
                                            $dte_code = $run->contador(3, $dte_code);
                                            $url = $dte_code['href'];
                                            $dtecodeID = $dte_code['id'];
                                            $name = $dte_code['name'];
                                            $codeSii = $dte_code['codeSii'];
                                            $state = $dte_code['state'];
                                            $query = "INSERT INTO dte_code(url, dte_code_id, name, codeSii, state, FacturaId, DocumentoIdBsale) VALUES ('".$url."', '".$dtecodeID."', '".$name."', '".$codeSii."', '".$state."', '".$Id."', '".$DocumentoId."')";
                                            $FacturaDTEId = $run->insert($query);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                    if($Id){   
                        // $this->almacenarDocumento($Id,1,$UrlPdf);
                    }
                }
            }

            if($ContadorFacActualiza || $ContadorFacInserta){
                $respCorreo = $run->enviarCorreos(2, $dataClient);
                // echo 'Insert Fac O Upd '.$respCorreo; echo "\n";
            }

            // para saber si existen facturas desde bsale con TipoFactura = 4 significa que deben actualizar ese campo
            // a TipoFactura = 1 es para facturas de servicios individuales, 2 es para facturas de servicios que pueden ser con grupo, 
            // grupo con oc, sin grupo, estas saldran en por facturacion por lotes o TipoFactura = 3 es para facturas de Instalacion individuales
            // esto es necesario para analizar de manera mas comoda los informes facturas de servicios 
            $queryTipoFac = "SELECT * FROM facturas WHERE TipoFactura = 4";
            $FacturaTipo = $run->select($queryTipoFac);
            if($FacturaTipo){
                $TotalFacs = count($FacturaTipo);
                $dataClient['TotalTipoFac'] = $TotalFacs;
                $dataClient['asunto'] = 'Cambiar Campo TipoFactura = 4 en la BD';
                $dataClient['MensajeCorreo'] = 'Se encontraron '.$TotalFacs;
                $dataClient['MensajeCorreo'] .= ' Facturas con el campo TipoFactura = 4, esto ocurre por defecto al sincronizar las facturas de bsale que no se encuentran en la BD del ERP, por favor pongase en contacto con el administrador de la BD para que modifique el valor, gracias.';
                $dataClient['Subtitulo'] = 'Cambiar Campo(s) TipoFactura = 4 en la BD.';
                $dataClient['Subtitulo2'] = '<h4>Uso del campo TipoFactura</h4>';
                $dataClient['Parrafo'][0] = '<p>1 - En la tabla de facturas el TipoFactura = 1 es para facturas de servicios individuales generados por nota de venta, estas saldran en facturacion individual</p>';
                $dataClient['Parrafo'][1] = '<p>2 - En la tabla de facturas el TipoFactura = 2 es para facturas de servicios que pueden ser con grupo, grupo con oc, sin grupo, estas saldran en facturacion por lotes</p>';
                $dataClient['Parrafo'][2] = '<p>3 - En la tabla de facturas el TipoFactura = 3 es para facturas de Instalacion individuales generados por nota de venta, estas saldran en facturacion individual</p>';
                $dataClient['Parrafo'][3] = '<p>4 - En la tabla de facturas el TipoFactura = 4 fue encontrada en bsale pero no en el ERP y por lo tanto fue sincronizada.</p>';	
                $dataClient['Parrafo'][4] = '<p style="text-align:center !important;"><a href="http://teledata.cl/" target="_blank"><img style="display:center !important; float:center !important;" src="http://teledata.cl/images_web/logo-teledata-200.png" /></a></p>';
                // echo '<pre>'; print_r($dataClient); echo '</pre>';
                // exit;
                $html = $run->plantillaCorreo($dataClient);
                $dataClient['HTML'] = $html;
                $respCorreo = $run->enviarCorreos(3, $dataClient);
            }
            $dataClient['asunto'] = '';
            $dataClient['MensajeCorreo'] = '';
            $contadorDevolucion = 0;
            $contadorErrorDevolucion = 0;
            $contadorActulizaDevolucion = 0;
            //total DEVOLUCIONES con el parametro 2
            $url='https://api.bsale.cl/v1/returns.json';
            // $limitDevoluciones = self::countDocumentos(2, '');
            $limitDevoluciones = $run->contador(2, $url);
            $url='https://api.bsale.cl/v1/returns.json?expand=[credit_note]&limit='.$limitDevoluciones;

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
            $DevolucionesBsale = json_decode($response, true);
            $dataClient['asunto'] = 'Nota de Crédito | Sincronización de Documento';
            foreach($DevolucionesBsale['items'] as $DevolucionBsale){
                $DevolucionIdBsale = $DevolucionBsale['id'];
                $DevolucionAmount = (double)$DevolucionBsale['amount'];
                $query = "SELECT FacturaId, UrlPdfBsale FROM devoluciones WHERE DevolucionIdBsale = '".$DevolucionIdBsale."'";
                $Devolucion = $run->select($query);
                if(!$Devolucion){
                    $DocumentoIdBsale = $DevolucionBsale['reference_document']['id'];
                    $query = "SELECT Id FROM facturas WHERE DocumentoIdBsale = '".$DocumentoIdBsale."'";
                    $Factura = $run->select($query);
                    if($Factura){
                        $FacturaId = $Factura[0]['Id'];
                        $credit_note = $DevolucionBsale['credit_note'];
                        $UrlPdf = $credit_note['urlPdf'];
                        $Motivo = $DevolucionBsale['motive'];
                        $FechaDevolucion = gmdate('Y-m-d', $DevolucionBsale['returnDate']);
                        $HoraDevolucion = gmdate('H:i:s', $DevolucionBsale['returnDate']);
                        $NumeroDocumento = $credit_note['number'];
                        $query = "INSERT INTO devoluciones(FacturaId, DevolucionIdBsale, DocumentoIdBsale, UrlPdfBsale, Motivo, FechaDevolucion, HoraDevolucion, NumeroDocumento, DevolucionAmount) VALUES ('".$FacturaId."', '".$DevolucionIdBsale."', '".$DocumentoIdBsale."', '".$UrlPdf."','".$Motivo."', '".$FechaDevolucion."', '".$HoraDevolucion."','".$NumeroDocumento."', '".$DevolucionAmount."')";
                        // echo $query; echo "\n";
                        $DevolucionId = $run->insert($query);
                        if($DevolucionId){  
                            $contadorDevolucion += 1;
                            $dataClient['MensajeCorreo'] .= 'Insertada | Se ha sincronizado la Nota de Crédito N Doc:<b>'.$NumeroDocumento.'</b> desde Bsale a la BD del ERP <br> PDF Doc Bsale:'. $UrlPdf.' <br> <b> Por favor verificar que los datos concuerden con los reales.</b> <br> Gracias.<br><br><br>';
    
                            $query = "UPDATE facturas SET EstatusFacturacion = 2 WHERE Id = '".$FacturaId."'";
                            $update = $run->update($query);
                        }else{
                            $contadorErrorDevolucion += 1;
                            $dataClient['MensajeCorreo'] .= 'Ocurrio un Error al tratar de insertar la Nota de Crédito N Doc:<b>'.$NumeroDocumento.'</b> desde Bsale a la BD del ERP <br> PDF Doc Bsale:'. $UrlPdf.' <br> <b> Por favor Notificar el inconveniente.</b> <br> Gracias.<br><br><br>';
                            
                        }
                    }
                }else{
                    $FacturaId = $Devolucion[0]['FacturaId'];
                    $UrlPdf = $Devolucion[0]['UrlPdfBsale'];
                    $FechaDevolucion = gmdate('Y-m-d', $DevolucionBsale['returnDate']);
                    $credit_note = $DevolucionBsale['credit_note'];
                    $NumeroDocumento = $credit_note['number'];
                    // si se necesitare actualizar un monto de devolucion, descomentar la query de abajo
                    $query = "UPDATE devoluciones SET DevolucionAmount = '".$DevolucionAmount."' WHERE DevolucionIdBsale = '".$DevolucionIdBsale."'";
                    // $update = $run->update2($query);
                    // if($update){
                    //     $contadorActulizaDevolucion += 1;
                    //     $dataClient['MensajeCorreo'] .= 'Actualizada | Nota de Crédito N Doc:<b>'.$NumeroDocumento.'</b> se ha actualizo el Monto <b>'.$DevolucionAmount.'</b> desde Bsale a la BD del ERP <br> PDF Doc Bsale:'. $UrlPdf.' <br> <b> Por favor verificar que los datos son correctos.</b> <br> Gracias.<br><br><br>';
                    // }
                }
                if($FacturaId){   
                    // $this->almacenarDocumento($FacturaId,2,$UrlPdf);
                }
            }
            if($contadorDevolucion || $contadorErrorDevolucion || $contadorActulizaDevolucion){
                $respCorreo = $run->enviarCorreos(2, $dataClient);
                // echo '$contadorDevolucion || $contadorErrorDevolucion || $contadorActulizaDevolucion '.$respCorreo; echo "\n";
            }
            

            //NOTAS DE DEBITO
            /*
            $url='https://api.bsale.cl/v1/documents.json?documenttypeid=17';

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
            $DocumentosBsale = json_decode($response, true);

            foreach($DocumentosBsale['items'] as $DocumentoBsale){
                $DocumentoId = $DocumentoBsale['id'];
                $query = "SELECT Id, UrlPdfBsale FROM anulaciones WHERE DocumentoIdBsale = '".$DocumentoId."'";
                $NotaDebito = $run->select($query);
                if(!$NotaDebito){
                    $UrlPdf = $DocumentoBsale['urlPdf'];
                    $NumeroDocumento = $DocumentoBsale['number'];
                    $FechaAnulacion = date('Y-m-d', $DocumentoBsale['emissionDate']);
                    $HoraAnulacion = date('H:i:s', $DocumentoBsale['emissionDate']);
                    $query = "INSERT INTO anulaciones(DevolucionId, AnulacionIdBsale, DocumentoIdBsale, UrlPdfBsale, FechaAnulacion, HoraAnulacion, NumeroDocumento) VALUES ('".$Id."', '".$AnulacionIdBsale."', '".$DocumentoIdBsale."', '".$UrlPdf."', '".$FechaAnulacion."', '".$HoraAnulacion."','".$NumeroDocumento."')";
                    $Id = $run->insert($query);
                }else{
                    $Id = $Factura[0]['Id'];
                    $UrlPdf = $Factura[0]['UrlPdfBsale'];
                }
                if($Id){   
                    $this->almacenarDocumento($Id,3,$UrlPdf);
                }
            }
            */
        }
        public function almacenarDocumento($DocumentoId,$Tipo,$UrlPdf){
            if($Tipo == 1){
                $Folder = 'facturas';
            }else if($Tipo == 2){
                $Folder = 'notas_credito';
            }else{
                $Folder = 'notas_debito';
            }
            $UrlLocal = "/var/www/html/Teledata/facturacion/".$Folder."/".$DocumentoId.".pdf";    
            //aqui url de prueba
            // $UrlLocal = "http://localhost/LUIS/Teledata/facturacion/".$Folder."/".$DocumentoId.".pdf";   
            // $finfo = finfo_open(FILEINFO_MIME_TYPE);
            // OR finfo_file($finfo, $UrlLocal) != 'application/pdf'
            if(!file_exists($UrlLocal)){
                $PdfContent = file_get_contents($UrlPdf);
                file_put_contents($UrlLocal, $PdfContent);
            }   
        }
        public function updateDetallesDocumentoBsale(){
            $run = new Method;
            $query = "  SELECT
                            fd.Id,
                            fd.Concepto,
                            f.DocumentoIdBsale 
                        FROM
                            facturas_detalle fd
                            INNER JOIN facturas f ON fd.FacturaId = f.Id 
                        WHERE
                            fd.documentDetailIdBsale IS NULL 
                        AND
                            f.EstatusFacturacion != 0
                        ORDER BY
                            f.Id";
            $Detalles = $run->select($query);
            if($Detalles){
                $DocumentoIdBsale = 0;
                foreach($Detalles as $Detalle){
                    if($DocumentoIdBsale != $Detalle['DocumentoIdBsale']){
                        $DocumentoIdBsale = $Detalle['DocumentoIdBsale'];
                        $DocumentoBsale = $this->getDocumentoBsale($DocumentoIdBsale,1);
                    }
                    if($DocumentoBsale){
                        $Id = $Detalle['Id'];
                        $Concepto = $Detalle['Concepto'];
                        $details = $DocumentoBsale['details'];
                        $details = $details['items'];
                        $cantidadDetalles = count($details);
                        foreach($details as $detail){
                            $documentDetailIdBsale = $detail['id'];
                            $variant = $detail['variant'];
                            $ConceptoBsale = $variant['description'];
                            if(stripos($ConceptoBsale, $Concepto) !== FALSE OR $cantidadDetalles == 1){
                                $query = "UPDATE facturas_detalle SET documentDetailIdBsale = '".$documentDetailIdBsale."' WHERE Id = '".$Id."'";
                                $run->update($query); 
                            }
                        }
                    }
                }
            }
        }

        public function enviarDocumento($Id, $Data = false){
            if(isset($Data['notacreditoid'])){
                $Id = $Data['notacreditoid'];

            }
            $run = new Method;
            $query = "  SELECT
                            p.nombre,
                            CONCAT(p.correo,',',GROUP_CONCAT(IFNULL(c.correo, '') )) as correos,
                            d.NumeroDocumento,
                            d.TipoDocumento,
                            d.UrlPdfBsale
                        FROM
                            personaempresa p
                            LEFT JOIN facturas d ON p.Rut = d.Rut
                            LEFT JOIN contactos c ON c.rut = p.rut 
                        WHERE
                            d.Id = '".$Id."' 
                            -- AND c.tipo_contacto = 2 
                        GROUP BY
                            p.rut";
            $Documento = $run->select($query);
            $Asunto = '';
            if($Documento){
                $Documento = $Documento[0];
                $Nombre = $Documento['nombre'];
                $Correos = $Documento['correos'].',teledatadte@teledata.cl';
                $NumeroDocumento = $Documento['NumeroDocumento'];
                $UrlPdfBsale = $Documento['UrlPdfBsale'];
                if($Documento['TipoDocumento'] == 1){
                    $TipoDocumento = 'Boleta';
                }else{
                    $TipoDocumento = 'Factura';
                }

                if(isset($Data['notacreditoid'])){
                    $TipoDocumento = 'Nota de Crédito';
                    $UrlPdfBsale = $Data['UrlPdfBsale'];
                    $NumeroDocumento = $Data['NumeroDocumento'];
                }

                if(isset($Data['asunto'])){
                    $Asunto = $Data['asunto'];
                    $MensajeCorreo = 'La '.$Data['asunto'];
                }
                $Asunto .= $TipoDocumento . ' #' . $NumeroDocumento . ' Teledata';
                $espacios2 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $espacios = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $Html =
                "<html>
                    <head>
                        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
                        <style>
                        body{font-family:Open Sans;font-size:14px;}
                        table{font-size:13px;border-collapse:collapse;}
                        th{padding:8px;text-align:left;color:#595e62;border-bottom: 2px solid rgba(0,0,0,0.14);font-size:14px;}
                        td{padding:8px;border-bottom: 1px solid rgba(0,0,0,0.05);}
                        </style>
                    </head>
                    <body>
                    ESTIMADO(A) ".$Nombre.",<br>";
                        if( isset($MensajeCorreo) ){
                            $Html .= $MensajeCorreo . $TipoDocumento." #".$NumeroDocumento." se genero con exito y ha sido adjuntada en este correo.<br><br>
                            Puede visualizar o descargar los documento accediendo a la siguiente URL<br>
                            ".$Data['TipoDoc']."
                            <br>".$Data['UrlPdf']."</b><br><br>"
                            .$TipoDocumento."
                            <br>".$UrlPdfBsale."</b><br><br>";
                        }else{
                            $Html .= "La ".$TipoDocumento." #".$NumeroDocumento." se genero con exito y ha sido adjuntada en este correo.
                            <br><br>
                            Puede visualizar o descargar el documento accediendo a la siguiente URL<br>
                            <br>".$UrlPdfBsale."</b><br><br>";
                        }
                        
                        $Html .= "<b>Para transferencia o depósitos, los datos de nuestra cuenta son:</b><br><br>
                        RAZÓN SOCIAL:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>TELEDATA CHILE SPA.</b><br>
                        RUT:".$espacios."<b>76.722.248-3</b><br>
                        BANCO:".$espacios2."<b>BANCO DE CHILE</b><br>
                        TIPO DE CUENTA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>CUENTA CORRIENTE</b><br>
                        NUMERO DE CUENTA:&nbsp;<b>268-04500-03</b><br>
                        CORREO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a href='mailto:pagos@teledata.cl'>pagos@teledata.cl</a></b><br><br>
                        Este e-mail fue generado por un sistema automático, por favor no responder. Para dudas o consultas escribir a <b><a href='mailto:pagos@teledata.cl'>pagos@teledata.cl</a></b><br><br>
                        Saludos.
                    </body>
                </html>";
                
                // $UrlLocal = "/var/www/html/Teledata/facturacion/facturas/".$Id.".pdf";
                // if(!file_exists($UrlLocal)){
                //     $Archivos = array();
                //     $Archivo = array('url' => $UrlPdfBsale, 'name' => $TipoDocumento.'_'.$NumeroDocumento.'.pdf');
                //     array_push($Archivos,$Archivo);
                //     $Email = new Email();
                //     // $Archivos = array();
                //     $ToReturn = $Email->SendMail($Html,$Asunto,$Correos,$Archivos, true);
                // }
                $Email = new Email();
                $ToReturn = $Email->SendMail($Html,$Asunto,$Correos, false , false);
                if($ToReturn == 1){
                }
                else{
                    $ToReturn = 2;
                }
            }else{
                $ToReturn = 3;
            }
            return $ToReturn;
        }

        public function enviarDocumentoPrefactura($id,$Tipo, $Grupo, $UrlLocal){
           
            $run = new Method;
            $query = "  SELECT
                            p.nombre,
                            d.NumeroDocumento,
                            d.UrlPdfBsale,
                            d.TipoDocumento 
                        FROM
                            personaempresa p
                            INNER JOIN facturas d ON p.Rut = d.Rut
                            INNER JOIN servicios ON servicios.Rut = p.Rut  ";
            if($Tipo == 1)
            $query .= " WHERE d.Id = '".$id."' ";
            else if($Tipo == 2){
                if($Grupo == 1000 OR $Grupo == 1001){
                    $query .= " WHERE d.Id = '".$id."' ";
                }else{
                    $query .= " WHERE d.Rut = '".$id."' ";
                }
            }else{
                $query .= " WHERE servicios.Id = '".$id."' ";
            }       
            $Documento = $run->select($query);
            print_r($Documento);
            if($Documento != ''){
                $Documento = $Documento[0];
                
                $Nombre = $Documento['nombre'];
                $Correos = 'teledatadte@teledata.cl';
                $NumeroDocumento = $Documento['NumeroDocumento'];

                if($Documento['TipoDocumento'] == 1){
                    $TipoDocumento = 'Boleta';
                }else{
                    $TipoDocumento = 'Factura';
                }
                $Asunto = $TipoDocumento . ' #' . $NumeroDocumento . ' Teledata';
                $espacios2 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $espacios = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $Html =
                "<html>
                    <head>
                        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
                        <style>
                        body{font-family:Open Sans;font-size:14px;}
                        table{font-size:13px;border-collapse:collapse;}
                        th{padding:8px;text-align:left;color:#595e62;border-bottom: 2px solid rgba(0,0,0,0.14);font-size:14px;}
                        td{padding:8px;border-bottom: 1px solid rgba(0,0,0,0.05);}
                        </style>
                    </head>
                    <body>
                    ESTO ES UNA PRUEBA DE PREFACTURA, <br>
                    ESTIMADO(A) ".$Nombre.",<br>
                        La ".$TipoDocumento." #".$NumeroDocumento." se genero con exito y ha sido adjuntada en este correo.<br><br>
                        <b>Para transferencia o depósitos, los datos de nuestra cuenta son:</b><br><br>
                        RAZÓN SOCIAL:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>TELEDATA CHILE SPA.</b><br>
                        RUT:".$espacios."<b>76.722.248-3</b><br>
                        BANCO:".$espacios2."<b>BANCO DE CHILE</b><br>
                        TIPO DE CUENTA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>CUENTA CORRIENTE</b><br>
                        NUMERO DE CUENTA:&nbsp;<b>268-04500-03</b><br>
                        CORREO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a href='mailto:pagos@teledata.cl'>pagos@teledata.cl</a></b><br><br>
                        Saludos.
                    </body>
                </html>";
                
                // $UrlLocal = "/var/www/html/Teledata/facturacion/facturas/".$Id.".pdf";
                //aqui url de prueba  
                // $UrlLocal = "http://localhost/LUIS/Teledata/facturacion/facturas/".$Id.".pdf";  
                if(!file_exists($UrlLocal) || filesize($UrlLocal) <= 0){
                    unlink($UrlLocal);
                    $PdfContent = file_get_contents($Documento['UrlPdfBsale']);
                    file_put_contents($UrlLocal, $PdfContent);
                    $Archivos = array();
                    $Archivo = array('url' => $UrlLocal, 'name' => $TipoDocumento.'_'.$NumeroDocumento.'.pdf');
                    array_push($Archivos,$Archivo);
                    $Email = new Email();
                    // $Archivos = array();
                    $ToReturn = $Email->SendMail($Html,$Asunto,$Correos,$Archivos);
                }else{
                    $ToReturn = 2;
                }
            }else{
                $ToReturn = 3;
            }
            return $ToReturn;
        }
        
        public function descargarDocumentoBsale($id){
            $run = new Method;
            $query = "SELECT urlPdfBsale FROM facturas WHERE Id = '".$id."'";
            $Documento = $run->select($query);
            if($Documento){
                $this->almacenarDocumento($id,1,$Documento[0]['urlPdfBsale']);
            }
            return 1;
        }
        public function eliminarZipsTmp(){
            $directory = "/var/www/html/Teledata/facturacion/facturas";
            // $directory = "../../../facturacion/facturas";
            $looper = new RecursiveDirectoryIterator($directory);
            foreach (new RecursiveIteratorIterator($looper) as $filename => $cur) {
                $ext = trim($cur->getExtension());
                if($ext == "zip"){
                    unlink($filename);
                }
            }
        }
    }
?>