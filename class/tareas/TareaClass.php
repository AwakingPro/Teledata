<?php

    include('../../class/methods_global/methods.php'); 
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

	        $Tareas = isset($Tareas) ? trim($Tareas) : "";
	        $IdUsuarioAsignado = isset($IdUsuarioAsignado) ? trim($IdUsuarioAsignado) : "";

	        if(!empty($Tareas) && !empty($IdUsuarioAsignado)){

	        	$run = new Method;

	            $this->IdUsuarioAsignado=$IdUsuarioAsignado;

	           	$query = "SELECT nombre FROM usuarios where id = '$this->IdUsuarioAsignado'";
	           	$data = $run->select($query);
		        $Usuario = $data[0]['nombre'];

	            $Tareas = explode(",", $Tareas);

	            foreach($Tareas as $Tarea){
	            	if($Tarea){
		            	$query = "UPDATE `servicios` set `IdUsuarioAsignado` = '$this->IdUsuarioAsignado' where `Id` = '$Tarea'";
			            $data = $run->update($query);
			            $array[] = $Tarea;
		            }
	            }
	       	
	       		$response_array['Usuario'] = $Usuario;
	            $response_array['array'] = $array;

	            $response_array['status'] = 1; 

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

	           	$query = "SELECT nombre FROM usuarios where id = '$this->IdUsuarioAsignado'";
	           	$data = $run->select($query);
		        $Usuario = $data[0]['nombre'];
	            
	        	$query = "UPDATE `servicios` set `IdUsuarioAsignado` = '$this->IdUsuarioAsignado' where `Id` = '$this->Id'";
	            $data = $run->update($query);

	            if($data){
	            	$response_array['Usuario'] = $Usuario;
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
    
	    function storeTarea($Id,$FechaInstalacion,$InstaladoPor,$Comentario,$UsuarioPppoe){

	        $response_array = array();

	        $FechaInstalacion = isset($FechaInstalacion) ? trim($FechaInstalacion) : "";
	        $InstaladoPor = isset($InstaladoPor) ? trim($InstaladoPor) : "";
	        $Comentario = isset($Comentario) ? trim($Comentario) : "";
	        $UsuarioPppoe = isset($UsuarioPppoe) ? trim($UsuarioPppoe) : "";

	        if(!empty($FechaInstalacion) && !empty($InstaladoPor)  && !empty($Comentario)  && !empty($UsuarioPppoe)){

	        	$FechaInstalacion = DateTime::createFromFormat('d-m-Y', $FechaInstalacion)->format('Y-m-d');

	            $this->Id=$Id;
	            $this->FechaInstalacion=$FechaInstalacion;
	            $this->InstaladoPor=$InstaladoPor;
	            $this->Comentario=$Comentario;
	            $this->UsuarioPppoe=$UsuarioPppoe;

	            $query = "UPDATE `servicios` set `FechaInstalacion` = '$this->FechaInstalacion', `InstaladoPor` = '$this->InstaladoPor', `Comentario` = '$this->Comentario', `UsuarioPppoe` = '$this->UsuarioPppoe', `Estatus` = '1' where `Id` = '$this->Id'";
	            $run = new Method;
	            $data = $run->update($query);

	            if($data){

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
    }
?>