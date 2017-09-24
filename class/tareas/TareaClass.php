<?php

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Tarea{

    	public function showServicios(){

    		$query = 'SELECT servicios.*, personaempresa.nombre as Cliente FROM servicios INNER JOIN personaempresa ON personaempresa.rut = servicios.Rut';

            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

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