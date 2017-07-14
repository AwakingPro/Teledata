<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class NotaVenta{

    	public function GuardarServicio($Codigo,$Servicio,$Cantidad,$Precio,$Exencion){

            $response_array = array();

            $Codigo = isset($Codigo) ? trim($Codigo) : "";
            $Servicio = isset($Cantidad) ? trim($Cantidad) : "";
            $Cantidad = isset($Codigo) ? trim($Codigo) : "";
            $Precio = isset($Cantidad) ? trim($Cantidad) : "";
            $Exencion = isset($Cantidad) ? trim($Cantidad) : "";

            if(!empty($Codigo) && !empty($Servicio) && !empty($Cantidad) && !empty($Precio) && !empty($Exencion)){

                session_start();

                $this->Codigo=$Codigo;
                $this->Cantidad=intval($Cantidad);
                $this->Exencion=$Exencion;
                $this->Usuario=$_SESSION['idUsuario'];

                $query = "SELECT mantenedor_servicios.*, servicios.Valor as Precio FROM mantenedor_servicios INNER JOIN servicios ON servicios.IdServicio = mantenedor_servicios.id where servicios.Codigo = '$this->Codigo'";
                $run = new Method;
                $ServicioSQL = $run->select($query);

                if($ServicioSQL){

                    $this->Servicio=$ServicioSQL[0]['servicio'];
                    $this->Precio=floatval($ServicioSQL[0]['Precio']);
                    $this->Total= $this->Precio * $this->Cantidad;

                }else{
                    $find = array('.',',');
                    $Precio = str_replace($find,'',$Precio);
                    $this->Servicio=$Servicio;
                    $this->Precio=floatval($Precio);
                    $this->Total= $this->Precio * $this->Cantidad;
                }

                $query = "INSERT INTO nota_venta_tmp(codigo, servicio, cantidad, precio, exencion, total, usuario_id) VALUES ('$this->Codigo','$this->Servicio','$this->Cantidad','$this->Precio','$this->Exencion','$this->Total','$this->Usuario')";
                $run = new Method;
                $id = $run->insert($query);

                // if($data){

                    $array = array('id'=> $id, 'codigo' => $this->Codigo, 'servicio' => $this->Servicio, 'cantidad' => $this->Cantidad, 'precio' => $this->Precio, 'exencion' => $this->Exencion, 'total' => $this->Total);

                    $response_array['array'] = $array;
                    $response_array['status'] = 1; 
                // }else{
                //     $response_array['status'] = 0; 
                // }
            
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

    	} 

        public function GuardarNotaVenta($Cliente,$Fecha){

            $response_array = array();

            $Cliente = isset($Cliente) ? trim($Cliente) : "";
            $Fecha = isset($Fecha) ? trim($Fecha) : "";

            if(!empty($Cliente) && !empty($Fecha)){

                session_start();

                $this->Cliente=$Cliente;
                $this->Fecha=$Fecha;
                $this->Usuario=$_SESSION['idUsuario'];

                $query = "SELECT * FROM nota_venta_tmp where usuario_id = '$this->Usuario'";
                $run = new Method;
                $detalle_nota = $run->select($query);

                if($detalle_nota){

                    $Fecha = DateTime::createFromFormat('d-m-Y', $Fecha)->format('Y-m-d');

                    $query = "INSERT INTO nota_venta(rut, fecha) VALUES ('$this->Cliente','$Fecha')";
                    $run = new Method;
                    $id = $run->insert($query);

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
                        
                         $response_array['status'] = 1; 
                        // }else{
                        //     $response_array['status'] = 0; 
                        // }
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
            $data = $run->insert($query);

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
            $data = $run->insert($query);

            $query = "SELECT * FROM personaempresa where `rut` = '$rut'";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showCodigos($rut){

            $query = "SELECT * FROM servicios WHERE `rut` = '$rut'";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showServicio($codigo){

            $query = "SELECT mantenedor_servicios.*, servicios.Valor as precio FROM mantenedor_servicios INNER JOIN servicios ON servicios.IdServicio = mantenedor_servicios.id where servicios.Codigo = '$codigo'";

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

                $query = "SELECT * from `nota_venta_tmp` where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->select($query);

                if($data){

                    $response_array['array'] = $data;

                    $query = "DELETE from `nota_venta_tmp` where `id` = '$this->Id'";
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
    }

?>