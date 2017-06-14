<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Ingreso{

        public function storeIngreso($NumeroFactura,$FechaEmisionFactura,$Proveedor,$Estado,$CentroCosto){

            $response_array = array();

            $NumeroFactura = isset($NumeroFactura) ? trim($NumeroFactura) : "";
            $FechaEmisionFactura = isset($FechaEmisionFactura) ? trim($FechaEmisionFactura) : "";
            $Proveedor = isset($Proveedor) ? trim($Proveedor) : "";
            $Estado = isset($Estado) ? trim($Estado) : "";
            $CentroCosto = isset($CentroCosto) ? trim($CentroCosto) : "";

            if(!empty($NumeroFactura) && !empty($FechaEmisionFactura) && !empty($Proveedor) && !empty($Estado) && !empty($CentroCosto)){

                $this->NumeroFactura=$NumeroFactura;
                $this->FechaEmisionFactura=$FechaEmisionFactura;
                $this->Proveedor=$Proveedor;
                $this->Estado=$Estado;
                $this->CentroCosto=$CentroCosto;

                $FechaEmisionFactura = DateTime::createFromFormat('d-m-Y', $FechaEmisionFactura)->format('Y-m-d');
                $array = array();

                $query = "INSERT INTO compras_ingresos(numero_factura, fecha_emision_factura, proveedor_id, estado_id, centro_costo_id) VALUES ('$this->NumeroFactura','$FechaEmisionFactura','$this->Proveedor','$this->Estado','$this->CentroCosto')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id' => $id, 'numero_factura' => $this->NumeroFactura,'fecha_emision_factura' => $this->FechaEmisionFactura, 'proveedor_id' => $this->Proveedor, 'estado_id' => $this->Estado, 'centro_costo_id' => $this->CentroCosto);

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

        public function updateIngreso($NumeroFactura,$FechaEmisionFactura,$Proveedor,$Estado,$CentroCosto,$Id){

            $response_array = array();

            $NumeroFactura = isset($NumeroFactura) ? trim($NumeroFactura) : "";
            $FechaEmisionFactura = isset($FechaEmisionFactura) ? trim($FechaEmisionFactura) : "";
            $Proveedor = isset($Proveedor) ? trim($Proveedor) : "";
            $Estado = isset($Estado) ? trim($Estado) : "";
            $CentroCosto = isset($CentroCosto) ? trim($CentroCosto) : "";

            if(!empty($NumeroFactura) && !empty($FechaEmisionFactura) && !empty($Proveedor) && !empty($Estado) && !empty($CentroCosto)){
                
                $this->Id=$Id;
                $this->NumeroFactura=$NumeroFactura;
                $this->FechaEmisionFactura=$FechaEmisionFactura;
                $this->Proveedor=$Proveedor;
                $this->Estado=$Estado;
                $this->CentroCosto=$CentroCosto;

                $FechaEmisionFactura = DateTime::createFromFormat('d-m-Y', $FechaEmisionFactura)->format('Y-m-d');
                $array = array();

                $query = "UPDATE `compras_ingresos` set  `numero_factura` = '$this->NumeroFactura', `fecha_emision_factura` = '$FechaEmisionFactura', `proveedor_id` = '$this->Proveedor', `estado_id` = '$this->Estado', `centro_costo_id` = '$this->CentroCosto' where `id` = '$this->Id'";
                $run = new Method;
                $id = $run->insert($query);

                // if($id){

                    $array = array('id' => $Id, 'numero_factura' => $this->NumeroFactura,'fecha_emision_factura' => $this->FechaEmisionFactura, 'proveedor_id' => $this->Proveedor, 'estado_id' => $this->Estado, 'centro_costo_id' => $this->CentroCosto);

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

                $query = "DELETE from `compras_ingresos` where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->insert($query);
                $response_array['status'] = 1; 

                
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showIngreso(){

            $query = 'SELECT compras_ingresos.*, mantenedor_estado_pago.nombre as estado, mantenedor_proveedores.nombre as proveedor, mantenedor_costos.nombre as centro_costo FROM compras_ingresos INNER JOIN mantenedor_estado_pago ON compras_ingresos.estado_id = mantenedor_estado_pago.id INNER JOIN mantenedor_costos ON compras_ingresos.centro_costo_id = mantenedor_costos.id INNER JOIN mantenedor_proveedores ON compras_ingresos.proveedor_id = mantenedor_proveedores.id';

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

        function showEstado(){

            $query = 'SELECT * FROM mantenedor_estado_pago';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

        function showCentroCosto(){

            $query = 'SELECT * FROM mantenedor_costos';
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }

    }

?>