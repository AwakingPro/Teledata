<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Ingreso{
        function __construct () {
			$run = new Method;
        }
    	public function storeIngreso($FechaCompra,$FechaIngreso,$NumeroFactura,$NumeroSerie,$Modelo,$Proveedor,$Valor,$Cantidad,$Bodega,$MacAddress,$TipoIngreso,$Estado,$ArrayMacAddress){

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
            $ArrayMacAddress = isset($ArrayMacAddress) ? trim($ArrayMacAddress) : "";

            if($TipoIngreso == 1){
                if($MacAddress){
                    $Boolean1 = true;
                }else{
                    $Boolean1 = false;
                    $MacAddress = 0;
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
                $Proveedor = 0;
                $NumeroFactura = 0;
            }

            if($Boolean1 && $Boolean2){
                $Acceso = true;
            }else{
                $Acceso = false;
            }

            if(!$Valor){
                $Valor = 0;
            }

            if(!empty($FechaIngreso) && !empty($Bodega) && !empty($Modelo) && !empty($Cantidad) && !empty($Estado) && !empty($NumeroSerie) && $Acceso){

                

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
                }else{
                    $FechaCompra = '1969-01-31';
                }
               
                $FechaIngreso = DateTime::createFromFormat('d-m-Y', $FechaIngreso)->format('Y-m-d');
                $array = array();

                if($TipoIngreso == 2){

                    if(!$ArrayMacAddress){
            
                        $response_array['status'] = 99; 

                    }else{
                        
                        $ArrayMacAddress = explode(',',$ArrayMacAddress);

                        if($ArrayMacAddress){

                            foreach($ArrayMacAddress as $MacAddress){
                                $run = new Method;
                                $query = "INSERT INTO inventario_ingresos(fecha_compra, fecha_ingreso, numero_factura, modelo_producto_id, proveedor_id, valor, cantidad, bodega_id, usuario_id, numero_serie, mac_address, estado) VALUES ('$FechaCompra','$FechaIngreso','$this->NumeroFactura','$this->Modelo','$this->Proveedor','$this->Valor','1','$this->Bodega','$this->Usuario','$this->NumeroSerie','$MacAddress','$this->Estado')";
                               
                                $id = $run->insert($query);

                                if($id){

                                    $tmp = array('id' => $id, 'fecha_compra' => $this->FechaCompra, 'fecha_ingreso' => $this->FechaIngreso, 'numero_factura' => $this->NumeroFactura,'modelo_producto_id' => $this->Modelo, 'proveedor_id' => $this->Proveedor, 'valor' => $this->Valor,'cantidad' => 1, 'bodega_id' => $this->Bodega, 'usuario_id' => $this->Usuario, 'numero_serie' => $this->NumeroSerie, 'mac_address' => $MacAddress, 'estado' => $this->Estado);

                                    array_push($array,$tmp);

                                }else{
                                    $response_array['status'] = 'Error Registro Array Mac Address'; 
                                }
                            }

                            $response_array['array'] = $array;

                            if($response_array['array']){
                                $response_array['status'] = 1; 
                            }else{
                                $response_array['status'] = 'Error Foreach Mac Address'; 
                            }
                        }else{
                            $response_array['status'] = 'Error Array Mac Address';
                        }
                    }
                }else{
                    $run = new Method;
                    $query = "INSERT INTO inventario_ingresos(fecha_compra, fecha_ingreso, numero_factura, modelo_producto_id, proveedor_id, valor, cantidad, bodega_id, usuario_id, numero_serie, mac_address, estado) VALUES ('$FechaCompra','$FechaIngreso','$this->NumeroFactura','$this->Modelo','$this->Proveedor','$this->Valor','$this->Cantidad','$this->Bodega','$this->Usuario','$this->NumeroSerie','$this->MacAddress','$this->Estado')";
                    
                    $id = $run->insert($query);

                    if($id){

                        $tmp = array('id' => $id, 'fecha_compra' => $this->FechaCompra, 'fecha_ingreso' => $this->FechaIngreso, 'numero_factura' => $this->NumeroFactura,'modelo_producto_id' => $this->Modelo, 'proveedor_id' => $this->Proveedor, 'valor' => $this->Valor,'cantidad' => $this->Cantidad, 'bodega_id' => $this->Bodega, 'usuario_id' => $this->Usuario, 'numero_serie' => $this->NumeroSerie, 'mac_address' => $this->MacAddress, 'estado' => $this->Estado);

                        array_push($array,$tmp);

                        $response_array['array'] = $array;
                        $response_array['status'] = 1; 
                    }else{
                        $response_array['status'] = 'Error Registro Unico'; 
                    }
                }

            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

    	} 

        public function updateIngreso($FechaCompra,$FechaIngreso,$NumeroFactura,$NumeroSerie,$Modelo,$Proveedor,$Valor,$Cantidad,$MacAddress,$Estado,$Id){

            $response_array = array();

            $FechaCompra = isset($FechaCompra) ? trim($FechaCompra) : "";
            $FechaIngreso = isset($FechaIngreso) ? trim($FechaIngreso) : "";
            $NumeroFactura = isset($NumeroFactura) ? trim($NumeroFactura) : "";
            $NumeroSerie = isset($NumeroSerie) ? trim($NumeroSerie) : "";
            $Modelo = isset($Modelo) ? trim($Modelo) : "";
            $Proveedor = isset($Proveedor) ? trim($Proveedor) : "";
            $Valor = isset($Valor) ? trim($Valor) : "";
            $Cantidad = isset($Cantidad) ? trim($Cantidad) : "";
            $MacAddress = isset($MacAddress) ? trim($MacAddress) : "";
            $Estado = isset($Estado) ? trim($Estado) : "";

            if($Estado == 1){
                if($FechaCompra && $NumeroFactura && $Proveedor){
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

            if(!empty($FechaIngreso) && !empty($Modelo) && !empty($Cantidad) && !empty($Estado) && !empty($MacAddress) && !empty($NumeroSerie) && $Acceso){

                $this->Id=$Id;
                $this->FechaCompra=$FechaCompra;
                $this->FechaIngreso=$FechaIngreso;
                $this->NumeroFactura=$NumeroFactura;
                $this->NumeroSerie=$NumeroSerie;
                $this->Modelo=$Modelo;
                $this->Proveedor=$Proveedor;
                $this->Valor=$Valor;
                $this->Cantidad=$Cantidad;
                $this->MacAddress=$MacAddress;
                $this->Estado=$Estado;

                if($FechaCompra){
                    $FechaCompra = DateTime::createFromFormat('d-m-Y', $FechaCompra)->format('Y-m-d');
                }else{
                    $FechaCompra = '1969-01-31';
                }

                $FechaIngreso = DateTime::createFromFormat('d-m-Y', $FechaIngreso)->format('Y-m-d');

                $query = "UPDATE `inventario_ingresos` set `fecha_compra` = '$FechaCompra', `fecha_ingreso` = '$FechaIngreso', `numero_factura` = '$this->NumeroFactura', `modelo_producto_id` = '$this->Modelo', `proveedor_id` = '$this->Proveedor', `valor` = '$this->Valor', `cantidad` = '$this->Cantidad', `numero_serie` = '$this->NumeroSerie' , `mac_address` = '$this->MacAddress', `estado` = '$this->Estado' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->update($query);

                if($data){

                    $array = array('id' => $this->Id, 'fecha_compra' => $this->FechaCompra, 'fecha_ingreso' => $this->FechaIngreso, 'numero_factura' => $this->NumeroFactura,'modelo_producto_id' => $this->Modelo, 'proveedor_id' => $this->Proveedor, 'valor' => $this->Valor,'cantidad' => $this->Cantidad, 'numero_serie' => $this->NumeroSerie, 'mac_address' => $this->MacAddress, 'estado' => $this->Estado);

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

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "DELETE from `inventario_egresos` where `producto_id` = '$this->Id'";
                $run = new Method;
                $data = $run->delete($query);

                $query = "DELETE from `radio_ingresos` where `producto_id` = '$this->Id'";
                $run = new Method;
                $data = $run->delete($query);

                $query = "DELETE from `inventario_ingresos` where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->delete($query);

                $response_array['status'] = 1; 

                
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showIngreso($startDate,$endDate){

        $query = "  SELECT    inventario_ingresos.*, 
                            mantenedor_modelo_producto.nombre as modelo, 
                            mantenedor_marca_producto.nombre as marca, 
                            mantenedor_tipo_producto.nombre as tipo, 
                            mantenedor_proveedores.nombre as proveedor 
                    FROM inventario_ingresos 
                    INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id 
                    INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id 
                    INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id 
                    LEFT JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id ";
            if ($startDate) {
                
                $dt = \DateTime::createFromFormat('d-m-Y', $startDate);
                $startDate = $dt->format('Y-m-d');
                $dt = \DateTime::createFromFormat('d-m-Y', $endDate);
                $endDate = $dt->format('Y-m-d');
                $query .= " WHERE inventario_ingresos.fecha_compra BETWEEN '".$startDate."' AND '".$endDate."' ";
            }
            $run = new Method;
            $data = $run->select($query);
            
            $array = array();

            foreach($data as $row){

                if($row['bodega_tipo']){

                    if($row['bodega_tipo'] == 1){

                        $query = "SELECT * FROM mantenedor_bodegas where id = ".$row['bodega_id']." ORDER BY id DESC LIMIT 1";
                        $run = new Method;
                        $bodega = $run->select($query);

                        if($bodega){
                            $bodega_nombre = $bodega[0]['nombre'];
                        }else{
                            $bodega_nombre = '';
                        }

                    }else if($row['bodega_tipo'] == 2){

                        $query = "SELECT Codigo as nombre FROM servicios where id = ".$row['bodega_id']." ORDER BY id DESC LIMIT 1";
                        $run = new Method;
                        $bodega = $run->select($query);

                        if($bodega){
                            $bodega_nombre = $bodega[0]['nombre'];
                        }else{
                            $bodega_nombre = '';
                        }
                    }else{

                        $query = "SELECT * FROM mantenedor_site where id = ".$row['bodega_id']." ORDER BY id DESC LIMIT 1";
                        $run = new Method;
                        $bodega = $run->select($query);

                        if($bodega){
                            $bodega_nombre = $bodega[0]['nombre'];
                        }else{
                            $bodega_nombre = '';
                        }
                    }
                }else{
                    $bodega_nombre = 'Bodega de Paso';
                }

                $row['bodega'] = $bodega_nombre;

                $array[$row['id']] = array( 'id' => $row['id'], 
                                            'fecha_compra' => $row['fecha_compra'], 
                                            'fecha_ingreso' => $row['fecha_ingreso'], 
                                            'proveedor' => $row['proveedor'], 
                                            'numero_factura' => $row['numero_factura'], 
                                            'tipo' => $row['tipo'], 
                                            'marca' => $row['marca'], 
                                            'modelo' => $row['modelo'], 
                                            'cantidad' => $row['cantidad'], 
                                            'numero_serie' => $row['numero_serie'], 
                                            'mac_address' => $row['mac_address'], 
                                            'estado' => $row['estado'], 
                                            'valor' => $row['valor'], 
                                            'bodega' => $row['bodega'],
                                            'modelo_producto_id' => $row['modelo_producto_id'],
                                            'bodega_id' => $row['bodega_id'],
                                            'proveedor_id' => $row['proveedor_id'],
                                            );
            }

            $response_array['array'] = $array;

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

                $query = 'SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo, mantenedor_proveedores.nombre as proveedor FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id LEFT JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id';

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

                $query = 'SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo, mantenedor_proveedores.nombre as proveedor FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id LEFT JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id';

                if($TipoBusquedaRegistro == 1){
                    $query = $query . " WHERE mantenedor_modelo_producto.nombre = '$InputRegistro'";
                }else if($TipoBusquedaRegistro == 2){
                    $query = $query . " WHERE mantenedor_marca_producto.nombre = '$InputRegistro'";
                }else if($TipoBusquedaRegistro == 3){
                    $query = $query . " WHERE mantenedor_tipo_producto.nombre = '$InputRegistro'";
                }else{
                    $query = $query . " WHERE inventario_ingresos.mac_address = '$InputRegistro'";
                }

                $run = new Method;
                $data = $run->select($query);

                if($data){

                    $array = array();

                    foreach($data as $row){

                        if($row['bodega_tipo']){

                            if($row['bodega_tipo'] == 1){

                                $query = "SELECT * FROM mantenedor_bodegas where id = ".$row['bodega_id']." ORDER BY id DESC LIMIT 1";
                                $run = new Method;
                                $bodega = $run->select($query);

                                if($bodega){
                                    $bodega_nombre = $bodega[0]['nombre'];
                                }else{
                                    $bodega_nombre = '';
                                }

                            }else if($row['bodega_tipo'] == 2){

                                $query = "SELECT Codigo as nombre, id from servicios where id = ".$row['bodega_id']." ORDER BY id DESC LIMIT 1";
                                $run = new Method;
                                $bodega = $run->select($query);

                                if($bodega){
                                    $bodega_nombre = $bodega[0]['nombre'];
                                }else{
                                    $bodega_nombre = '';
                                }
                            }else{

                                $query = "SELECT * FROM mantenedor_site where id = ".$row['bodega_id']." ORDER BY id DESC LIMIT 1";
                                $run = new Method;
                                $bodega = $run->select($query);

                                if($bodega){
                                    $bodega_nombre = $bodega[0]['nombre'];
                                }else{
                                    $bodega_nombre = '';
                                }
                            }
                        }else{
                            $bodega_nombre = 'Bodega de Paso';
                        }

                        $row['bodega'] = $bodega_nombre;

                        $array[$row['id']] = array( 'id' => $row['id'], 
                                                    'fecha_compra' => $row['fecha_compra'], 
                                                    'fecha_ingreso' => $row['fecha_ingreso'], 
                                                    'proveedor' => $row['proveedor'], 
                                                    'numero_factura' => $row['numero_factura'], 
                                                    'tipo' => $row['tipo'], 
                                                    'marca' => $row['marca'], 
                                                    'modelo' => $row['modelo'], 
                                                    'cantidad' => $row['cantidad'], 
                                                    'numero_serie' => $row['numero_serie'], 
                                                    'mac_address' => $row['mac_address'], 
                                                    'estado' => $row['estado'], 
                                                    'valor' => $row['valor'], 
                                                    'bodega' => $row['bodega'],
                                                    'modelo_producto_id' => $row['modelo_producto_id'],
                                                    'bodega_id' => $row['bodega_id'],
                                                    'proveedor_id' => $row['proveedor_id'],
                                                    );
                    }

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
    }

?>
