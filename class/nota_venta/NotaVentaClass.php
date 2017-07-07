<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class NotaVenta{

    	public function GuardarServicio($Codigo,$Cantidad,$Exencion){

            $response_array = array();

            $Codigo = isset($Codigo) ? trim($Codigo) : "";
            $Cantidad = isset($Cantidad) ? trim($Cantidad) : "";
            $Exencion = isset($Exencion) ? trim($Exencion) : "";

            if(!empty($Codigo) && !empty($Cantidad)){

                session_start();

                $this->Codigo=$Codigo;
                $this->Cantidad=$Cantidad;
                $this->Exencion=$Exencion;
                $this->Usuario=$_SESSION['idUsuario'];

                $query = "SELECT mantenedor_servicios.*, servicios.Valor as Precio FROM mantenedor_servicios INNER JOIN servicios ON servicios.IdServicio = mantenedor_servicios.id where servicios.Codigo = '$this->Codigo'";
                $run = new Method;
                $Servicio = $run->select($query);

                if($Servicio){

                    $this->Servicio=$Servicio[0]['servicio'];
                    $this->Precio=$Servicio[0]['Precio'];
                    $this->Total= floatval($this->Precio) * intval($this->Cantidad);

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
                    $response_array['status'] = 0; 
                }
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

        function showIngresos(){

            $query = '  SELECT  radio_ingresos.*, 
                                inventario_ingresos.mac_address as mac_address,
                                mantenedor_modelo_producto.nombre as modelo, 
                                mantenedor_marca_producto.nombre as marca, 
                                mantenedor_tipo_producto.nombre as tipo, 
                                mantenedor_site.nombre as estacion
                        FROM radio_ingresos 
                        INNER JOIN inventario_ingresos        ON radio_ingresos.producto_id = inventario_ingresos.id
                        INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id 
                        INNER JOIN mantenedor_marca_producto  ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id 
                        INNER JOIN mantenedor_tipo_producto   ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id 
                        INNER JOIN mantenedor_site            ON radio_ingresos.estacion_id = mantenedor_site.id';

            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        public function CrearIngreso($Estacion,$Funcion,$AlarmaActivada,$DireccionIp,$PuertoAcceso,$AnchoCanal,$APID,$BASEID,$Frecuencia,$TxPower,$Producto,$SSID){

            $response_array = array();

            $Estacion = isset($Estacion) ? trim($Estacion) : "";
            $Funcion = isset($Funcion) ? trim($Funcion) : "";
            $AlarmaActivada = isset($AlarmaActivada) ? trim($AlarmaActivada) : "";
            $DireccionIp = isset($DireccionIp) ? trim($DireccionIp) : "";
            $PuertoAcceso = isset($PuertoAcceso) ? trim($PuertoAcceso) : "";
            $AnchoCanal = isset($AnchoCanal) ? trim($AnchoCanal) : "";
            $APID = isset($APID) ? trim($APID) : "";
            $BASEID = isset($BASEID) ? trim($BASEID) : "";
            $Frecuencia = isset($Frecuencia) ? trim($Frecuencia) : "";
            $TxPower = isset($TxPower) ? trim($TxPower) : "";
            $Producto = isset($Producto) ? trim($Producto) : "";
            $SSID = isset($SSID) ? trim($SSID) : "";

            if(!empty($Estacion) && !empty($Funcion)  && !empty($AlarmaActivada)  && !empty($DireccionIp) &&
                !empty($PuertoAcceso) && !empty($AnchoCanal) && !empty($APID)  && !empty($BASEID)  && !empty($Frecuencia) &&
                !empty($TxPower) && !empty($Producto) && !empty($SSID)){

                $this->Estacion=$Estacion;
                $this->Funcion=$Funcion;
                $this->AlarmaActivada=$AlarmaActivada;
                $this->DireccionIp=$DireccionIp;
                $this->PuertoAcceso=$PuertoAcceso;
                $this->AnchoCanal=$AnchoCanal;
                $this->APID=$APID;
                $this->BASEID=$BASEID;
                $this->Frecuencia=$Frecuencia;
                $this->TxPower=$TxPower;
                $this->Producto=$Producto;
                $this->SSID=$SSID;

                $query = "INSERT INTO radio_ingresos(estacion_id, funcion, alarma_activada, direccion_ip, puerto_acceso, ancho_canal, apid, baseid, frecuencia, tx_power, producto_id, ssid) VALUES ('$this->Estacion','$this->Funcion','$this->AlarmaActivada','$this->DireccionIp','$this->PuertoAcceso','$this->AnchoCanal','$this->APID','$this->BASEID','$this->Frecuencia','$this->TxPower','$this->Producto','$this->SSID')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'estacion_id' => $this->Estacion,'funcion' => $this->Funcion,'alarma_activada' => $this->AlarmaActivada, 'direccion_ip' => $this->DireccionIp, 'puerto_acceso' => $this->PuertoAcceso, 'ancho_canal'=> $this->AnchoCanal, 'apid' => $this->APID, 'baseid' => $this->BASEID, 'frecuencia' => $this->Frecuencia, 'tx_power' => $this->TxPower, 'producto_id' => $this->Producto, 'ssid' => $this->SSID);

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

        public function updateIngreso($Estacion,$Funcion,$AlarmaActivada,$DireccionIp,$PuertoAcceso,$AnchoCanal,$APID,$BASEID,$Frecuencia,$TxPower,$Producto,$SSID,$Id){

            $response_array = array();

            $Estacion = isset($Estacion) ? trim($Estacion) : "";
            $Funcion = isset($Funcion) ? trim($Funcion) : "";
            $AlarmaActivada = isset($AlarmaActivada) ? trim($AlarmaActivada) : "";
            $DireccionIp = isset($DireccionIp) ? trim($DireccionIp) : "";
            $PuertoAcceso = isset($PuertoAcceso) ? trim($PuertoAcceso) : "";
            $AnchoCanal = isset($AnchoCanal) ? trim($AnchoCanal) : "";
            $APID = isset($APID) ? trim($APID) : "";
            $BASEID = isset($BASEID) ? trim($BASEID) : "";
            $Frecuencia = isset($Frecuencia) ? trim($Frecuencia) : "";
            $TxPower = isset($TxPower) ? trim($TxPower) : "";
            $Producto = isset($Producto) ? trim($Producto) : "";
            $SSID = isset($SSID) ? trim($SSID) : "";
            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Estacion) && !empty($Funcion)  && !empty($AlarmaActivada)  && !empty($DireccionIp) &&
                !empty($PuertoAcceso) && !empty($AnchoCanal) && !empty($APID)  && !empty($BASEID)  && !empty($Frecuencia) &&
                !empty($TxPower) && !empty($Producto) && !empty($SSID)){

                $this->Estacion=$Estacion;
                $this->Funcion=$Funcion;
                $this->AlarmaActivada=$AlarmaActivada;
                $this->DireccionIp=$DireccionIp;
                $this->PuertoAcceso=$PuertoAcceso;
                $this->AnchoCanal=$AnchoCanal;
                $this->APID=$APID;
                $this->BASEID=$BASEID;
                $this->Frecuencia=$Frecuencia;
                $this->TxPower=$TxPower;
                $this->Producto=$Producto;
                $this->SSID=$SSID;
                $this->Id=$Id;

                $query = "UPDATE radio_ingresos SET estacion_id = '$this->Estacion', funcion = '$this->Funcion', alarma_activada = '$this->AlarmaActivada', direccion_ip = '$this->DireccionIp', puerto_acceso = '$this->PuertoAcceso', ancho_canal = '$this->AnchoCanal', apid = '$this->APID', baseid = '$this->BASEID', frecuencia = '$this->Frecuencia', tx_power = '$this->TxPower', producto_id = '$this->Producto', ssid = '$this->SSID' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);

                // if($id){

                    $array = array('id'=> $this->Id, 'estacion_id' => $this->Estacion,'funcion' => $this->Funcion,'alarma_activada' => $this->AlarmaActivada, 'direccion_ip' => $this->DireccionIp, 'puerto_acceso' => $this->PuertoAcceso, 'ancho_canal'=> $this->AnchoCanal, 'apid' => $this->APID, 'baseid' => $this->BASEID, 'frecuencia' => $this->Frecuencia, 'tx_power' => $this->TxPower, 'producto_id' => $this->Producto, 'ssid' => $this->SSID);

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

        function deleteIngreso($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "DELETE from `radio_ingresos` where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);
                $response_array['status'] = 1; 
               
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        public function buscarRegistro($TipoBusquedaRegistro,$InputRegistro){

            $response_array = array();

            $TipoBusquedaRegistro = isset($TipoBusquedaRegistro) ? trim($TipoBusquedaRegistro) : "";
            $InputRegistro = isset($InputRegistro) ? trim($InputRegistro) : "";

            if(!empty($TipoBusquedaRegistro) && !empty($InputRegistro)){

                $this->TipoBusquedaRegistro=$TipoBusquedaRegistro;
                $this->InputRegistro=$InputRegistro;

                $query = '  SELECT  radio_ingresos.*, 
                                inventario_ingresos.mac_address as mac_address,
                                mantenedor_modelo_producto.nombre as modelo, 
                                mantenedor_marca_producto.nombre as marca, 
                                mantenedor_tipo_producto.nombre as tipo, 
                                mantenedor_site.nombre as estacion
                        FROM radio_ingresos 
                        INNER JOIN inventario_ingresos        ON radio_ingresos.producto_id = inventario_ingresos.id
                        INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id 
                        INNER JOIN mantenedor_marca_producto  ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id 
                        INNER JOIN mantenedor_tipo_producto   ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id 
                        INNER JOIN mantenedor_site            ON radio_ingresos.estacion_id = mantenedor_site.id';

                if($TipoBusquedaRegistro == 1){
                    $query = $query . " WHERE mantenedor_site.nombre LIKE '%$InputRegistro%'";
                }else if($TipoBusquedaRegistro == 2){
                    $query = $query . " WHERE radio_ingresos.direccion_ip LIKE '%$InputRegistro%'";
                }else if($TipoBusquedaRegistro == 3){
                    $query = $query . " WHERE radio_ingresos.ssid LIKE '%$InputRegistro%'";
                }else{
                    $query = $query . " WHERE inventario_ingresos.mac_address LIKE '%$InputRegistro%'";
                }

                $run = new Method;
                $data = $run->select($query);

                if($data){

                    $response_array['array'] = $data;
                    $response_array['status'] = 1; 
                    
                }else{
                    $response_array['status'] = 0; 
                }
            }else{
                $response_array['status'] = 2; 
            }

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
