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

        public function updateIngreso($NumeroDocumento,$FechaEmision,$FechaVencimiento,$Proveedor,$CentroCosto,$Detalle,$TotalDocumento,$Id){

            $response_array = array();

            $NumeroDocumento = isset($NumeroDocumento) ? trim($NumeroDocumento) : "";
            $FechaEmision = isset($FechaEmision) ? trim($FechaEmision) : "";
            $FechaVencimiento = isset($FechaVencimiento) ? trim($FechaVencimiento) : "";
            $Proveedor = isset($Proveedor) ? trim($Proveedor) : "";
            $CentroCosto = isset($CentroCosto) ? trim($CentroCosto) : "";
            $Detalle = isset($Detalle) ? trim($Detalle) : "";
            $TotalDocumento = isset($TotalDocumento) ? trim($TotalDocumento) : "";

            if(!empty($NumeroDocumento) && !empty($FechaEmision) && !empty($FechaVencimiento) && !empty($Proveedor) && !empty($CentroCosto) && !empty($Detalle) && !empty($TotalDocumento)){
                
                $FechaEmision = DateTime::createFromFormat('d-m-Y', $FechaEmision)->format('Y-m-d');
                $FechaVencimiento = DateTime::createFromFormat('d-m-Y', $FechaVencimiento)->format('Y-m-d');
                if($FechaEmision > $FechaVencimiento){
                    $response_array['status'] = 3;
                    echo json_encode($response_array);
                    return;
                }
                $query = "UPDATE compras_ingresos SET numero_documento = '".$NumeroDocumento."', fecha_emision = '".$FechaEmision."', fecha_vencimiento = '".$FechaVencimiento."', proveedor_id = '".$Proveedor."', centro_costo_id = '".$CentroCosto."', detalle = '".$Detalle."', total_documento = '".$TotalDocumento."' WHERE id = '".$Id."'";
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

        function showIngreso($startDate,$endDate){

            $query = "  SELECT
                            compras_ingresos.*,
                            mantenedor_tipo_cliente.nombre AS tipo_documento,
                            (compras_ingresos.total_documento - IFNULL( ( SELECT SUM( Monto ) FROM compras_pagos WHERE CompraId = compras_ingresos.id ), 0 )) AS total_abono 
                        FROM
                            compras_ingresos
                            LEFT JOIN mantenedor_tipo_cliente ON compras_ingresos.tipo_documento_id = mantenedor_tipo_cliente.Id";
            if($startDate && $endDate){
                $startDate = $startDate;
                $dt = \DateTime::createFromFormat('d-m-Y',$startDate);
                $startDate = $dt->format('Y-m-d');
                $endDate = $endDate;
                $dt = \DateTime::createFromFormat('d-m-Y',$endDate);
                $endDate = $dt->format('Y-m-d');
                $query .= " WHERE fecha_emision BETWEEN '".$startDate."' AND '".$endDate."'";
            }
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
        function showPagos($id){

            $run = new Method;
            $ToReturn = array();

            $query = "  SELECT   compras_pagos.*, mantenedor_tipo_pago.nombre as TipoPago
                        FROM compras_pagos 
                        INNER JOIN mantenedor_tipo_pago ON compras_pagos.TipoPago = mantenedor_tipo_pago.id 
                        WHERE compras_pagos.CompraId = '".$id."'";

            $pagos = $run->select($query);

            if($pagos){

                foreach($pagos as $pago){

                    $data = array();
                    $data['Id'] = $pago['Id'];
                    $data['FechaPago'] = \DateTime::createFromFormat('Y-m-d',$pago['FechaPago'])->format('d-m-Y');    
                    $data['Monto'] = number_format($pago['Monto'], 2);    
                    $data['TipoPago'] = $pago['TipoPago'];
                    $data['Detalle'] = $pago['Detalle'];
                    if($pago['TipoPago'] != 'Cheque al dia'){
                        $data['FechaEmisionCheque'] = 'N/A';        
                        $data['FechaVencimientoCheque'] = 'N/A';
                    }else{
                        $data['FechaEmisionCheque'] = \DateTime::createFromFormat('Y-m-d',$pago['FechaEmisionCheque'])->format('d-m-Y');        
                        $data['FechaVencimientoCheque'] = \DateTime::createFromFormat('Y-m-d',$pago['FechaVencimientoCheque'])->format('d-m-Y');
                    }
                    
                    array_push($ToReturn,$data);
                }
            }
            echo json_encode($ToReturn);
        }
        function storePago($CompraId,$FechaPago,$TipoPago,$Detalle,$Monto,$FechaEmisionCheque,$FechaVencimientoCheque){

            $response_array = array();
            
            $CompraId = isset($CompraId) ? trim($CompraId) : "";
            $FechaPago = isset($FechaPago) ? trim($FechaPago) : "";
            $TipoPago = isset($TipoPago) ? trim($TipoPago) : "";
            $Detalle = isset($Detalle) ? trim($Detalle) : "";
            $Monto = isset($Monto) ? trim($Monto) : "";
            $FechaEmisionCheque = isset($FechaEmisionCheque) ? trim($FechaEmisionCheque) : "";
            $FechaVencimientoCheque = isset($FechaVencimientoCheque) ? trim($FechaVencimientoCheque) : "";

            if(!empty($CompraId) && !empty($FechaPago) && !empty($TipoPago) && !empty($Monto)){

                $FechaPago = DateTime::createFromFormat('d-m-Y', $FechaPago)->format('Y-m-d');
                if($FechaEmisionCheque){
                    $FechaEmisionCheque = DateTime::createFromFormat('d-m-Y', $FechaEmisionCheque)->format('Y-m-d');
                }else{
                    $FechaEmisionCheque = '1969-01-31';
                }
                if($FechaVencimientoCheque){
                    $FechaVencimientoCheque = DateTime::createFromFormat('d-m-Y', $FechaVencimientoCheque)->format('Y-m-d');
                }else{
                    $FechaVencimientoCheque = '1969-01-31';
                }
                $array = array();

                $query = "INSERT INTO compras_pagos(CompraId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque) VALUES ('$CompraId','$FechaPago','$TipoPago','$Detalle','$Monto','$FechaEmisionCheque','$FechaVencimientoCheque')";
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

        function deletePago($id){
            $query = "DELETE FROM compras_pagos WHERE Id = ".$id;
            $run = new Method;
            $data = $run->delete($query);
            echo $data;
        }

        function getTotales($startDate,$endDate){

            $query = "  SELECT
                            SUM(total_documento) as total_documento,
                            IFNULL( ( SELECT SUM( Monto ) FROM compras_pagos ), 0 ) AS total_abono 
                        FROM
                            compras_ingresos";
            if($startDate && $endDate){
                $startDate = $startDate;
                $dt = \DateTime::createFromFormat('d-m-Y',$startDate);
                $startDate = $dt->format('Y-m-d');
                $endDate = $endDate;
                $dt = \DateTime::createFromFormat('d-m-Y',$endDate);
                $endDate = $dt->format('Y-m-d');
                $query .= " WHERE fecha_emision BETWEEN '".$startDate."' AND '".$endDate."'";
            }
            $run = new Method;
            $data = $run->select($query);
            if($data){
                $pagado = $data[0]['total_abono'];
                $por_pagar = $data[0]['total_documento'] - $pagado;
                if($por_pagar < 0){
                    $por_pagar = 0;
                }
            }else{
                $pagado = 0;
                $por_pagar = 0;
            }

            $response_array = array('pagado' => number_format($pagado, 2), 'por_pagar' => number_format($por_pagar, 2) );

            echo json_encode($response_array);

        }
    }

?>
