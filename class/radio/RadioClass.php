<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Radio{

    	public function CrearEstacion($Nombre,$Direccion,$Telefono,$Personal,$Correo){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Personal = isset($Personal) ? trim($Personal) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";

            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Personal) &&
                !empty($Correo)){

                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Personal=$Personal;
                $this->Correo=$Correo;

                $query = "INSERT INTO mantenedor_site(nombre, direccion, telefono, personal_id, correo) VALUES ('$this->Nombre','$this->Direccion','$this->Telefono','$this->Personal','$this->Correo')";
                $run = new Method;
                $id = $run->insert($query);

                // if($data){

                    $array = array('id'=> $id, 'nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono, 'personal_id' => $this->Personal, 'correo' => $this->Correo);

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

        function updateEstacion($Nombre,$Direccion,$Telefono,$Personal,$Correo, $Id){

            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Personal = isset($Personal) ? trim($Personal) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";

            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Personal) &&
                !empty($Correo)){

                $this->Id=$Id;
                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Personal=$Personal;
                $this->Correo=$Correo;

                $query = "UPDATE `mantenedor_site` set `nombre` = '$this->Nombre', `direccion` = '$this->Direccion', `telefono` = '$this->Telefono', `personal_id` = '$this->Personal', `correo` = '$this->Correo' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);

                // if($data){

                    $array = array('nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono, 'personal_id' => $this->Personal, 'correo' => $this->Correo, 'id' => $this->Id);

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

        function deleteEstacion($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "DELETE from `mantenedor_site` where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);
                $response_array['status'] = 1; 
                    
               
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showEstaciones(){

            $query = 'SELECT mantenedor_site.*, usuarios.nombre as personal FROM mantenedor_site INNER JOIN usuarios ON mantenedor_site.personal_id = usuarios.id';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showPersonal(){

            $query = 'SELECT * FROM usuarios';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showInventario(){

            $query = 'SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo, mantenedor_proveedores.nombre as proveedor, mantenedor_bodegas.nombre as bodega FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id INNER JOIN mantenedor_bodegas ON inventario_ingresos.bodega_id = mantenedor_bodegas.id LEFT JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id';

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
    }

?>
