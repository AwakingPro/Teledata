<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Ingreso{

    	public function storeIngreso($FechaCompra,$FechaIngreso,$NumeroFactura,$NumeroSerie,$Modelo,$Proveedor,$Valor,$Cantidad,$Bodega,$MacAddress){

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

            if(!empty($FechaCompra) && !empty($FechaIngreso) && !empty($NumeroFactura) && !empty($NumeroSerie) && !empty($Modelo) && !empty($Proveedor) && !empty($Valor) && !empty($Cantidad) && !empty($Bodega) && !empty($MacAddress)){

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
                $this->Usuario=$_SESSION['idUsuario'];

                $FechaCompra = DateTime::createFromFormat('d-m-Y', $FechaCompra)->format('Y-m-d');
                $FechaIngreso = DateTime::createFromFormat('d-m-Y', $FechaIngreso)->format('Y-m-d');

                $query = "INSERT INTO inventario_ingresos(fecha_compra, fecha_ingreso, numero_factura, modelo_producto_id, proveedor_id, valor, cantidad, bodega_id, usuario_id, numero_serie, mac_address) VALUES ('$FechaCompra','$FechaIngreso','$this->NumeroFactura','$this->Modelo','$this->Proveedor','$this->Valor','$this->Cantidad','$this->Bodega','$this->Usuario','$this->NumeroSerie','$this->MacAddress')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id' => $id, 'fecha_compra' => $this->FechaCompra, 'fecha_ingreso' => $this->FechaIngreso, 'numero_factura' => $this->NumeroFactura,'modelo_producto_id' => $this->Modelo, 'proveedor_id' => $this->Proveedor, 'valor' => $this->Valor,'cantidad' => $this->Cantidad, 'bodega_id' => $this->Bodega, 'usuario_id' => $this->Usuario, 'numero_serie' => $this->NumeroSerie, 'mac_address' => $this->MacAddress);

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

        public function updateIngreso($FechaCompra,$FechaIngreso,$NumeroFactura,$NumeroSerie,$Modelo,$Proveedor,$Valor,$Cantidad,$Bodega,$MacAddress, $Id){

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

            if(!empty($FechaCompra) && !empty($FechaIngreso) && !empty($NumeroFactura) && !empty($NumeroSerie) && !empty($Modelo) && !empty($Proveedor) && !empty($Valor) && !empty($Cantidad) && !empty($Bodega) && !empty($MacAddress)){

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

                $FechaCompra = DateTime::createFromFormat('d-m-Y', $FechaCompra)->format('Y-m-d');
                $FechaIngreso = DateTime::createFromFormat('d-m-Y', $FechaIngreso)->format('Y-m-d');

                $query = "UPDATE `inventario_ingresos` set `fecha_compra` = '$FechaCompra', `fecha_ingreso` = '$FechaIngreso', `numero_factura` = '$this->NumeroFactura', `modelo_producto_id` = '$this->Modelo', `proveedor_id` = '$this->Proveedor', `valor` = '$this->Valor', `cantidad` = '$this->Cantidad', `bodega_id` = '$this->Bodega', `numero_serie` = '$this->NumeroSerie' , `mac_address` = '$this->MacAddress' where `id` = '$this->Id'";
                $run = new Method;
                $id = $run->insert($query);

                // if($id){

                    $array = array('id' => $this->Id, 'fecha_compra' => $this->FechaCompra, 'fecha_ingreso' => $this->FechaIngreso, 'numero_factura' => $this->NumeroFactura,'modelo_producto_id' => $this->Modelo, 'proveedor_id' => $this->Proveedor, 'valor' => $this->Valor,'cantidad' => $this->Cantidad, 'bodega_id' => $this->Bodega, 'numero_serie' => $this->NumeroSerie, 'mac_address' => $this->MacAddress);

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

        function showIngreso(){

            $query = 'SELECT inventario_ingresos.*, mantenedor_modelo_producto.nombre as modelo, mantenedor_marca_producto.nombre as marca, mantenedor_tipo_producto.nombre as tipo, mantenedor_proveedores.nombre as proveedor, mantenedor_bodegas.nombre as bodega FROM inventario_ingresos INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id INNER JOIN mantenedor_bodegas ON inventario_ingresos.bodega_id = mantenedor_bodegas.id INNER JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id';

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

            $query = 'SELECT * FROM mantenedor_bodegas';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

    }

?>