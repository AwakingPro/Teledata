<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class NotaVenta{
        function __construct () {
            $run = new Method;
		}

        function deleteDetalles(){
            $run = new Method;
            $Usuario=$_SESSION['idUsuario'];
            $query = "DELETE from nota_venta_tmp where usuario_id = '".$Usuario."'";
            
            $data = $run->delete($query,false);
        }

    	public function insertDetalleTmp($Concepto,$Cantidad,$Precio,$Moneda, $Descuento){
            $response_array = array();

            $Concepto = isset($Concepto) ? trim($Concepto) : "";
            $Cantidad = isset($Cantidad) ? trim($Cantidad) : "";
            $Precio = isset($Precio) ? trim($Precio) : "";
            $Descuento = isset($Descuento) ? trim($Descuento) : "";

            if(!empty($Concepto) && !empty($Cantidad)){

                if($Precio > 0){
                    $run = new Method;

                    $Cantidad = intval($Cantidad);
                    $Usuario = $_SESSION['idUsuario'];
                    $Precio = str_replace(',','.',$Precio);
                    
                    if($Moneda == 2){
                        $UfClass = new Uf(); 
                        $UF = $UfClass->getValue();
                        $Precio = $Precio * $UF;
                        $Precio = round($Precio, 0);
                    }else{
                        $Precio = round($Precio, 0);
                    }
                    
                    $Neto = $Precio * $Cantidad;
                    $Impuesto = $Neto * 0.19;
                    $Total = $Neto + $Impuesto;
                    $Total = round($Total,0);
                    
                    
                    // echo "Moneda ".$Moneda.' Precio '.$Precio. " Neto ".$Neto." Impuesto ".$Impuesto." Total ".$Total."\n";
                    // exit;
                    $query = "INSERT INTO nota_venta_tmp(concepto, cantidad, precio, total, usuario_id, descuento) VALUES ('".$Concepto."','".$Cantidad."','".$Precio."','".$Total."','".$Usuario."', '".$Descuento."')";
                    $id = $run->insert($query,false);

                    if($Descuento){
                        $DescuentoPunto  = '0.';
                        $DescuentoPunto .= $Descuento;
                        $DescuentoTotal = $Total * $DescuentoPunto;
                        $Total = $Total - $DescuentoTotal;
                        $Total = round($Total,0);
                    }
                    if($id){

                        $array = array('id'=> $id, 'concepto' => $Concepto, 'cantidad' => $Cantidad, 'precio' => $Precio, 'total' => $Total, 'descuento' => $Descuento);

                        $response_array['array'] = $array;
                        $response_array['status'] = 1; 
                    }else{
                        $response_array['status'] = 0; 
                    }
                }else{
                    $response_array['status'] = 3;
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

    	} 

        public function insertNotaVenta($Cliente,$Fecha,$NumeroOc,$FechaOc,$SolicitadoPor, $NumeroHes, $FechaHes, $ServiciosSeleccionados){

            $response_array = array();
            $cadena_buscada   = '/';
            $run = new Method;
            $ServiciosSeleccionados = isset($ServiciosSeleccionados) ? trim($ServiciosSeleccionados) : "";
            //si se quieren cobrar algun servicio y no volver a cobrar en por lotes hasta el proximo mes
            if($ServiciosSeleccionados){
                //los convierto en un array
                $ServiciosSeleccionados = explode(",", $ServiciosSeleccionados);
                foreach($ServiciosSeleccionados as $Servicio){
                    //busco el caracter separador del idDetalle, Fecha y del valor
                    $posicion_coincidencia = strpos($Servicio, $cadena_buscada);
                    //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
                    if ($posicion_coincidencia !== false) {
                        //extraigo el idServicio y la FechaUltimoCobro
                        $datoTemporal = explode($cadena_buscada, $Servicio);
                        //sumo 1 mes para que no se vuelva a hacer el cobro del servicio al ejecutarse el script el 25 de cada mes
                        $idServicio = $datoTemporal[0];
                        $FechaUltimoCobro = $datoTemporal[1];
                        $TipoFactura = $datoTemporal[2];

                        //valido si es anual
                        if($TipoFactura == 17 || $TipoFactura == 24){
                            $FechaUltimoCobro = date("Y-m-01",strtotime($FechaUltimoCobro."+ 1 year"));
                        }else{
                            $FechaUltimoCobro = date("Y-m-01",strtotime($FechaUltimoCobro."+ 1 month"));
                        }
                        //Actualizo la FechaUltimoCobro de cada servicios
                        $query = "UPDATE servicios SET FechaUltimoCobro = '".$FechaUltimoCobro."' WHERE id = '".$idServicio."'";
                        $update = $run->update($query);
                        if(!$update){
                            $response_array['status'] = 4; 
                            echo json_encode($response_array);
                            exit;
                        }
                    }
                }
            }
            

            $Cliente = isset($Cliente) ? trim($Cliente) : "";
            $Fecha = isset($Fecha) ? trim($Fecha) : "";
            $NumeroOc = isset($NumeroOc) ? trim($NumeroOc) : "";
            $FechaOc = isset($FechaOc) ? trim($FechaOc) : "";
            $NumeroHes = isset($NumeroHes) ? trim($NumeroHes) : "";
            $FechaHes = isset($FechaHes) ? trim($FechaHes) : "";
            $SolicitadoPor = isset($SolicitadoPor) ? trim($SolicitadoPor) : "";

            if(!empty($Cliente) && !empty($Fecha) && !empty($SolicitadoPor)){

                
                $Usuario=$_SESSION['idUsuario'];

                $query = "SELECT * FROM nota_venta_tmp where usuario_id = '$Usuario'";
                
                $detalle_nota = $run->select($query);

                if($detalle_nota){

                    if($FechaOc){
                        $FechaOc = DateTime::createFromFormat('d-m-Y', $FechaOc)->format('Y-m-d');
                        if($FechaHes){
                            $FechaHes = DateTime::createFromFormat('d-m-Y', $FechaHes)->format('Y-m-d');
                        }
                    }else{
                        $FechaOc = '1969-01-31';
                        $FechaHes = '1969-01-31';
                    }

                    $Fecha = DateTime::createFromFormat('d-m-Y', $Fecha)->format('Y-m-d');

                    $query = "INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion, numero_hes, fecha_hes) VALUES ('".$Cliente."','".$Fecha."','".$NumeroOc."','".$FechaOc."','".$SolicitadoPor."','0', '".$NumeroHes."', '".$FechaHes."')";
                    $Id = $run->insert($query);

                    if($Id){
                        foreach($detalle_nota as $detalle){

                            $Concepto=$detalle['concepto'];
                            $Cantidad=$detalle['cantidad'];
                            $Precio=$detalle['precio'];
                            $Total=$detalle['total'];
                            $Descuento=$detalle['descuento'];

                            $query = "INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total, descuento) VALUES ('$Id','$Concepto','$Cantidad','$Precio','$Total', '$Descuento')";
                            $data = $run->insert($query);
                        }

                        $array = array('id'=> $Id, 'rut' => $Cliente, 'fecha' => $Fecha, 'numero_oc' => $NumeroOc, 'solicitado_por' => $SolicitadoPor, 'numero_hes' => $NumeroHes, 'descuento' => $Descuento);
                        
                        $response_array['array'] = $array;
                        $response_array['status'] = 1; 

                    }else{
                        $response_array['status'] = 0; 
                    }
                }else{
                    $response_array['status'] = 3; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

        } 

        function getClientes(){
            $run = new Method;
            $query = "  SELECT
                            p.rut,
                            p.nombre,
                            mt.nombre as tipo_cliente
                        FROM
                            personaempresa p
                        INNER JOIN 
                            mantenedor_tipo_cliente mt 
                        ON 
                            p.tipo_cliente = mt.id
                        ORDER BY
                            p.nombre";
            
            $data = $run->select($query);
			foreach($data as $key => $tarea ){
				$data[$key]['nombre'] = $run->eliminarTildes($tarea['nombre']);
			}
            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function getCliente($rut){
            $run = new Method;
            $query = "SELECT * FROM personaempresa where Rut = '$rut'";
            
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function getProductos(){
            $run = new Method;
            $query = "  SELECT
                            CONCAT(mantenedor_modelo_producto.nombre,' ',mantenedor_marca_producto.nombre,' ',mantenedor_tipo_producto.nombre) as producto
                        FROM
                            mantenedor_modelo_producto
                        INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id
                        INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id";
           
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function deleteDetalleTmp($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $Id=$Id;
                $run = new Method;
                $query = "SELECT * from nota_venta_tmp where id = '$Id'";
                $data = $run->select($query);

                if($data){

                    $response_array['array'] = $data;
                    $run = new Method;
                    $query = "DELETE from nota_venta_tmp where id = '$Id'";
                    
                    $data = $run->delete($query,false);
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 3; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function getNotaVentas(){
            $run = new Method;
            $query = "  SELECT
                            nv.*,
                            p.nombre AS cliente,
                            CONCAT( p.rut, '-', p.dv ) AS rut,
                            u.nombre AS solicitado_por,
                            IFNULL(ROUND( ( SELECT SUM( total ) FROM nota_venta_detalle WHERE nota_venta_id = nv.id ), 0 ), 0) AS total,
                            IFNULL(ROUND( ( SELECT SUM( descuento ) FROM nota_venta_detalle WHERE nota_venta_id = nv.id ), 0 ), 0) AS total_descuento 
                        FROM
                            nota_venta nv
                            INNER JOIN personaempresa p ON p.rut = nv.rut
                            INNER JOIN usuarios u ON u.id = nv.solicitado_por";
            $data = $run->select($query);
            // echo '<pre>'; print_r($data); '</pre>';
            // exit;
            $dataConvertida = array();
            foreach($data as $dato){
                // if($dato['total_descuento']){
                //     $DescuentoPunto  = '0.';
                //     $DescuentoPunto .= $dato['total_descuento'];
                //     $DescuentoTotal = $dato['total'] * $DescuentoPunto;
                //     $Total = $dato['total'] - $DescuentoTotal;
                //     $dato['total'] = round($Total,0);
                // }
                $dato['rut']             = $dato['rut']; 
                $dato['cliente']         = $dato['cliente']; 
                $dato['fecha']           = $dato['fecha']; 
                $dato['numero_oc']       = $dato['numero_oc']; 
                $dato['numero_hes']      = $dato['numero_hes'];
                $dato['solicitado_por']  = $dato['solicitado_por']; 
                $dato['total']           = $dato['total']; 
                $dato['total_descuento'] = $dato['total_descuento'];
                $dato['id']              = $dato['id']; 
                
                array_push($dataConvertida, $dato);
            }
            echo json_encode($dataConvertida);

        }

        function deleteNotaVenta($Id){
            $run = new Method;
            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $Id=$Id;
                
                $query = "DELETE from nota_venta_detalle where nota_venta_id = '$Id'";
                $data = $run->delete($query);
                $query = "DELETE from nota_venta where id = '$Id'";
                $data = $run->delete($query);
                $response_array['status'] = 1; 
                    
               
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function generarFactura($id){
            $run = new Method;
            $response_array = array();
            
            $query = "  SELECT
                            p.rut,
                            p.tipo_cliente,
                            nv.numero_oc,
                            nv.fecha_oc,
                            nv.numero_hes,
                            nv.fecha_hes
                        FROM
                            personaempresa p
                        INNER JOIN nota_venta nv ON p.rut = nv.rut
                        WHERE
                            nv.id = '".$id."'";
            $NotaVenta = $run->select($query);
            if($NotaVenta){
                $NotaVenta = $NotaVenta[0];
                $Rut = $NotaVenta['rut'];
                $Grupo = 1000;                
                $TipoDocumento = $NotaVenta['tipo_cliente'];
                $NumeroOC = $NotaVenta['numero_oc'];
                $FechaOC = $NotaVenta['fecha_oc'];
                $NumeroHES = $NotaVenta['numero_hes'];
                $FechaHES = $NotaVenta['fecha_hes'];
                if(!$FechaOC){
                    $FechaOC = '1969-01-31';
                }
                if(!$FechaHES){
                    $FechaHES = '1969-01-31';
                }
                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC, NumeroHES, FechaHES) VALUES ('".$Rut."', '".$Grupo."', '1', '0', NOW(), NOW(), '".$TipoDocumento."', NOW(), 0.19, '0', '', '0', '', '".$NumeroOC."', '".$FechaOC."', '".$NumeroHES."', '".$FechaHES."')";
                $FacturaId = $run->insert($query);
                if($FacturaId){
                    $query = "SELECT * from nota_venta_detalle where nota_venta_id = '$id'";
                    $Detalles = $run->select($query);
                    if($Detalles){
                        foreach($Detalles as $Detalle){
                            $Valor = floatval($Detalle['precio']);
                            $Concepto = $Detalle['concepto'];
                            $Cantidad = $Detalle['cantidad'];
                            $Total = $Detalle['total'];
                            $Descuento = $Detalle['descuento'];
                            $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Cantidad."', '".$Descuento."', '0', '".$Total."', '')";
                            $FacturaDetalleId = $run->insert($query);
                            
                        }
                    }
                    $query = "UPDATE nota_venta SET estatus_facturacion = 1, factura_id = '".$FacturaId."' WHERE id = '".$id."'";
                    $update = $run->update($query);
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0; 
                }
                
            }else{
                $response_array['status'] = 2; 
            }
            echo json_encode($response_array);
        }

        function getNotaVenta($Id){
            $run = new Method;
            $query = "  SELECT
                            *
                        FROM
                            nota_venta
                        WHERE
                            id = '".$Id."'";
            $data = $run->select($query);
            $array = array();
            if($data){
                $nota_venta = $data[0];
                $array['id'] = $nota_venta['id'];
                $array['rut'] = $nota_venta['rut'];                
                $array['fecha'] = DateTime::createFromFormat('Y-m-d', $nota_venta['fecha'])->format('d-m-Y');
                $array['numero_oc'] = $nota_venta['numero_oc'];
                $array['numero_hes'] = $nota_venta['numero_hes'];
                if($nota_venta['fecha_oc'] && $nota_venta['fecha_oc'] != '1969-01-31'){
                    $array['fecha_oc'] = DateTime::createFromFormat('Y-m-d', $nota_venta['fecha_oc'])->format('d-m-Y');
                }else{
                    $array['fecha_oc'] = '';
                }
                if($nota_venta['fecha_hes'] && $nota_venta['fecha_hes'] != '1969-01-31'){
                    $array['fecha_hes'] = DateTime::createFromFormat('Y-m-d', $nota_venta['fecha_hes'])->format('d-m-Y');
                }else{
                    $array['fecha_hes'] = '';
                }
                $array['solicitado_por'] = $nota_venta['solicitado_por'];
            }
            echo json_encode($array);
        }
        public function updateNotaVenta($Cliente,$Fecha,$NumeroOc,$FechaOc, $NumeroHes, $FechaHes, $SolicitadoPor,$Id){
            $run = new Method;
            $response_array = array();

            $Cliente = isset($Cliente) ? trim($Cliente) : "";
            $Fecha = isset($Fecha) ? trim($Fecha) : "";
            $NumeroOc = isset($NumeroOc) ? trim($NumeroOc) : "";
            $FechaOc = isset($FechaOc) ? trim($FechaOc) : "";
            $NumeroHes = isset($NumeroHes) ? trim($NumeroHes) : "";
            $FechaHes = isset($FechaHes) ? trim($FechaHes) : "";
            $SolicitadoPor = isset($SolicitadoPor) ? trim($SolicitadoPor) : "";

            if(!empty($Cliente) && !empty($Fecha) && !empty($SolicitadoPor)){
                if($FechaOc){
                    $FechaOc = DateTime::createFromFormat('d-m-Y', $FechaOc)->format('Y-m-d');
                }else{
                    $FechaOc = '1969-01-31';
                }
                if($FechaHes){
                    $FechaHes = DateTime::createFromFormat('d-m-Y', $FechaHes)->format('Y-m-d');
                }else{
                    $FechaHes = '1969-01-31';
                }
                $Fecha = DateTime::createFromFormat('d-m-Y', $Fecha)->format('Y-m-d');
                
                $query = "UPDATE nota_venta SET rut = '".$Cliente."', fecha = '".$Fecha."', numero_oc = '".$NumeroOc."', fecha_oc = '".$FechaOc."', solicitado_por = '".$SolicitadoPor."', numero_hes = '".$NumeroHes."', fecha_hes = '".$FechaHes."' WHERE id = '".$Id."'";
                $Id = $run->update($query);

                if($Id){
                    $array = array('id'=> $Id, 'rut' => $Cliente, 'fecha' => $Fecha, 'numero_oc' => $NumeroOc, 'numero_hes' => $NumeroHes, 'solicitado_por' => $SolicitadoPor);
                    
                    $response_array['array'] = $array;
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0; 
                }
              
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

        } 
        function getDetalles($Id){
            $run = new Method;
            $query = "  SELECT
                            *
                        FROM
                            nota_venta_detalle
                        WHERE
                            nota_venta_id = '".$Id."'";
            $data = $run->select($query);
            $detalles = array();
            if($data){
                foreach($data as $detalle){
                    $array = array();
                    $array['id'] = $detalle['id'];
                    $array['concepto'] = $detalle['concepto'];
                    $array['precio'] = $detalle['precio'];
                    $array['cantidad'] = $detalle['cantidad'];
                    if($detalle['descuento']){
                        $DescuentoPunto  = '0.';
                        $DescuentoPunto .= $detalle['descuento'];
                        $DescuentoTotal = $detalle['total'] * $DescuentoPunto;
                        $Total = $detalle['total'] - $DescuentoTotal;
                        $detalle['total'] = round($Total,0);
                    }
                    $array['total'] = $detalle['total'];
                    $array['descuento'] = $detalle['descuento'];
                    array_push($detalles,$array);
                }
            }
            echo json_encode($detalles);
        }
        public function insertDetalle($Concepto,$Cantidad,$Precio,$Moneda,$NotaVentaId, $Descuento){
            $run = new Method;
            $response_array = array();

            $Concepto = isset($Concepto) ? trim($Concepto) : "";
            $Cantidad = isset($Cantidad) ? trim($Cantidad) : "";
            $Precio = isset($Precio) ? trim($Precio) : "";
            $Descuento = isset($Descuento) ? trim($Descuento) : "";
            if(!empty($Concepto) && !empty($Cantidad) && !empty($Precio)){

                

                $Cantidad = intval($Cantidad);
                $Precio = str_replace('.','',$Precio);
                $Precio = floatval($Precio);
                if($Moneda == 2){
                    $UfClass = new Uf(); 
                    $UF = $UfClass->getValue();
                    $Precio = $Precio * $UF;
                }
                $Precio = round($Precio,0);
                $Neto = $Precio * $Cantidad;
                $Impuesto = $Neto * 0.19;
                $Total = $Neto + $Impuesto;
                $Total = round($Total,0);
                
                $query = "INSERT INTO nota_venta_detalle(concepto, cantidad, precio, total, nota_venta_id, descuento) VALUES ('".$Concepto."','".$Cantidad."','".$Precio."','".$Total."','".$NotaVentaId."','".$Descuento."')";
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'concepto' => $Concepto, 'cantidad' => $Cantidad, 'precio' => $Precio, 'total' => $Total,'descuento' => $Descuento);

                    $response_array['array'] = $array;
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0; 
                }
            
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

        }
        function getDetalle($Id){
            $run = new Method;
            $query = "  SELECT
                            *
                        FROM
                            nota_venta_detalle
                        WHERE
                            id = '".$Id."'";
            $data = $run->select($query);
            if($data){
                $detalle = $data[0];
            }else{
                $detalle = array();
            }
            echo json_encode($detalle);
        }
        public function updateDetalle($Concepto,$Cantidad,$Precio,$Moneda,$Id,$Descuento){
            $run = new Method;
            $response_array = array();

            $Concepto = isset($Concepto) ? trim($Concepto) : "";
            $Cantidad = isset($Cantidad) ? trim($Cantidad) : "";
            $Precio = isset($Precio) ? trim($Precio) : "";
            $Descuento = isset($Descuento) ? trim($Descuento) : "";

            if(!empty($Concepto) && !empty($Cantidad) && !empty($Precio)){
                $Cantidad = intval($Cantidad);
                $Precio = str_replace('.','',$Precio);
                $Precio = floatval($Precio);
                if($Moneda == 2){
                    $UfClass = new Uf(); 
                    $UF = $UfClass->getValue();
                    $Precio = $Precio * $UF;
                }
                $Precio = round($Precio,0);
                $Neto = $Precio * $Cantidad;
                $Impuesto = $Neto * 0.19;
                $Total = $Neto + $Impuesto;
                $Total = round($Total,0);
                
                $query = "UPDATE nota_venta_detalle SET concepto = '".$Concepto."', cantidad = '".$Cantidad."', precio = '".$Precio."', total = '".$Total."', descuento = '".$Descuento."' WHERE id = '".$Id."'";
                $id = $run->update($query);

                if($id){

                    $array = array('id'=> $id, 'concepto' => $Concepto, 'cantidad' => $Cantidad, 'precio' => $Precio, 'total' => $Total, 'descuento' => $Descuento);

                    $response_array['array'] = $array;
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0; 
                }
            
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

        }
        function deleteDetalle($Id){
            $run = new Method;
            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $Id=$Id;

                $query = "SELECT * from nota_venta_detalle where id = '$Id'";
               
                $data = $run->select($query);

                if($data){

                    $response_array['array'] = $data;

                    $query = "DELETE from nota_venta_detalle where id = '$Id'";
                    $data = $run->delete($query);
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 3; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }
    }

?>
