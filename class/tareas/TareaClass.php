<?php

	require("../../includes/email/PHPMailer-master/class.phpmailer.php");
	require("../../includes/email/PHPMailer-master/class.smtp.php");
    include('../../class/methods_global/methods.php');
    include('../../class/email/EmailClass.php');

    header('Content-type: application/json');

    class Tarea{

    	public function showServicios(){

    		$query = '	SELECT servicios.*,
    					personaempresa.nombre as Cliente,
    					personaempresa.id as IdPersonaEmpresa,
    					personaempresa.direccion as Direccion,
    					usuarios.nombre as Usuario
    					FROM servicios 
    					INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut 
    					LEFT JOIN usuarios ON servicios.IdUsuarioAsignado = usuarios.id
    					WHERE servicios.FechaInstalacion != "1970-01-01"';

            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);
    	}

    	function asignarTareas($Tareas,$IdUsuarioAsignado){

	        $response_array = array();
	        $array = array();
	        $Codigos = array();

	        $Tareas = isset($Tareas) ? trim($Tareas) : "";
	        $IdUsuarioAsignado = isset($IdUsuarioAsignado) ? trim($IdUsuarioAsignado) : "";

	        if(!empty($Tareas) && !empty($IdUsuarioAsignado)){

	        	$run = new Method;

	            $this->IdUsuarioAsignado=$IdUsuarioAsignado;

	           	$query = "SELECT * FROM usuarios where id = '$this->IdUsuarioAsignado'";
	           	$data = $run->select($query);
		        $Usuario = $data[0];

	            $Tareas = explode(",", $Tareas);

	            foreach($Tareas as $Tarea){
	            	if($Tarea){

	            		$query = "SELECT Codigo FROM servicios where Id = '$Tarea'";
			           	$data = $run->select($query);
				        $Codigo = $data[0]['Codigo'];
				        $Codigos[] = $Codigo;

		            	$query = "UPDATE `servicios` set `IdUsuarioAsignado` = '$this->IdUsuarioAsignado', `Estatus` = '3' where `Id` = '$Tarea'";
			            $data = $run->update($query);
			            $array[] = $Tarea;
		            }
	            }

	           	if($Usuario['email']){
	           		$Codigos = implode(", ", $Codigos);
	           		// $Estatus = $this->enviarCorreo($Usuario,$Codigos);
	           		$Estatus = true;
	           	}else{
	           		$Estatus = true;
	           	}

	            if($Estatus){

		       		$response_array['Usuario'] = $Usuario['nombre'];
		            $response_array['array'] = $array;

		            $response_array['status'] = 1;

	        	}else{
	        		$response_array['status'] = 99;
	        	}

	        }else{
	            $response_array['status'] = 2;
	        }

	        echo json_encode($response_array);
	    }

	    function reasignarTarea($Id,$IdUsuarioAsignado){

	        $response_array = array();

	        $Id = isset($Id) ? trim($Id) : "";
	        $IdUsuarioAsignado = isset($IdUsuarioAsignado) ? trim($IdUsuarioAsignado) : "";

	        if(!empty($Id) && !empty($IdUsuarioAsignado)){

	        	$run = new Method;

	            $this->Id=$Id;
	            $this->IdUsuarioAsignado=$IdUsuarioAsignado;

	           	$query = "SELECT * FROM usuarios where id = '$this->IdUsuarioAsignado'";
	           	$data = $run->select($query);
		        $Usuario = $data[0];

	        	$query = "UPDATE `servicios` set `IdUsuarioAsignado` = '$this->IdUsuarioAsignado' where `Id` = '$this->Id'";
	            $data = $run->update($query);

	            if($Usuario['email']){
	            	$query = "SELECT Codigo FROM servicios where Id = '$this->Id'";
		           	$data = $run->select($query);
			        $Codigo = $data[0]['Codigo'];
	           		$Estatus = $this->enviarCorreo($Usuario,$Codigo);
	           	}else{
	           		$Estatus = true;
	           	}

	            if($Estatus){
	            	$response_array['Usuario'] = $Usuario['nombre'];
	            	$response_array['Id'] = $this->Id;
	                $response_array['status'] = 1;

	            }else{
	                $response_array['status'] = 0;
	            }

	        }else{
	            $response_array['status'] = 2;
	        }

	        echo json_encode($response_array);
	    }


	    public function enviarCorreo($Usuario,$Codigos){

	    	$Nombre = $Usuario['nombre'];
	    	$Correo = $Usuario['email'];

	    	$Asunto = 'Ha recibido nuevas tareas';

			$Html =
			"<html>
				<head>
					<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
					<style>
					body{font-family:Open Sans;font-size:14px;}
					table{font-size:13px;border-collapse:collapse;}
					th{padding:8px;text-align:left;color:#595e62;border-bottom: 2px solid rgba(0,0,0,0.14);font-size:14px;}
					td{padding:8px;border-bottom: 1px solid rgba(0,0,0,0.05);}
					</style>
				</head>
				<body>
				Estimado $Nombre,<br>
					Se le han asignado las tareas con los codigos $Codigos.<br>
				</body>
			</html>";

			$Email = new Email();
			$Estatus = $Email->SendMail($Html,$Asunto,$Correo);

			return $Estatus;

	    }

	    function storeTarea($Id,$FechaInstalacion,$InstaladoPor,$Comentario,$UsuarioPppoe,$SenalFinal,$EstacionFinal,$Estatus){

	        $response_array = array();

	        $FechaInstalacion = isset($FechaInstalacion) ? trim($FechaInstalacion) : "";
	        $InstaladoPor = isset($InstaladoPor) ? trim($InstaladoPor) : "";
	        $Comentario = isset($Comentario) ? trim($Comentario) : "";
	        $UsuarioPppoe = isset($UsuarioPppoe) ? trim($UsuarioPppoe) : "";
	        $EstacionFinal = isset($EstacionFinal) ? trim($EstacionFinal) : "";
	        $SenalFinal = isset($SenalFinal) ? trim($SenalFinal) : "";
	        $Estatus = isset($Estatus) ? trim($Estatus) : "";

	        if(!empty($FechaInstalacion) && !empty($InstaladoPor)  && !empty($Comentario)  && !empty($UsuarioPppoe) && !empty($EstacionFinal) && !empty($SenalFinal) && !empty($Estatus)){

	        	if($FechaInstalacion){
	        		$FechaInstalacion = DateTime::createFromFormat('d-m-Y', $FechaInstalacion)->format('Y-m-d');
	        	}else{
	        		$FechaInstalacion = '';
	        	}

	        	$Hoy = new DateTime(); 
		        $Hoy = $Hoy->format('Y-m-d H:i:s');

	        	if($Estatus == 1){
	        		if($FechaInstalacion > $Hoy){
	        			$response_array['status'] = 3;
	        			echo json_encode($response_array);
	        			exit;
	        		}
	        	}

	            $this->Id=$Id;
	            $this->FechaInstalacion=$FechaInstalacion;
	            $this->InstaladoPor=$InstaladoPor;
	            $this->Comentario=$Comentario;
	            $this->UsuarioPppoe=$UsuarioPppoe;
	            $this->EstacionFinal=$EstacionFinal;
	            $this->SenalFinal=$SenalFinal;
	            $this->Estatus=$Estatus;

	            $query = "UPDATE `servicios` set `FechaInstalacion` = '$this->FechaInstalacion', `InstaladoPor` = '$this->InstaladoPor', `Comentario` = '$this->Comentario', `UsuarioPppoe` = '$this->UsuarioPppoe', `EstacionFinal` = '$this->EstacionFinal', `SenalFinal` = '$this->SenalFinal', `Estatus` = '$this->Estatus' where `Id` = '$this->Id'";
	            $run = new Method;
	            $data = $run->update($query);

	            if($data){

	            	if($Estatus == 1){

		            	$query = "	SELECT servicios.*, mantenedor_servicios.servicio as Servicio 
		            				FROM servicios 
		            				LEFT JOIN mantenedor_servicios ON servicios.IdServicio = mantenedor_servicios.IdServicio 
		            				WHERE `Id` = '$this->Id'";
	                    $Servicio = $run->select($query);

	                    if($Servicio){

	                    	$Servicio = $Servicio[0];

			            	$Rut = $Servicio['Rut'];
		                    $Grupo = $Servicio['Grupo'];

		                    $query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion) VALUES ('$Rut', '$Grupo', '2', '0', '0', '', '0', '', '$Hoy', '$Hoy')";
		                    $FacturaId = $run->insert($query);

		                    if($FacturaId){

		                    	$Concepto = $Servicio['Servicio'];
		                    	$Valor = $Servicio['Valor'];
			                    $Descuento = $Servicio['Descuento'];
			                    $TipoMoneda = $Servicio['TipoMoneda'];

							    if($this->FechaInstalacion){
							    	$dt = DateTime::createFromFormat('Y-m-d', $this->FechaInstalacion);
							    }else{
							    	$dt = new DateTime();
							    }

							   	$Mes =  $dt->format('m');
							    $Ano =  $dt->format('Y');
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
		
						    	$Diasdelmes = cal_days_in_month (CAL_GREGORIAN, $Mes,$Ano);

			                   	if($Dia != $Diasdelmes){
					    			
					    			if($Dia == 1){
					    				$Diasporfacturar = $Diasdelmes;
										// $Concepto .= ' - Mes ' . $MesFacturacion;
					    			}else{
					    				$Diasporfacturar = $Diasdelmes - $Dia;
					    			}
					    			$Concepto .= ' - Proporcional ' . $MesFacturacion . ' ('.$Diasporfacturar.' Dias)';
					    		}else{
					    			$Diasporfacturar = 1;
					    			$Concepto .= ' - Proporcional ' . $MesFacturacion . ' ('.$Diasporfacturar.' Dia)';
					    		}	

							    $Montodiario = $Valor / $Diasdelmes;
							    $Montoporfacturar = $Diasporfacturar * $Montodiario;

			                    $query = "INSERT INTO facturas_detalle(FacturaId, Servicio, Valor, Descuento, TipoMoneda) VALUES ('$FacturaId', '$Concepto', '$Montoporfacturar', '$Descuento', '$TipoMoneda')";
			                    $FacturaDetalle = $run->insert($query);
		                    }
	                    }
                    }

	            	$response_array['Estatus'] = $this->Estatus;
	            	$response_array['Id'] = $this->Id;
	                $response_array['status'] = 1;

	            }else{
	                $response_array['status'] = 0;
	            }
	        }else{
	            $response_array['status'] = 2;
	        }

	        echo json_encode($response_array);
	    }

	    public function showTarea($Id){

    		$query = "SELECT * FROM servicios WHERE Id = '$Id'";

            $run = new Method;
            $data = $run->select($query);

            if($data){
            	$data = $data[0];
            }

            $response_array['array'] = $data;

            echo json_encode($response_array);
    	}
    }
?>