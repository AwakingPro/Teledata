<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Radio{

        function __construct () {
            $run = new Method;
		}
    	public function CrearEstacion($Nombre,$Direccion,$Telefono,$Correo,$Personal,$Contacto,$DuenoCerro,$LatitudCoordenada,$LongitudCoordenada,$LatitudCoordenadaSite,$LongitudCoordenadaSite,$DatosProveedorElectrico){
            $run = new Method;
            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Personal = isset($Personal) ? trim($Personal) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";
            $Contacto = isset($Contacto) ? trim($Contacto) : "";
            $DuenoCerro = isset($DuenoCerro) ? trim($DuenoCerro) : "";
            $LatitudCoordenada = isset($LatitudCoordenada) ? trim($LatitudCoordenada) : "";
            $LongitudCoordenada = isset($LongitudCoordenada) ? trim($LongitudCoordenada) : "";
            $LatitudCoordenadaSite = isset($LatitudCoordenadaSite) ? trim($LatitudCoordenadaSite) : "";
            $LongitudCoordenadaSite = isset($LongitudCoordenadaSite) ? trim($LongitudCoordenadaSite) : "";
            $DatosProveedorElectrico = isset($Correo) ? trim($DatosProveedorElectrico) : "";

            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Personal) && !empty($Correo) && !empty($Contacto)){

                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Personal=$Personal;
                $this->Correo=$Correo;
                $this->Contacto=$Contacto;
                $this->DuenoCerro=$DuenoCerro;
                $this->LatitudCoordenada=$LatitudCoordenada;
                $this->LongitudCoordenada=$LongitudCoordenada;
                $this->LatitudCoordenadaSite=$LatitudCoordenadaSite;
                $this->LongitudCoordenadaSite=$LongitudCoordenadaSite;
                $this->DatosProveedorElectrico=$DatosProveedorElectrico;

                $query = "INSERT INTO mantenedor_site(nombre, direccion, telefono, personal_id, correo, contacto, dueno_cerro, latitud_coordenada, longitud_coordenada, latitud_coordenada_site, longitud_coordenada_site, datos_proveedor_electrico) VALUES ('$this->Nombre','$this->Direccion','$this->Telefono','$this->Personal','$this->Correo','$this->Contacto','$this->DuenoCerro','$this->LatitudCoordenada','$this->LongitudCoordenada','$this->LatitudCoordenadaSite','$this->LongitudCoordenadaSite','$this->DatosProveedorElectrico')";
                
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono, 'personal_id' => $this->Personal, 'correo' => $this->Correo, 'contacto' => $this->Contacto,'dueno_cerro' => $this->DuenoCerro,'latitud_coordenada' => $this->LatitudCoordenada, 'longitud_coordenada' => $this->LongitudCoordenada, 'latitud_coordenada_site' => $this->LatitudCoordenadaSite, 'longitud_coordenada_site' => $this->LongitudCoordenadaSite, 'datos_proveedor_electrico' => $this->DatosProveedorElectrico);

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

        function updateEstacion($Id,$Nombre,$Direccion,$Telefono,$Personal,$Correo,$Contacto,$DuenoCerro,$LatitudCoordenada,$LongitudCoordenada,$LatitudCoordenadaSite,$LongitudCoordenadaSite,$DatosProveedorElectrico){
            $run = new Method;
            $response_array = array();

            $Nombre = isset($Nombre) ? trim($Nombre) : "";
            $Direccion = isset($Direccion) ? trim($Direccion) : "";
            $Telefono = isset($Telefono) ? trim($Telefono) : "";
            $Personal = isset($Personal) ? trim($Personal) : "";
            $Correo = isset($Correo) ? trim($Correo) : "";
            $Contacto = isset($Contacto) ? trim($Contacto) : "";
            $DuenoCerro = isset($DuenoCerro) ? trim($DuenoCerro) : "";
            $LatitudCoordenada = isset($LatitudCoordenada) ? trim($LatitudCoordenada) : "";
            $LongitudCoordenada = isset($LongitudCoordenada) ? trim($LongitudCoordenada) : "";
            $LatitudCoordenadaSite = isset($LatitudCoordenadaSite) ? trim($LatitudCoordenadaSite) : "";
            $LongitudCoordenadaSite = isset($LongitudCoordenadaSite) ? trim($LongitudCoordenadaSite) : "";
            $DatosProveedorElectrico = isset($DatosProveedorElectrico) ? trim($DatosProveedorElectrico) : "";


            if(!empty($Nombre) && !empty($Direccion)  && !empty($Telefono)  && !empty($Personal) && !empty($Correo) && !empty($Contacto)){

                $this->Id=$Id;
                $this->Nombre=$Nombre;
                $this->Direccion=$Direccion;
                $this->Telefono=$Telefono;
                $this->Personal=$Personal;
                $this->Correo=$Correo;
                $this->Contacto=$Contacto;
                $this->DuenoCerro=$DuenoCerro;
                $this->LatitudCoordenada=$LatitudCoordenada;
                $this->LongitudCoordenada=$LongitudCoordenada;
                $this->LatitudCoordenadaSite=$LatitudCoordenadaSite;
                $this->LongitudCoordenadaSite=$LongitudCoordenadaSite;
                $this->DatosProveedorElectrico=$DatosProveedorElectrico;

                $query = "UPDATE `mantenedor_site` set `nombre` = '$this->Nombre', `direccion` = '$this->Direccion', `telefono` = '$this->Telefono', `personal_id` = '$this->Personal', `correo` = '$this->Correo', `contacto` = '$this->Contacto', `dueno_cerro` = '$this->DuenoCerro', `latitud_coordenada` = '$this->LatitudCoordenada', `longitud_coordenada` = '$this->LongitudCoordenada', `latitud_coordenada_site` = '$this->LatitudCoordenadaSite', `longitud_coordenada_site` = '$this->LongitudCoordenadaSite', `datos_proveedor_electrico` = '$this->DatosProveedorElectrico' where `id` = '$this->Id'";
                
                $data = $run->update($query);

                if($data){

                    $array = array('id' => $this->Id, 'nombre' => $this->Nombre,'direccion' => $this->Direccion,'telefono' => $this->Telefono, 'personal_id' => $this->Personal, 'correo' => $this->Correo, 'contacto' => $this->Contacto,'dueno_cerro' => $this->DuenoCerro,'latitud_coordenada' => $this->LatitudCoordenada, 'longitud_coordenada' => $this->LongitudCoordenada, 'latitud_coordenada_site' => $this->LatitudCoordenadaSite, 'longitud_coordenada_site' => $this->LongitudCoordenadaSite, 'datos_proveedor_electrico' => $this->DatosProveedorElectrico);

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

        function deleteEstacion($Id){
            $run = new Method;
            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "SELECT * from `radio_ingresos` where `estacion_id` = '$this->Id'";
                
                $data = $run->select($query);

                if(!$data){

                    $query = "SELECT * from `inventario_ingresos` where `bodega_id` = '$this->Id' and bodega_tipo = '3'";
                    
                    $data = $run->select($query);

                    if(!$data){

                        $query = "DELETE from `mantenedor_site` where `id` = '$this->Id'";
                       
                        $data = $run->delete($query);

                        $query = "DELETE from `inventario_egresos` where `destino_tipo` = '3' and `destino_id` = '$this->Id'";
                        
                        $data = $run->delete($query);

                        $response_array['status'] = 1;

                    }else{
                        $response_array['status'] = 3; 
                    }

                }else{
                    $response_array['status'] = 3; 
                }
                    
               
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showEstaciones(){
            $run = new Method;
            $query = 'SELECT mantenedor_site.*, usuarios.nombre as personal FROM mantenedor_site INNER JOIN usuarios ON mantenedor_site.personal_id = usuarios.id';
           
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);
        }

        function showPersonal(){
            $run = new Method;
            $query = 'SELECT * FROM usuarios';
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showInventario(){
            $run = new Method;
            $query = 'SELECT    inventario_ingresos.*, 
                                mantenedor_modelo_producto.nombre as modelo, 
                                mantenedor_marca_producto.nombre as marca, 
                                mantenedor_tipo_producto.nombre as tipo, 
                                mantenedor_proveedores.nombre as proveedor 
                    FROM        inventario_ingresos 
                    INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id 
                    INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id 
                    INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id 
                    LEFT JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id
                    WHERE (inventario_ingresos.bodega_tipo = 1 OR inventario_ingresos.bodega_tipo IS NULL)';

            
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showIngresos(){
            $run = new Method;
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

           
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        public function CrearIngreso($Estacion,$Funcion,$AlarmaActivada,$DireccionIp,$PuertoAcceso,$AnchoCanal,$Frecuencia,$TxPower,$Producto){
            $run = new Method;
            $response_array = array();

            $Estacion = isset($Estacion) ? trim($Estacion) : "";
            $Funcion = isset($Funcion) ? trim($Funcion) : "";
            $AlarmaActivada = isset($AlarmaActivada) ? trim($AlarmaActivada) : "";
            $DireccionIp = isset($DireccionIp) ? trim($DireccionIp) : "";
            $PuertoAcceso = isset($PuertoAcceso) ? trim($PuertoAcceso) : "";
            $AnchoCanal = isset($AnchoCanal) ? trim($AnchoCanal) : "";
            $Frecuencia = isset($Frecuencia) ? trim($Frecuencia) : "";
            $TxPower = isset($TxPower) ? trim($TxPower) : "";
            $Producto = isset($Producto) ? trim($Producto) : "";

            if(!empty($Estacion) && !empty($Funcion)  && !empty($AlarmaActivada)  && !empty($DireccionIp) &&
                !empty($PuertoAcceso) && !empty($AnchoCanal) && !empty($Frecuencia) &&
                !empty($TxPower) && !empty($Producto)){

                $this->Estacion=$Estacion;
                $this->Funcion=$Funcion;
                $this->AlarmaActivada=$AlarmaActivada;
                $this->DireccionIp=$DireccionIp;
                $this->PuertoAcceso=$PuertoAcceso;
                $this->AnchoCanal=$AnchoCanal;
                $this->Frecuencia=$Frecuencia;
                $this->TxPower=$TxPower;
                $this->Producto=$Producto;

                $query = "INSERT INTO radio_ingresos(estacion_id, funcion, alarma_activada, direccion_ip, puerto_acceso, ancho_canal, frecuencia, tx_power, producto_id, baseid, apid, ssid) VALUES ('$this->Estacion','$this->Funcion','$this->AlarmaActivada','$this->DireccionIp','$this->PuertoAcceso','$this->AnchoCanal','$this->Frecuencia','$this->TxPower','$this->Producto', '', '', '')";
                
                $id = $run->insert($query);

                if($id){

                    $query = "UPDATE inventario_ingresos SET bodega_tipo = '3', bodega_id = '$this->Estacion' where `id` = '$this->Producto'";

                    $ingreso = $run->update($query);

                    if($ingreso){
                        $Usuario=$_SESSION['idUsuario'];
                        $DateTime = new DateTime();
                        $FechaMovimiento = $DateTime->format('Y-m-d');
                        $HoraMovimiento = $DateTime->format('H:i:s');

                        $query = "INSERT INTO inventario_egresos(destino_tipo, destino_id, fecha_movimiento, hora_movimiento, usuario_id, producto_id) VALUES ('3','$this->Estacion','$FechaMovimiento','$HoraMovimiento','$Usuario','$this->Producto')";

                        $egreso = $run->insert($query);

                        if($egreso){

                            $array = array('id'=> $id, 'estacion_id' => $this->Estacion,'funcion' => $this->Funcion,'alarma_activada' => $this->AlarmaActivada, 'direccion_ip' => $this->DireccionIp, 'puerto_acceso' => $this->PuertoAcceso, 'ancho_canal'=> $this->AnchoCanal, 'frecuencia' => $this->Frecuencia, 'tx_power' => $this->TxPower, 'producto_id' => $this->Producto);

                            $response_array['array'] = $array;
                            $response_array['status'] = 1; 

                        }else{
                            $response_array['status'] = 0; 
                            $response_array['error'] = 'Insert Egreso'; 
                        }
                    }else{
                        $response_array['status'] = 0; 
                        $response_array['error'] = 'Update Ingreso'; 
                    }
                }else{
                    $response_array['status'] = 0; 
                    $response_array['error'] = 'Insert Radio'; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

        } 

        public function updateIngreso($Estacion,$Funcion,$AlarmaActivada,$DireccionIp,$PuertoAcceso,$AnchoCanal,$Frecuencia,$TxPower,$Producto,$Id){
            $run = new Method;
            $response_array = array();
            $Estacion = isset($Estacion) ? trim($Estacion) : "";
            $Funcion = isset($Funcion) ? trim($Funcion) : "";
            $AlarmaActivada = isset($AlarmaActivada) ? trim($AlarmaActivada) : "";
            $DireccionIp = isset($DireccionIp) ? trim($DireccionIp) : "";
            $PuertoAcceso = isset($PuertoAcceso) ? trim($PuertoAcceso) : "";
            $AnchoCanal = isset($AnchoCanal) ? trim($AnchoCanal) : "";
            $Frecuencia = isset($Frecuencia) ? trim($Frecuencia) : "";
            $TxPower = isset($TxPower) ? trim($TxPower) : "";
            $Producto = isset($Producto) ? trim($Producto) : "";
            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Estacion) && !empty($Funcion)  && !empty($AlarmaActivada)  && !empty($DireccionIp) &&
                !empty($PuertoAcceso) && !empty($AnchoCanal) && !empty($Frecuencia) &&
                !empty($TxPower) && !empty($Producto)){

                $this->Estacion=$Estacion;
                $this->Funcion=$Funcion;
                $this->AlarmaActivada=$AlarmaActivada;
                $this->DireccionIp=$DireccionIp;
                $this->PuertoAcceso=$PuertoAcceso;
                $this->AnchoCanal=$AnchoCanal;
                $this->Frecuencia=$Frecuencia;
                $this->TxPower=$TxPower;
                $this->Producto=$Producto;
                $this->Id=$Id;

                $query = "UPDATE radio_ingresos SET estacion_id = '$this->Estacion', funcion = '$this->Funcion', alarma_activada = '$this->AlarmaActivada', direccion_ip = '$this->DireccionIp', puerto_acceso = '$this->PuertoAcceso', ancho_canal = '$this->AnchoCanal', frecuencia = '$this->Frecuencia', tx_power = '$this->TxPower', producto_id = '$this->Producto' where `id` = '$this->Id'";
                
                $data = $run->update($query);

                if($data){

                    $array = array('id'=> $this->Id, 'estacion_id' => $this->Estacion,'funcion' => $this->Funcion,'alarma_activada' => $this->AlarmaActivada, 'direccion_ip' => $this->DireccionIp, 'puerto_acceso' => $this->PuertoAcceso, 'ancho_canal'=> $this->AnchoCanal, 'frecuencia' => $this->Frecuencia, 'tx_power' => $this->TxPower, 'producto_id' => $this->Producto);

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

        function deleteIngreso($Id){
            $run = new Method;
            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "SELECT * from `radio_ingresos` where `id` = '$this->Id'";
                
                $data = $run->select($query);

                if($data){

                    $this->Producto = $data[0]['producto_id'];

                    $query = "DELETE from `radio_ingresos` where `id` = '$this->Id'";
                    
                    $data = $run->delete($query);

                    $query = "UPDATE inventario_ingresos SET bodega_tipo = '', bodega_id = '' where id = '$this->Producto'";
                    
                    $data = $run->update($query);

                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0;
                }
               
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        public function showSelectpicker($TipoBusquedaRegistro){
            $run = new Method;
            $response_array = array();

            $TipoBusquedaRegistro = isset($TipoBusquedaRegistro) ? trim($TipoBusquedaRegistro) : "";

            if(!empty($TipoBusquedaRegistro)){

                $this->TipoBusquedaRegistro=$TipoBusquedaRegistro;

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

                $data = $run->select($query);

                $response_array['array'] = $data;
                $response_array['status'] = 1; 
                    
               
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

        }

        public function buscarRegistro($TipoBusquedaRegistro,$InputRegistro){
            $run = new Method;
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
                    $query = $query . " WHERE mantenedor_site.nombre = '$InputRegistro'";
                }else if($TipoBusquedaRegistro == 2){
                    $query = $query . " WHERE radio_ingresos.direccion_ip = '$InputRegistro'";
                }else{
                    $query = $query . " WHERE inventario_ingresos.mac_address = '$InputRegistro'";
                }

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
