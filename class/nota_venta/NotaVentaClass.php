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

                $this->Codigo=$Codigo;
                $this->Cantidad=intval($Cantidad);
                $this->Usuario=$_SESSION['idUsuario'];

                $query = "SELECT mantenedor_servicios.servicio as Servicio, servicios.Valor as Precio FROM servicios LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio where servicios.Codigo = '$this->Codigo'";
                $run = new Method;
                $ServicioSQL = $run->select($query);

                if($ServicioSQL){

                    $this->Servicio=$ServicioSQL[0]['Servicio'];
                    $this->Precio=floatval($ServicioSQL[0]['Precio']);

                }else{

                    $Precio = str_replace('.','',$Precio);
                    $this->Servicio=$Servicio;
                    $this->Precio=floatval($Precio);
                }

                $this->Total = $this->Precio * $this->Cantidad;

                $Impuesto = $this->Total * 0.19;
                $this->Total = $this->Total + $Impuesto;
                
                $query = "INSERT INTO nota_venta_tmp(codigo, servicio, cantidad, precio, exencion, total, usuario_id) VALUES ('$this->Codigo','$this->Servicio','$this->Cantidad','$this->Precio','1','$this->Total','$this->Usuario')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    if($Cliente){

                        $query = "SELECT mantenedor_servicios.servicio as Servicio, servicios.Valor as Precio FROM servicios LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio where servicios.Codigo = '$this->Codigo'";
                        $run = new Method;
                        $data = $run->select($query);

                        if(!$data){
                            $query = "INSERT INTO servicios(Rut, Valor, Codigo, Grupo, TipoFactura, Descuento, IdServicio, TipoFacturacion, Descripcion) VALUES ('$Cliente', '$this->Precio','$this->Codigo','','','','','','')";
                            $run = new Method;
                            $servicio = $run->insert($query);
                        }
                    }

                    $array = array('id'=> $id, 'codigo' => $this->Codigo, 'servicio' => $this->Servicio, 'cantidad' => $this->Cantidad, 'precio' => $this->Precio, 'total' => $this->Total);

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

        public function GuardarNotaVenta($Cliente,$Fecha,$NumeroOc,$SolicitadoPor,$Retiro){

            $response_array = array();

            $Cliente = isset($Cliente) ? trim($Cliente) : "";
            $Fecha = isset($Fecha) ? trim($Fecha) : "";
            $NumeroOc = isset($NumeroOc) ? trim($NumeroOc) : "";
            $SolicitadoPor = isset($SolicitadoPor) ? trim($SolicitadoPor) : "";
            $Retiro = isset($Retiro) ? trim($Retiro) : "";

            if(!empty($Cliente) && !empty($Fecha) && !empty($NumeroOc) && !empty($SolicitadoPor) && !empty($Retiro)){

                session_start();

                $this->Cliente=$Cliente;
                $this->Fecha=$Fecha;
                $this->NumeroOc=$NumeroOc;
                $this->SolicitadoPor=$SolicitadoPor;
                $this->Retiro=$Retiro;
                $this->Usuario=$_SESSION['idUsuario'];

                $query = "SELECT * FROM nota_venta_tmp where usuario_id = '$this->Usuario'";
                $run = new Method;
                $detalle_nota = $run->select($query);

                if($detalle_nota){

                    $Fecha = DateTime::createFromFormat('d-m-Y', $Fecha)->format('Y-m-d');

                    $query = "INSERT INTO nota_venta(rut, fecha, numero_oc, solicitado_por, retiro) VALUES ('$this->Cliente','$Fecha','$this->NumeroOc','$this->SolicitadoPor','$this->Retiro')";
                    $run = new Method;
                    $id  = $run->insert($query);

                    if($id){

                        $this->Id=$id;

                        foreach($detalle_nota as $detalle){

                            $this->Codigo=$detalle['codigo'];
                            $this->Cantidad=$detalle['cantidad'];
                            $this->Exencion=$detalle['exencion'];
                            $this->Servicio=$detalle['servicio'];
                            $this->Precio=$detalle['precio'];
                            $this->Total=$detalle['total'];

                            $query = "INSERT INTO nota_venta_detalle(nota_venta_id, codigo, servicio, cantidad, precio, exencion, total) VALUES ('$this->Id', '$this->Codigo','$this->Servicio','$this->Cantidad','$this->Precio','$this->Exencion','$this->Total')";
                            $run = new Method;
                            $data = $run->insert($query);
                        }

                        $array = array('id'=> $id, 'rut' => $this->Cliente, 'fecha' => $this->Fecha, 'numero_oc' => $this->NumeroOc, 'solicitado_por' => $this->SolicitadoPor);
                        
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
            $this->Usuario=$_SESSION['idUsuario'];

            $query = "DELETE from `nota_venta_tmp` where `usuario_id` = '$this->Usuario'";
            $run = new Method;
            $data = $run->delete($query);

            $query = 'SELECT * FROM personaempresa';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showCliente($rut){

            session_start();
            $this->Usuario=$_SESSION['idUsuario'];

            $query = "DELETE from `nota_venta_tmp` where `usuario_id` = '$this->Usuario'";
            $run = new Method;
            $data = $run->delete($query);

            $query = "SELECT * FROM personaempresa where `Rut` = '$rut'";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showCodigos($rut){

            $query = "SELECT * FROM servicios WHERE `Rut` = '$rut'";
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

                $this->Id=$Id;

                $query = "SELECT * from `nota_venta_tmp` where `Id` = '$this->Id'";
                $run = new Method;
                $data = $run->select($query);

                if($data){

                    $response_array['array'] = $data;

                    $query = "DELETE from `nota_venta_tmp` where `Id` = '$this->Id'";
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

            $query = 'SELECT * FROM nota_venta';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function deleteNotaVenta($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "DELETE from `nota_venta` where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->delete($query);
                $response_array['status'] = 1; 
                    
               
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }
    }

?>
