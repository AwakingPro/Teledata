<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class NotaVenta{

        function deleteDetalles(){
            session_start();
            $Usuario=$_SESSION['idUsuario'];
            $query = "DELETE from nota_venta_tmp where usuario_id = '".$Usuario."'";
            $run = new Method;
            $data = $run->delete($query);
        }

    	public function insertDetalle($Concepto,$Cantidad,$Precio,$Moneda){

            $response_array = array();

            $Concepto = isset($Concepto) ? trim($Concepto) : "";
            $Cantidad = isset($Cantidad) ? trim($Cantidad) : "";
            $Precio = isset($Precio) ? trim($Precio) : "";

            if(!empty($Concepto) && !empty($Cantidad) && !empty($Precio)){

                session_start();
                $run = new Method;

                $Cantidad = intval($Cantidad);
                $Usuario = $_SESSION['idUsuario'];
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
                
                $query = "INSERT INTO nota_venta_tmp(concepto, cantidad, precio, total, usuario_id) VALUES ('".$Concepto."','".$Cantidad."','".$Precio."','".$Total."','".$Usuario."')";
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'concepto' => $Concepto, 'cantidad' => $Cantidad, 'precio' => $Precio, 'total' => $Total);

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

        public function insertNotaVenta($Cliente,$Fecha,$NumeroOc,$FechaOc,$SolicitadoPor){

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

                    $query = "INSERT INTO nota_venta(rut, fecha, numero_oc, fecha_oc, solicitado_por, estatus_facturacion) VALUES ('".$Cliente."','".$Fecha."','".$NumeroOc."','".$FechaOc."','".$SolicitadoPor."','0')";
                    $Id = $run->insert($query);

                    if($Id){
                        foreach($detalle_nota as $detalle){

                            $Concepto=$detalle['concepto'];
                            $Cantidad=$detalle['cantidad'];
                            $Precio=$detalle['precio'];
                            $Total=$detalle['total'];

                            $query = "INSERT INTO nota_venta_detalle(nota_venta_id, concepto, cantidad, precio, total) VALUES ('$Id','$Concepto','$Cantidad','$Precio','$Total')";
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

        function getClientes(){
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
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function getCliente($rut){
            $query = "SELECT * FROM personaempresa where Rut = '$rut'";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function getProductos(){

            $query = "  SELECT
                            CONCAT(mantenedor_modelo_producto.nombre,' ',mantenedor_marca_producto.nombre,' ',mantenedor_tipo_producto.nombre) as producto
                        FROM
                            mantenedor_modelo_producto
                        INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id
                        INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function deleteDetalle($Id){

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

         function getNotaVentas(){

            $query = "  SELECT
                            nv.*, p.nombre AS cliente, CONCAT(p.rut,'-',p.dv) as rut,
                            ROUND((
                                SELECT
                                    SUM(total)
                                FROM
                                    nota_venta_detalle
                                WHERE
                                    nota_venta_id = nv.id
                            ),0) AS total
                        FROM
                            nota_venta nv
                        INNER JOIN personaempresa p ON p.rut = nv.rut";
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
            $query = "  SELECT
                            p.rut,
                            p.tipo_cliente,
                            nv.numero_oc,
                            nv.fecha_oc
                        FROM
                            personaempresa p
                        INNER JOIN nota_venta nv ON p.rut = nv.rut
                        WHERE
                            nv.id = '".$id."'";
            $NotaVenta = $run->select($query);
            if($NotaVenta){
                $NotaVenta = $NotaVenta[0];
                $Rut = $NotaVenta['rut'];
                $Grupo = 0;                
                $TipoDocumento = $NotaVenta['tipo_cliente'];
                $NumeroOC = $NotaVenta['numero_oc'];
                $FechaOC = $NotaVenta['fecha_oc'];
                $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, NumeroOC, FechaOC) VALUES ('".$Rut."', '".$Grupo."', '1', '0', NOW(), NOW(), '".$TipoDocumento."', NOW(), 0.19, '0', '', '0', '', '".$NumeroOC."', '".$FechaOC."')";
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
                            
                            $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Cantidad, Descuento, IdServicio, Total, Codigo) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Cantidad."', '0', '0', '".$Total."', '')";
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
