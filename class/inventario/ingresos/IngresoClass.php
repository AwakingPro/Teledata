<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Ingreso{

    	public function storeIngreso($FechaCompra,$FechaIngreso,$NumeroFactura,$NumeroSerie,$Modelo,$Proveedor,$Valor,$Cantidad,$Bodega,$MacAddress,$TipoIngreso,$Estado,$Json){

            $response_array = array();

            $FechaCompra = isset($FechaCompra) ? trim($FechaCompra) : "";
            $FechaIngreso = isset($FechaIngreso) ? trim($FechaIngreso) : "";
            $NumeroFactura = isset($NumeroFactura) ? trim($NumeroFactura) : "";
            $NumeroSerie = isset($NumeroSerie) ? trim($NumeroSerie) : "";
            $Modelo = isset($Modelo) ? trim($Modelo) : "";
            $Proveedor = isset($Proveedor) ? trim($Proveedor) : "";
            $Valor = isset($Valor) ? trim($Valor) : "";
            $Cantidad = isset($Cantidad) ? trim($Cantidad) : "";
            $Bodega = isset($Bodega) ? trim($Bodega) : "";
            $MacAddress = isset($MacAddress) ? trim($MacAddress) : "";
            $TipoIngreso = isset($TipoIngreso) ? trim($TipoIngreso) : "";
            $Estado = isset($TipoIngreso) ? trim($Estado) : "";
            $Json = isset($Json) ? trim($Json) : "";

            if($TipoIngreso == 1){
                if($NumeroSerie && $MacAddress){
                    $Boolean1 = true;
                }else{
                    $Boolean1 = false;
                }
            }else{
                $Boolean1 = true;
            }

            if($Estado == 1){
                if($FechaCompra && $NumeroFactura && $Proveedor){
                    $Boolean2 = true;
                }else{
                    $Boolean2 = false;
                }
            }else{
                $Boolean2 = true;
            }

            if($Boolean1 && $Boolean2){
                $Acceso = true;
            }else{
                $Acceso = false;
            }

            if(!$Valor){
                $Valor = 0;
            }

            if(!empty($FechaIngreso) && !empty($Bodega) && !empty($Modelo) && !empty($Cantidad) && !empty($Estado) && $Acceso){

                session_start();

                $this->FechaCompra=$FechaCompra;
                $this->FechaIngreso=$FechaIngreso;
                $this->NumeroFactura=$NumeroFactura;
                $this->NumeroSerie=$NumeroSerie;
                $this->Modelo=$Modelo;
                $this->Proveedor=$Proveedor;
                $this->Valor=$Valor;
                $this->Cantidad=$Cantidad;
                $this->Bodega=$Bodega;
                $this->MacAddress=$MacAddress;
                $this->Estado=$Estado;
                $this->Usuario=$_SESSION['idUsuario'];

                if($FechaCompra){
                    $FechaCompra = DateTime::createFromFormat('d-m-Y', $FechaCompra)->format('Y-m-d');
                }
               
                $FechaIngreso = DateTime::createFromFormat('d-m-Y', $FechaIngreso)->format('Y-m-d');
                $array = array();

                if($TipoIngreso == 2){

                    if(!$Json){
            
                        $response_array['status'] = 99; 

                    }else{
                       
                        $Json = json_decode($Json, true);

                        foreach($Json as $Value)
                        {
                            $MacAddress=$Value['mac_address'];
                            $NumeroSerie="";

                            $query = "INSERT INTO inventario_ingresos(fecha_compra, fecha_ingreso, numero_factura, modelo_producto_id, proveedor_id, valor, cantidad, bodega_id, usuario_id, numero_serie, mac_address, estado) VALUES ('$FechaCompra','$FechaIngreso','$this->NumeroFactura','$this->Modelo','$this->Proveedor','$this->Valor','1','$this->Bodega','$this->Usuario','$NumeroSerie','$MacAddress','$this->Estado')";
                            $run = new Method;
                            $id = $run->insert($query);

                            if($id){

                                $tmp = array('id' => $id, 'fecha_compra' => $this->FechaCompra, 'fecha_ingreso' => $this->FechaIngreso, 'numero_factura' => $this->NumeroFactura,'modelo_producto_id' => $this->Modelo, 'proveedor_id' => $this->Proveedor, 'valor' => $this->Valor,'cantidad' => 1, 'bodega_id' => $this->Bodega, 'usuario_id' => $this->Usuario, 'numero_serie' => $NumeroSerie, 'mac_address' => $MacAddress, 'estado' => $this->Estado);


                                array_push($array,$tmp);
                                $response_array['array'] = $array;
                                $response_array['status'] = 1; 
                            }else{
                                $response_array['status'] = 'Error Json'; 
                            }
                        }
                     }
                }else{
                    $query = "INSERT INTO inventario_ingresos(fecha_compra, fecha_ingreso, numero_factura, modelo_producto_id, proveedor_id, valor, cantidad, bodega_id, usuario_id, numero_serie, mac_address, estado) VALUES ('$FechaCompra','$FechaIngreso','$this->NumeroFactura','$this->Modelo','$this->Proveedor','$this->Valor','$this->Cantidad','$this->Bodega','$this->Usuario','$this->NumeroSerie','$this->MacAddress','$this->Estado')";
                    $run = new Method;
                    $id = $run->insert($query);

                    if($id){

                        $tmp = array('id' => $id, 'fecha_compra' => $this->FechaCompra, 'fecha_ingreso' => $this->FechaIngreso, 'numero_factura' => $this->NumeroFactura,'modelo_producto_id' => $this->Modelo, 'proveedor_id' => $this->Proveedor, 'valor' => $this->Valor,'cantidad' => $this->Cantidad, 'bodega_id' => $this->Bodega, 'usuario_id' => $this->Usuario, 'numero_serie' => $this->NumeroSerie, 'mac_address' => $this->MacAddress, 'estado' => $this->Estado);

                        array_push($array,$tmp);

                        $response_array['array'] = $array;
                        $response_array['status'] = 1; 
                    }else{
                        $response_array['status'] = 'Error Registro'; 
                    }
                }

            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

    	} 

        public function updateIngreso($FechaCompra,$FechaIngreso,$NumeroFactura,$NumeroSerie,$Modelo,$Proveedor,$Valor,$Cantidad,$Bodega,$MacAddress,$Estado,$Id){

            $response_array = array();

            $FechaCompra = isset($FechaCompra) ? trim($FechaCompra) : "";
            $FechaIngreso = isset($FechaIngreso) ? trim($FechaIngreso) : "";
            $NumeroFactura = isset($NumeroFactura) ? trim($NumeroFactura) : "";
            $NumeroSerie = isset($NumeroSerie) ? trim($NumeroSerie) : "";
            $Modelo = isset($Modelo) ? trim($Modelo) : "";
            $Proveedor = isset($Proveedor) ? trim($Proveedor) : "";
            $Valor = isset($Valor) ? trim($Valor) : "";
            $Cantidad = isset($Cantidad) ? trim($Cantidad) : "";
            $Bodega = isset($Bodega) ? trim($Bodega) : "";
            $MacAddress = isset($MacAddress) ? trim($MacAddress) : "";
            $Estado = isset($Estado) ? trim($Estado) : "";

            if($Estado == 1){
                if($FechaCompra && $NumeroFactura && $Proveedor && $Valor){
                    $Acceso = true;
                }else{
                    $Acceso = false;
                }
            }else{
                $Acceso = true;
            }

            if(!$Valor){
                $Valor = 0;
            }

            if(!empty($FechaIngreso) && !empty($Bodega) && !empty($Modelo) && !empty($Cantidad) && !empty($Estado) && !empty($MacAddress) && !empty($NumeroSerie) && $Acceso){

                $this->Id=$Id;
                $this->FechaCompra=$FechaCompra;
                $this->FechaIngreso=$FechaIngreso;
                $this->NumeroFactura=$NumeroFactura;
                $this->NumeroSerie=$NumeroSerie;
                $this->Modelo=$Modelo;
                $this->Proveedor=$Proveedor;
                $this->Valor=$Valor;
                $this->Cantidad=$Cantidad;
                $this->Bodega=$Bodega;
                $this->MacAddress=$MacAddress;
                $this->Estado=$Estado;

                $FechaCompra = DateTime::createFromFormat('d-m-Y', $FechaCompra)->format('Y-m-d');
                $FechaIngreso = DateTime::createFromFormat('d-m-Y', $FechaIngreso)->format('Y-m-d');

                $query = "UPDATE `inventario_ingresos` set `fecha_compra` = '$FechaCompra', `fecha_ingreso` = '$FechaIngreso', `numero_factura` = '$this->NumeroFactura', `modelo_producto_id` = '$this->Modelo', `proveedor_id` = '$this->Proveedor', `valor` = '$this->Valor', `cantidad` = '$this->Cantidad', `bodega_id` = '$this->Bodega', `numero_serie` = '$this->NumeroSerie' , `mac_address` = '$this->MacAddress', `estado` = '$this->Estado' where `id` = '$this->Id'";
                $run = new Method;
                $id = $run->insert($query);

                // if($id){

                    $array = array('id' => $this->Id, 'fecha_compra' => $this->FechaCompra, 'fecha_ingreso' => $this->FechaIngreso, 'numero_factura' => $this->NumeroFactura,'modelo_producto_id' => $this->Modelo, 'proveedor_id' => $this->Proveedor, 'valor' => $this->Valor,'cantidad' => $this->Cantidad, 'bodega_id' => $this->Bodega, 'numero_serie' => $this->NumeroSerie, 'mac_address' => $this->MacAddress, 'estado' => $this->Estado);

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

                $query = "DELETE from `inventario_egresos` where `producto_id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);
                $query = "DELETE from `inventario_ingresos` where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);
                $response_array['status'] = 1; 

                
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showIngreso(){

            $query = 'SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo, mantenedor_proveedores.nombre as proveedor, mantenedor_bodegas.nombre as bodega FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id INNER JOIN mantenedor_bodegas ON inventario_ingresos.bodega_id = mantenedor_bodegas.id LEFT JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id';

            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showModelo(){

            $query = 'SELECT mantenedor_modelo_producto.*, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo FROM mantenedor_modelo_producto INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showProveedor(){

            $query = 'SELECT * FROM mantenedor_proveedores';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showBodega(){

            $query = 'SELECT * FROM mantenedor_bodegas where principal = 1';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showReporte($BodegaTipo,$BodegaId,$ModeloProductoId){

            $query = "SELECT inventario_ingresos.*, mantenedor_modelo_producto.id as producto_id, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo, mantenedor_proveedores.nombre as proveedor, mantenedor_bodegas.nombre as bodega FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id INNER JOIN mantenedor_bodegas ON inventario_ingresos.bodega_id = mantenedor_bodegas.id INNER JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id";

            if($BodegaTipo || $BodegaId || $ModeloProductoId){
                $query = $query . " where";
            }

            if($BodegaTipo){
                $query = $query . " inventario_ingresos.bodega_tipo = '$BodegaTipo'";
            }

            if($BodegaId){
                if($BodegaTipo){
                    $query = $query . " and inventario_ingresos.bodega_id = '$BodegaId'";
                }else{
                    $query = $query . " inventario_ingresos.bodega_id = '$BodegaId'";
                }
            }

            if($ModeloProductoId){
                if($BodegaTipo OR $BodegaId){
                    $query = $query . " and inventario_ingresos.modelo_producto_id = '$ModeloProductoId'";
                }else{
                    $query = $query . " inventario_ingresos.modelo_producto_id = '$ModeloProductoId'";
                }
            }

            $run = new Method;
            $array = $run->select($query);

            $response_array['array'] = $array;

            $pie = array();

            foreach($array as $data){
                $producto_id = $data['producto_id'];
                if(isset($pie[$producto_id])){
                    $pie[$producto_id]['cantidad']++;
                }else{
                    $pie[$producto_id] = ['nombre' => $data['tipo'] . ' ' .  $data['marca'] . ' ' . $data['modelo'], 'cantidad' => 1];
                }
            }

            $response_array['pie'] = $pie;

            echo json_encode($response_array);

        }

        public function showSelectpicker($TipoBusquedaRegistro){

            $response_array = array();

            $TipoBusquedaRegistro = isset($TipoBusquedaRegistro) ? trim($TipoBusquedaRegistro) : "";

            if(!empty($TipoBusquedaRegistro)){

                $this->TipoBusquedaRegistro=$TipoBusquedaRegistro;

                $query = 'SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo, mantenedor_proveedores.nombre as proveedor, mantenedor_bodegas.nombre as bodega FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id INNER JOIN mantenedor_bodegas ON inventario_ingresos.bodega_id = mantenedor_bodegas.id LEFT JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id';

                $run = new Method;
                $data = $run->select($query);

                $response_array['array'] = $data;
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

                $query = 'SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo, mantenedor_proveedores.nombre as proveedor, mantenedor_bodegas.nombre as bodega FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id INNER JOIN mantenedor_bodegas ON inventario_ingresos.bodega_id = mantenedor_bodegas.id LEFT JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id';

                if($TipoBusquedaRegistro == 1){
                    $query = $query . " WHERE mantenedor_modelo_producto.nombre LIKE '%$InputRegistro%'";
                }else if($TipoBusquedaRegistro == 2){
                    $query = $query . " WHERE mantenedor_marca_producto.nombre LIKE '%$InputRegistro%'";
                }else if($TipoBusquedaRegistro == 3){
                    $query = $query . " WHERE mantenedor_tipo_producto.nombre LIKE '%$InputRegistro%'";
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
