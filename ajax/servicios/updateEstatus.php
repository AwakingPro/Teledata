<?php
    require("../../plugins/PHPMailer-master/class.phpmailer.php");
    require("../../plugins/PHPMailer-master/class.smtp.php");
    include('../../class/email/EmailClass.php');
    require_once('../../class/methods_global/methods.php');
    include("../../class/facturacion/uf/UfClass.php");

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
    $FechaInicioSuspension = isset($_POST['FechaInicioSuspension']) ? trim($_POST['FechaInicioSuspension']) : "";
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
    if($FechaInicioDesactivacion == ''){
        $FechaInicioDesactivacion = 'NULL';
        $FechaFinalDesactivacion = 'NULL';
    }
    
    //0-termino contrato, 1-activo, 2-suspendido, 3-Corte comercial
    if($Activo == 0){
        $FechaInicioDesactivacion = "'".$FechaInicioSuspension."'";
        $FechaFinalDesactivacion = "'".date("2999-01-31")."'";
        $respCobro = cobroFinContrato($Id, $FechaInicioSuspension);
        if($respCobro != 1){
            echo $respCobro;
            return;
        }
        $Mensaje .= '<b>Términar contrato</b> Servicio del Cliente: <b>'.$servicio_nombre_cliente.'</b> código <b>'. $servicio_codigo_cliente.'</b>';
    }
    if($Activo == 1){
        $Mensaje .= '<b>Activar</b> Servicio del Cliente: <b>'.$servicio_nombre_cliente.'</b> código <b>'. $servicio_codigo_cliente.'</b>';
    }
    
    if($Activo == 2){

        $FechaInicioDesactivacionES = date("d-m-Y",  strtotime($FechaInicioDesactivacion));
        $FechaFinalDesactivacionES = date("d-m-Y",  strtotime($FechaFinalDesactivacion));
        $Mensaje .= '<b>Suspender</b> Servicio del Cliente: <b>'.$servicio_nombre_cliente.'</b> código <b>'. 
        $servicio_codigo_cliente.'</b> Desde <b>'.$FechaInicioDesactivacionES .'</b> Hasta <b>'. $FechaFinalDesactivacionES.'</b>';
    
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
    }
    

    $dataClient['MensajeCorreo'] = $Mensaje;
    $FechaUltimoCobro = date('Y-m-01');
	$query = "UPDATE servicios SET FechaInicioDesactivacion = $FechaInicioDesactivacion, 
              FechaFinalDesactivacion = $FechaFinalDesactivacion, EstatusServicio = $Activo, FechaUltimoCobro = '".$FechaUltimoCobro."'
              WHERE Id = '".$Id."' ";
    // echo $query; exit;
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
    exit;

    //metodo para hacer cobro de los dias activos del servicio al termino de contrato
    function cobroFinContrato($Id, $FechaSuspension){

        $response_array = array();
        $run = new Method;

        if(!empty($Id)){

            $Hoy = new DateTime();
            $Hoy = $Hoy->format('Y-m-d H:i:s'); 

            $query = "	SELECT
                            servicios.*, 
                            ( CASE servicios.IdServicio WHEN 7 THEN servicios.NombreServicioExtra ELSE mantenedor_servicios.servicio END ) AS Servicio,
                            personaempresa.tipo_cliente
                        FROM
                            servicios
                        INNER JOIN personaempresa ON servicios.Rut = personaempresa.rut
                        LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio
                        WHERE
                            servicios.Id = '".$Id."'";
            $Servicio = $run->select($query);
            if($Servicio){
                $Servicio = $Servicio[0];
                $EstatusInstalacion = $Servicio['EstatusInstalacion'];
                
                if($EstatusInstalacion == 1){
                    $Rut = $Servicio['Rut'];
                    $Grupo = $Servicio['Grupo'];
                    $TipoDocumento = $Servicio['tipo_cliente'];
                    
                    $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA) VALUES ('".$Rut."', '".$Grupo."', '2', '0', '0', '', '0', '', NOW(), NOW(),'".$TipoDocumento."', NOW(), 0.19)";
                    
                    $FacturaId = $run->insert($query);

                    if($FacturaId){

                        $UfClass = new Uf(); 
                        $UF = $UfClass->getValue();
                        
                        $Codigo = $Servicio['Codigo'];
                        $Concepto = $Servicio['Servicio'];
                        $Valor = $Servicio['Valor'];
                        $Descuento = $Servicio['Descuento'];
                        $Conexion = $Servicio['Conexion'];

                        if($FechaSuspension){
                            $dt = new DateTime($FechaSuspension);
                        }else{
                            $dt = new DateTime();
                        }
                        
                        $Mes =  $dt->format('m');
                        $Dia =  $dt->format('d');
                        
                        switch ($Mes) {
                            case 1:
                                $MesFacturacion = "Enero";
                                break;
                            case 2:
                                $MesFacturacion = "Febrero";
                                break;
                            case 3:
                                $MesFacturacion = "Marzo";
                                break;
                            case 4:
                                $MesFacturacion = "Abril";
                                break;
                            case 5:
                                $MesFacturacion = "Mayo";
                                break;
                            case 6:
                                $MesFacturacion = "Junio";
                                break;
                            case 7:
                                $MesFacturacion = "Julio";
                                break;
                            case 8:
                                $MesFacturacion = "Agosto";
                                break;
                            case 9:
                                $MesFacturacion = "Septiembre";
                                break;
                            case 10:
                                $MesFacturacion = "Octubre";
                                break;
                            case 11:
                                $MesFacturacion = "Noviembre";
                                break;
                            case 12:
                                $MesFacturacion = "Diciembre";
                                break;
                        }

                        // $Diasdelmes = cal_days_in_month (CAL_GREGORIAN, $Mes,$Ano);
                        //si es anual los dias del mes serian 365
                        if($Servicio['TipoFactura'] == '17' || $Servicio['TipoFactura'] == '24'){
                            // echo 'Entro a anuales '.$Servicio['TipoFactura'];
                            $servicioAnual = true;
                            $Diasdelmes = 365;
                        }else{
                            $servicioAnual = false;
                            // echo 'entro el 30 dias '.$Servicio['TipoFacura'];
                            $Diasdelmes = 30;
                        }
                        //si es anual
                        if($servicioAnual){
                            $Concepto .= ' Anual - Periodo ' . date('Y');
                            $Diasporfacturar = $Diasdelmes;
                        }else{
                            if($Dia != $Diasdelmes){
                                if($Dia != 1){
                                    $Diasporfacturar = $Diasdelmes - $Dia;
                                    $Concepto .= ' - Proporcional ' . $MesFacturacion . ' ('.$Diasporfacturar.' Dias)';
                                }else{
                                    $Diasporfacturar = $Diasdelmes;
                                    $Concepto .= ' - Mes ' . $MesFacturacion;
                                }
                            }else{
                                $Diasporfacturar = 1;
                                $Concepto .= ' - Proporcional ' . $MesFacturacion . ' ('.$Diasporfacturar.' Dia)';
                            }	
                        }
                        
                        if($Conexion){
                            $Concepto .= ' - ' . $Conexion;
                        }
                        
                        $Valor = $Valor * $UF;
                        $Montodiario = $Valor / $Diasdelmes;
                        $Valor = $Diasporfacturar * $Montodiario;
                        $DescuentoValor = $Valor * ( $Descuento / 100 );
                        $Valor -= $DescuentoValor;
                        $Impuesto = $Valor * 0.19;
                        $Total = $Valor + $Impuesto;
                        $Total = round($Total,0);

                        $query = "INSERT INTO facturas_detalle(FacturaId, Concepto, Valor, Descuento, IdServicio, Cantidad, Total, Codigo) VALUES ('".$FacturaId."', '".$Concepto."', '".$Valor."', '".$Descuento."', '".$Id."', '1', '".$Total."', '".$Codigo."')";
                        $FacturaDetalle = $run->insert($query);
                    }
                }
            }

            $response_array['Id'] = $Id;
            $response_array['status'] = 1;
        }else{
            $response_array['status'] = 5;
        }

        return $response_array['status'];
    }
 ?>



