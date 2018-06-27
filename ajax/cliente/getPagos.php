<?php
    require_once('../../class/methods_global/methods.php');
    $id = $_POST['id'];

    $run = new Method;
    $ToReturn = array();

    $query = "  SELECT   facturas_pagos.*, mantenedor_estado_pago.nombre as TipoPago
                FROM facturas_pagos 
                INNER JOIN mantenedor_estado_pago ON facturas_pagos.TipoPago = mantenedor_estado_pago.id 
                WHERE facturas_pagos.FacturaId = '".$id."'";

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

?>