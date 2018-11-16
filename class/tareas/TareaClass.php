<?php

	include('../../class/methods_global/methods.php');
    header('Content-type: application/json');

    class Tarea{

    	public function showServicios(){

    		$query = "	SELECT
							servicios.*, personaempresa.nombre AS Cliente,
							personaempresa.id AS IdPersonaEmpresa,
							personaempresa.direccion AS Direccion,
							usuarios.nombre AS Usuario,
							servicios.FechaInstalacion
						FROM
							servicios
						INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut
						LEFT JOIN usuarios ON servicios.IdUsuarioAsignado = usuarios.id
						WHERE
							servicios.FechaInstalacion != '1970-01-01'";

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

	           	$query = "SELECT * FROM usuarios where id = '$IdUsuarioAsignado'";
	           	$data = $run->select($query);
		        $Usuario = $data[0];

	            $Tareas = explode(",", $Tareas);

	            foreach($Tareas as $Tarea){
	            	if($Tarea){

	            		$query = "SELECT Codigo FROM servicios where Id = '$Tarea'";
			           	$data = $run->select($query);
				        $Codigo = $data[0]['Codigo'];
				        $Codigos[] = $Codigo;

		            	$query = "UPDATE servicios set IdUsuarioAsignado = '$IdUsuarioAsignado', EstatusInstalacion = '3' where Id = '$Tarea'";
			            $data = $run->update($query);
			            $array[] = $Tarea;
		            }
	            }

	           	if($Usuario['email']){
	           		$Codigos = implode(", ", $Codigos);
	           		// $Estatus = $enviarCorreo($Usuario,$Codigos);
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

	           	$query = "SELECT * FROM usuarios WHERE id = '".$IdUsuarioAsignado."'";
	           	$data = $run->select($query);
		        $Usuario = $data[0];

	        	$query = "UPDATE servicios SET IdUsuarioAsignado = '".$IdUsuarioAsignado."' WHERE Id = '$Id'";
	            $data = $run->update($query);

	            if($data){
	            	$response_array['Usuario'] = $Usuario['nombre'];
	            	$response_array['Id'] = $Id;
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

			require("../../includes/email/PHPMailer-master/class.phpmailer.php");
			require("../../includes/email/PHPMailer-master/class.smtp.php");
			include('../../class/email/EmailClass.php');


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
			$run = new Method;

	        $FechaInstalacion = isset($FechaInstalacion) ? trim($FechaInstalacion) : "";
	        $InstaladoPor = isset($InstaladoPor) ? trim($InstaladoPor) : "";
	        $Comentario = isset($Comentario) ? trim($Comentario) : "";
	        $UsuarioPppoe = isset($UsuarioPppoe) ? trim($UsuarioPppoe) : "";
	        $EstacionFinal = isset($EstacionFinal) ? trim($EstacionFinal) : "";
	        $SenalFinal = isset($SenalFinal) ? trim($SenalFinal) : "";
	        $Estatus = isset($Estatus) ? trim($Estatus) : "";

	        if(!empty($FechaInstalacion) && !empty($InstaladoPor) && !empty($UsuarioPppoe) && !empty($EstacionFinal) && !empty($SenalFinal) && !empty($Estatus)){

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

				if($Estatus == 1){
					
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
						$EstatusTarea = $Servicio['EstatusInstalacion'];
						
						if($EstatusTarea != 1){
							$Rut = $Servicio['Rut'];
							$Grupo = $Servicio['Grupo'];
							$TipoDocumento = $Servicio['tipo_cliente'];
							$fechaVencimiento = date('Y-m-25');
							//aqui cambio fecha instalacion para que luego aparezcan en facturas por lotes
							$query = "INSERT INTO facturas(Rut, Grupo, TipoFactura, EstatusFacturacion, DocumentoIdBsale, UrlPdfBsale, informedSiiBsale, responseMsgSiiBsale, FechaFacturacion, HoraFacturacion, TipoDocumento, FechaVencimiento, IVA) VALUES ('".$Rut."', '".$Grupo."', '2', '0', '0', '', '0', '', NOW(), NOW(),'".$TipoDocumento."', '".$fechaVencimiento."', 0.19)";
							$FacturaId = $run->insert($query);

							if($FacturaId){

								$UfClass = new Uf(); 
								$UF = $UfClass->getValue();
								
								$Codigo = $Servicio['Codigo'];
								$Concepto = $Servicio['Servicio'];
								$Valor = $Servicio['Valor'];
								$Descuento = $Servicio['Descuento'];
								$Conexion = $Servicio['Conexion'];

								if($FechaInstalacion){
									$dt = DateTime::createFromFormat('Y-m-d', $FechaInstalacion);
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
								if($Conexion){
									$Concepto .= ' - ' . $Conexion;
								}
								//aqui2
								if($Servicio["tipo_moneda"] == '2')
								$Valor = $Valor * $UF;
								else
								$Valor = $Valor;
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
				}

				$query = "UPDATE servicios SET FechaInstalacion = '$FechaInstalacion', InstaladoPor = '$InstaladoPor', Comentario = '$Comentario', UsuarioPppoe = '$UsuarioPppoe', EstacionFinal = '$EstacionFinal', SenalFinal = '$SenalFinal', EstatusInstalacion = '$Estatus' where Id = '$Id'";
				$data = $run->update($query);
				
				$response_array['Estatus'] = $Estatus;
				$response_array['Id'] = $Id;
				$response_array['status'] = 1;

	            
	        }else{
	            $response_array['status'] = 2;
	        }

	        echo json_encode($response_array);
	    }

	    public function showTarea($Id){
			$ToReturn = array();
    		$query = "SELECT s.*, ms.nombre as EstacionFinalNombre FROM servicios s LEFT JOIN mantenedor_site ms ON s.EstacionFinal = ms.id WHERE s.Id = '".$Id."'";

            $run = new Method;
            $data = $run->select($query);

            if($data){
            	$ToReturn = $data[0];
            }

            $response_array['array'] = $ToReturn;

            echo json_encode($response_array);
    	}
    }
?>