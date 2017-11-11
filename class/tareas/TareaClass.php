<?php

	require("../../includes/email/PHPMailer-master/class.phpmailer.php");
	require("../../includes/email/PHPMailer-master/class.smtp.php");
    include('../../class/methods_global/methods.php'); 
    include('../../class/email/EmailClass.php');  

    header('Content-type: application/json');

    class Tarea{

    	public function showServicios(){

    		$query = 'SELECT servicios.*, personaempresa.nombre as Cliente, usuarios.nombre as Usuario FROM servicios INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut LEFT JOIN usuarios ON servicios.IdUsuarioAsignado = usuarios.id';

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

		            	$query = "UPDATE `servicios` set `IdUsuarioAsignado` = '$this->IdUsuarioAsignado' where `Id` = '$Tarea'";
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

	        	$FechaInstalacion = DateTime::createFromFormat('d-m-Y', $FechaInstalacion)->format('Y-m-d');

	        	if($Estatus == 2){
	        		$Estatus = 0;
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