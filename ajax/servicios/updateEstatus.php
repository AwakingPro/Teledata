<?php
    require("../../plugins/PHPMailer-master/class.phpmailer.php");
    require("../../plugins/PHPMailer-master/class.smtp.php");
    include('../../class/email/EmailClass.php');
	require_once('../../class/methods_global/methods.php');
    $run = new Method;

    $servicio_rut_dv = isset($_POST['servicio_rut_dv']) ? trim($_POST['servicio_rut_dv']) : "";
    $servicio_nombre_cliente = isset($_POST['servicio_nombre_cliente']) ? trim($_POST['servicio_nombre_cliente']) : "";
    $servicio_codigo_cliente = isset($_POST['servicio_codigo_cliente']) ? trim($_POST['servicio_codigo_cliente']) : "";
    // echo $servicio_rut_dv .' - ' . $servicio_nombre_cliente . ' code '.$servicio_codigo_cliente; exit; 
    $Id = isset($_POST['Id']) ? trim($_POST['Id']) : "";
    $Activo = isset($_POST['Activo']) ? trim($_POST['Activo']) : "";
    $selectEnviaCorreo = isset($_POST['selectEnviaCorreo']) ? trim($_POST['selectEnviaCorreo']) : "";
    $FechaInicioDesactivacion = isset($_POST['FechaInicioDesactivacion']) ? trim($_POST['FechaInicioDesactivacion']) : "";
    $FechaFinalDesactivacion = isset($_POST['FechaFinalDesactivacion']) ? trim($_POST['FechaFinalDesactivacion']) : "";

    $FechaInicioDesactivacionES = date("d-m-Y",  strtotime($FechaInicioDesactivacion));
    $FechaFinalDesactivacionES = date("d-m-Y",  strtotime($FechaFinalDesactivacion));

    $dataClient = array();
    // $dataClient['RUT'] = $servicio_rut_dv;
    $dataClient['ClienteNombre'] = $servicio_nombre_cliente;
    $dataClient['ServicioCodigo'] = $servicio_codigo_cliente;
    $dataClient['correos'] = 'jcarrillo@teledata.cl, atrismartelo@teledata.cl, rmontoya@teledata.cl, fpezzuto@teledata.cl, pagos@teledata.cl, kcardenas@teledata.cl,  esalas@teledata.cl, jpinto@teledata.cl';
    // $dataClient['correos'] = 'daniel30081990@gmail.com, dangel@teledata.cl';
    $dataClient['asunto'] = 'Actualizar Servicio '.$servicio_codigo_cliente;
    
    
    $Mensaje = 'Estimados por favor ';
    //0-termino contrato, 1-activo, 2-suspendido, 3-Corte comercial
    if($Activo == 0 || $Activo == 2){
        
        if($Activo == 0){
            $Mensaje .= '<b>Términar contrato</b> Servicio del Cliente: <b>'.$servicio_nombre_cliente.'</b> código <b>'. $servicio_codigo_cliente.'</b>';
        }else{
            $FechaInicioDesactivacionES = date("d-m-Y",  strtotime($FechaInicioDesactivacion));
            $FechaFinalDesactivacionES = date("d-m-Y",  strtotime($FechaFinalDesactivacion));
            $Mensaje .= '<b>Suspender</b> Servicio del Cliente: <b>'.$servicio_nombre_cliente.'</b> código <b>'. 
            $servicio_codigo_cliente.'</b> Desde <b>'.$FechaInicioDesactivacionES .'</b> Hasta <b>'. $FechaFinalDesactivacionES.'</b>';
        }
        if($FechaInicioDesactivacion && $FechaFinalDesactivacion){
            $FechaInicioDesactivacion = DateTime::createFromFormat('Y/m/d', $FechaInicioDesactivacion);
            $FechaFinalDesactivacion = DateTime::createFromFormat('Y/m/d', $FechaFinalDesactivacion);
            $Hoy = new DateTime();
            if($FechaFinalDesactivacion < $Hoy){
                echo 2;
                return;
            }else{
                $FechaInicioDesactivacion = "'".$FechaInicioDesactivacion->format('Y-m-d')."'";
                $FechaFinalDesactivacion = "'".$FechaFinalDesactivacion->format('Y-m-d')."'";
            }
        }else{
            echo 3;
            return;
        }
    }else{
        if($Activo == 3){
            $Mensaje .= '<b>Cortar</b> Servicio del Cliente: <b>'.$servicio_nombre_cliente.'</b> código <b>'.
            $servicio_codigo_cliente.'</b>';
        }
        if($Activo == 4){
            $Mensaje .= '<b>Cambio razón social</b> Servicio del Cliente: <b>'.$servicio_nombre_cliente.'</b> código <b>'.
            $servicio_codigo_cliente.'</b>';
        }
        $FechaInicioDesactivacion = 'NULL';
        $FechaFinalDesactivacion = 'NULL';
    }
    if($Activo == 1){
        $Mensaje .= '<b>Activar</b> Servicio del Cliente: <b>'.$servicio_nombre_cliente.'</b> código <b>'. $servicio_codigo_cliente.'</b>';
    }

    $dataClient['MensajeCorreo'] = $Mensaje;
    $FechaUltimoCobro = date('Y-m-01');
	$query = "UPDATE servicios SET FechaInicioDesactivacion = $FechaInicioDesactivacion, 
              FechaFinalDesactivacion = $FechaFinalDesactivacion, EstatusServicio = $Activo, FechaUltimoCobro = '".$FechaUltimoCobro."'
              WHERE Id = '".$Id."' ";
    $update = $run->update($query);
    
    if($update > 0){
        if($selectEnviaCorreo == 1){
            $respCorreo = $run->enviarCorreos(2, $dataClient);
            if($respCorreo != 1){
                echo 4;
                return;
            }
        }
        
    }
	echo 1;


 ?>



