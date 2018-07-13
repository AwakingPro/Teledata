<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class NotaVenta{

    	public function GuardarServicio($Codigo,$Servicio,$Cantidad,$Precio,$Cliente){

            $response_array = array();

            $Codigo = isset($Codigo) ? trim($Codigo) : "";
            $Servicio = isset($Servicio) ? trim($Servicio) : "";
            $Cantidad = isset($Cantidad) ? trim($Cantidad) : "";
            $Precio = isset($Precio) ? trim($Precio) : "";

            if(!empty($Codigo) && !empty($Servicio) && !empty($Cantidad) && !empty($Precio)){

                session_start();

                $Cantidad=intval($Cantidad);
                $Usuario=$_SESSION['idUsuario'];

                $query = "SELECT mantenedor_servicios.servicio as Servicio, servicios.Valor as Precio FROM servicios LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio where servicios.Codigo = '$Codigo'";
                $run = new Method;
                $ServicioSQL = $run->select($query);

                if($ServicioSQL){

                    $Servicio=$ServicioSQL[0]['Servicio'];
                    $Precio=floatval($ServicioSQL[0]['Precio']);

                }else{

                    $Precio = str_replace('.','',$Precio);
                    $Servicio=$Servicio;
                    $Precio=floatval($Precio);
                }

                $Total = $Precio * $Cantidad;

                $Impuesto = $Total * 0.19;
                $Total = $Total + $Impuesto;
                
                $query = "INSERT INTO nota_venta_tmp(codigo, servicio, cantidad, precio, total, usuario_id) VALUES ('$Codigo','$Servicio','$Cantidad','$Precio','$Total','$Usuario')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'codigo' => $Codigo, 'servicio' => $Servicio, 'cantidad' => $Cantidad, 'precio' => $Precio, 'total' => $Total);

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

        public function GuardarNotaVenta($Cliente,$Fecha,$NumeroOc,$FechaOc,$SolicitadoPor){

            $response_array = array();

            $Cliente = isset($Cliente) ? trim($Cliente) : "";
            $Fecha = isset($Fecha) ? trim($Fecha) : "";
            $NumeroOc = isset($NumeroOc) ? trim($NumeroOc) : "";
            $FechaOc = isset($FechaOc) ? trim($FechaOc) : "";
            $SolicitadoPor = isset($SolicitadoPor) ? trim($SolicitadoPor) : "";

            if(!empty($Cliente) && !empty($Fecha) && !empty($SolicitadoPor)){

                session_start();
                $Usuario=$_SESSION['idUsuario'];

                $query = "SELECT * FROM nota_venta_tmp where usuario_id = '$Usuario'";
                $run = new Method;
                $detalle_nota = $run->select($query);

                if($detalle_nota){

                    if($FechaOc){
                        $FechaOc = DateTime::createFromFormat('d-m-Y', $FechaOc)->format('Y-m-d');
                    }else{
                        $FechaOc = '1969-01-31';
                    }

                    $Fecha = DateTime::createFromFormat('d-m-Y', $Fecha)->format('Y-m-d');

                    $query = "INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES ('$Cliente','$Fecha','$NumeroOc','$FechaOc','$SolicitadoPor','0')";
                    $Id = $run->insert($query);

                    if($Id){
                        foreach($detalle_nota as $detalle){

                            $Codigo=$detalle['codigo'];
                            $Cantidad=$detalle['cantidad'];
                            $Concepto=$detalle['servicio'];
                            $Precio=$detalle['precio'];
                            $Total=$detalle['total'];

                            $query = "INSERT INTO nota_venta_detalle(nota_venta_id, codigo, concepto, cantidad, precio, total) VALUES ('$Id', '$Codigo','$Concepto','$Cantidad','$Precio','$Total')";
                            $data = $run->insert($query);
                        }

                        $array = array('id'=> $Id, 'rut' => $Cliente, 'fecha' => $Fecha, 'numero_oc' => $NumeroOc, 'solicitado_por' => $SolicitadoPor);
                        
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

        function showPersonaEmpresa(){

            session_start();
            $Usuario=$_SESSION['idUsuario'];

            $query = "DELETE from nota_venta_tmp where usuario_id = '$Usuario'";
            $run = new Method;
            $data = $run->delete($query);

            $query = '  SELECT
                            p.rut,
                            p.nombre,
                            mt.nombre as tipo_cliente
                        FROM
                            personaempresa p
                        INNER JOIN 
                            mantenedor_tipo_cliente mt 
                        ON 
                            p.tipo_cliente = mt.id';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showCliente($rut){

            session_start();
            $Usuario=$_SESSION['idUsuario'];

            $query = "DELETE from nota_venta_tmp where usuario_id = '$Usuario'";
            $run = new Method;
            $data = $run->delete($query);

            $query = "SELECT * FROM personaempresa where Rut = '$rut'";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showCodigos($rut){

            $query = "SELECT * FROM servicios WHERE Rut = '$rut'";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showServicio($Codigo){

            $query = "SELECT mantenedor_servicios.servicio as Servicio, servicios.Valor as Precio FROM servicios LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio where servicios.Codigo = '$Codigo'";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function deleteServicio($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $Id=$Id;

                $query = "SELECT * from nota_venta_tmp where id = '$Id'";
                $run = new Method;
                $data = $run->select($query);

                if($data){

                    $response_array['array'] = $data;

                    $query = "DELETE from nota_venta_tmp where id = '$Id'";
                    $run = new Method;
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

         function showNotaVenta(){

            $query = '  SELECT
                            nota_venta.*, personaempresa.nombre AS cliente,
                            (
                                SELECT
                                    SUM(precio) + SUM(precio) * 0.19
                                FROM
                                    nota_venta_detalle
                                WHERE
                                    nota_venta_id = nota_venta.id
                            ) AS total
                        FROM
                            nota_venta
                        INNER JOIN personaempresa ON personaempresa.rut = nota_venta.rut';
                                    $run = new Method;
            $data = $run->select($query);

            echo json_encode($data);

        }

        function deleteNotaVenta($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $Id=$Id;
                $run = new Method;
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
            $response_array = array();
            $run = new Method;
            $query = "SELECT personaempresa.rut, personaempresa.tipo_cliente FROM personaempresa INNER JOIN nota_venta ON personaempresa.rut = nota_venta.rut WHERE nota_venta.id = '$id'";
            $NotaVenta = $run->select($query);
            if($NotaVenta){
                $NotaVenta = $NotaVenta[0];
                $Rut = $NotaVenta['rut'];
                $Grupo = 0;                
                $TipoDocumento = $NotaVenta['tipo_cliente'];
                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale) VALUES ('".$Rut."', '".$Grupo."', '1', '0', NOW(), NOW(), '".$TipoDocumento."', NOW(), 0.19, '0', '', '0', '')";
                $FacturaId = $run->insert($query);
                if($FacturaId){
                    $query = "SELECT * from nota_venta_detalle where nota_venta_id = '$id'";
                    $Detalles = $run->select($query);
                    if($Detalles){
                        foreach($Detalles as $Detalle){
                            $Valor = floatval($Detalle['precio']);
                            $Concepto = $Detalle['concepto'];
                            $Cantidad = $Detalle['cantidad'];
                            $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Cantidad."', '0', '0')";
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
    }

?>
