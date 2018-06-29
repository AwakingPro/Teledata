<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Ingreso{

        public function storeIngreso($TipoDocumento,$NumeroDocumento,$FechaEmision,$FechaVencimiento,$Proveedor,$CentroCosto,$Detalle,$TotalDocumento){

            $response_array = array();

            $TipoDocumento = isset($TipoDocumento) ? trim($TipoDocumento) : "";
            $NumeroDocumento = isset($NumeroDocumento) ? trim($NumeroDocumento) : "";
            $FechaEmision = isset($FechaEmision) ? trim($FechaEmision) : "";
            $FechaVencimiento = isset($FechaVencimiento) ? trim($FechaVencimiento) : "";
            $Proveedor = isset($Proveedor) ? trim($Proveedor) : "";
            $CentroCosto = isset($CentroCosto) ? trim($CentroCosto) : "";
            $Detalle = isset($Detalle) ? trim($Detalle) : "";
            $TotalDocumento = isset($TotalDocumento) ? trim($TotalDocumento) : "";

            if(!empty($TipoDocumento) && !empty($NumeroDocumento) && !empty($FechaEmision) && !empty($FechaVencimiento) && !empty($Proveedor) && !empty($CentroCosto) && !empty($Detalle) && !empty($TotalDocumento)){

                $FechaEmision = DateTime::createFromFormat('d-m-Y', $FechaEmision)->format('Y-m-d');
                $FechaVencimiento = DateTime::createFromFormat('d-m-Y', $FechaVencimiento)->format('Y-m-d');
                if($FechaEmision > $FechaVencimiento){
                    $response_array['status'] = 3;
                    echo json_encode($response_array);
                    return;
                }

                $query = "INSERT INTO compras_ingresos(tipo_documento_id, numero_documento, fecha_emision, fecha_vencimiento, proveedor_id, centro_costo_id, detalle, total_documento) VALUES ('".$TipoDocumento."','".$NumeroDocumento."','".$FechaEmision."','".$FechaVencimiento."','".$Proveedor."','".$CentroCosto."','".$Detalle."','".$TotalDocumento."')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0; 
                }
       
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

        } 

        public function updateIngreso($TipoDocumento,$NumeroDocumento,$FechaEmision,$FechaVencimiento,$Proveedor,$CentroCosto,$Detalle,$TotalDocumento,$Id){

            $response_array = array();

            $TipoDocumento = isset($TipoDocumento) ? trim($TipoDocumento) : "";
            $NumeroDocumento = isset($NumeroDocumento) ? trim($NumeroDocumento) : "";
            $FechaEmision = isset($FechaEmision) ? trim($FechaEmision) : "";
            $FechaVencimiento = isset($FechaVencimiento) ? trim($FechaVencimiento) : "";
            $Proveedor = isset($Proveedor) ? trim($Proveedor) : "";
            $CentroCosto = isset($CentroCosto) ? trim($CentroCosto) : "";
            $Detalle = isset($Detalle) ? trim($Detalle) : "";
            $TotalDocumento = isset($TotalDocumento) ? trim($TotalDocumento) : "";

            if(!empty($TipoDocumento) && !empty($NumeroDocumento) && !empty($FechaEmision) && !empty($FechaVencimiento) && !empty($Proveedor) && !empty($CentroCosto) && !empty($Detalle) && !empty($TotalDocumento)){
                
                $FechaEmision = DateTime::createFromFormat('d-m-Y', $FechaEmision)->format('Y-m-d');
                $FechaVencimiento = DateTime::createFromFormat('d-m-Y', $FechaVencimiento)->format('Y-m-d');
                if($FechaEmision > $FechaVencimiento){
                    $response_array['status'] = 3;
                    echo json_encode($response_array);
                    return;
                }
                $query = "UPDATE compras_ingresos SET tipo_documento_id = '".$TipoDocumento."', numero_documento = '".$NumeroDocumento."', fecha_emision = '".$FechaEmision."', fecha_vencimiento = '".$FechaVencimiento."', proveedor_id = '".$Proveedor."', centro_costo_id = '".$CentroCosto."', detalle = '".$Detalle."', total_documento = '".$TotalDocumento."' WHERE id = '".$Id."'";
                $run = new Method;
                $data = $run->update($query);
                if($data){
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

                $Id=$Id;

                $query = "DELETE from compras_ingresos where id = '$Id'";
                $run = new Method;
                $data = $run->delete($query);
                $response_array['status'] = 1; 

                
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showIngreso(){

            $query = "  SELECT
                            compras_ingresos.*,
                            mantenedor_tipo_cliente.nombre AS tipo_documento,
                            IFNULL( ( SELECT SUM( Monto ) FROM compras_pagos WHERE CompraId = compras_ingresos.id ), 0 ) AS total_abono 
                        FROM
                            compras_ingresos
                            LEFT JOIN mantenedor_tipo_cliente ON compras_ingresos.tipo_documento_id = mantenedor_tipo_cliente.Id";

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

            $query = 'SELECT * FROM mantenedor_tipo_pago';
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
