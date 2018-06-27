<?php
    require_once('../../class/methods_global/methods.php');
    $response_array = array();

    $FacturaId = $_POST['FacturaId'];
    $FechaPago = $_POST['FechaPago'];
    $TipoPago = $_POST['TipoPago'];
    $Detalle = $_POST['Detalle'];
    $Monto = $_POST['Monto'];
    $FechaEmisionCheque = $_POST['FechaEmisionCheque'];
    $FechaVencimientoCheque = $_POST['FechaVencimientoCheque'];
    
    $FacturaId = isset($FacturaId) ? trim($FacturaId) : "";
    $FechaPago = isset($FechaPago) ? trim($FechaPago) : "";
    $TipoPago = isset($TipoPago) ? trim($TipoPago) : "";
    $Detalle = isset($Detalle) ? trim($Detalle) : "";
    $Monto = isset($Monto) ? trim($Monto) : "";
    $FechaEmisionCheque = isset($FechaEmisionCheque) ? trim($FechaEmisionCheque) : "";
    $FechaVencimientoCheque = isset($FechaVencimientoCheque) ? trim($FechaVencimientoCheque) : "";

    if(!empty($FacturaId) && !empty($FechaPago) && !empty($TipoPago) && !empty($Monto)){

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

        $query = "INSERT INTO facturas_pagos(FacturaId, FechaPago, TipoPago, Detalle, Monto, FechaEmisionCheque, FechaVencimientoCheque) VALUES ('$FacturaId','$FechaPago','$TipoPago','$Detalle','$Monto','$FechaEmisionCheque','$FechaVencimientoCheque')";
        $run = new Method;
        $id = $run->insert($query);

        if($id){
            $status = 1; 
        }else{
            $status = 0; 
        }

    }else{
        $status = 2; 
    }

    echo $status;

?>