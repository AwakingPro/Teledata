<?php
class Email
{
	private $metodo;
	private $correo;
	private $clave;
	private $email_from;

	function __construct () {

		$this->metodo = new Method;
		$query = "SELECT correo, clave, email_from, host FROM teledata_correos";
		// $query = "SELECT correo_prueba, clave_prueba, email_from_prueba FROM teledata_correos";
		$remitente = $this->metodo->select($query);
		if(count($remitente)){
			$this->correo = $remitente[1]['correo'];
			$this->clave = $remitente[1]['clave'];
			$this->email_from = $remitente[1]['email_from'];
            $this->host = $remitente[1]['host'];
			// $this->correo = $remitente[0]['correo_prueba'];
			// $this->clave = $remitente[0]['clave_prueba'];
			// $this->email_from = $remitente[0]['email_from_prueba'];
		}else{
			echo 'Error al seleccionar el remitente de la bd';
		}
	}

	// metodo para verificar que trae los datos del remitente
	public function pruebaCorreo(){
		$this->correo;
		$this->clave;
		$this->email_from;
		echo 'correo '.$this->correo; echo "\n";
		echo 'email '.$this->clave; echo "\n";
		echo 'email_from '.$this->email_from;
	}

	//Versión 2
	public function SendMail($html,$subject,$emails,$attachments = false, $emisor = false){ 
		$html = utf8_decode($html);
		$subject = utf8_decode($subject);
		$mail = new PHPMailer();  
		
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		if($attachments){
			foreach($attachments as $attachment){
				$mail->addAttachment($attachment['url'],$attachment['name']);  
			}
		}
		// $mail->SMTPSecure = "ssl";
		$mail->SMTPSecure = "TLS";
		$mail->Host = "smtp.gmail.com";
		// $mail->  = "smtp.mailgun.org"; 
		// $mail->Port = 25;  
		$mail->Port = 587;
		if($emisor){
			$query2 = "SELECT correo, clave, email_from, host FROM teledata_correos";
			$remitente = $this->metodo->select($query2);
			if(count($remitente)){
                $mail->Host = $remitente[3]['host'];
                $mail->FromName = "Teledata Servicios";
				$mail->Username = $remitente[3]['correo'];
				$mail->Password = $remitente[3]['clave'];
				$mail->From = $remitente[3]['email_from'];


			}else{
				echo 'Error al seleccionar el remitente de la bd';
			}
		}else{
            $mail->FromName = "Teledata DTE";
            $mail->Username = $this->correo;
			$mail->Password = $this->clave;
			$mail->From = $this->email_from;
		}
		// echo "<pre>"; echo print_r($mail); echo "</pre>";

		$mail->Subject = $subject;  
		$mail->IsHTML(true);  
		$mail->MsgHTML($html); 

		$emails = explode(',',$emails);
		foreach($emails as $email){
			$email = trim($email);
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$mail->AddAddress($email);   
			}
		}
		
		if($mail->Send()){
			$ToReturn = true; 
		}else{
		  	echo "Error al enviar, causa: " .$mail->ErrorInfo;  
		  	$ToReturn = false;
	  	} 
		
		return $ToReturn;	
	}

	public function SendTest($html,$subject,$email_list){ 		
		$ToReturn = FALSE;
		$mail = new PHPMailer();  
		/*$mail->IsSMTP();
		$mail->SMTPAuth = true;  
		//$mail->SMTPSecure = "ssl";   
		$mail->Host = "mail.cobranding.cl"; 
		//$mail->SMTPDebug = 1;  
		$mail->Port = 25;  
		$mail->Username = "redes@cobranding.cl";  
		$mail->Password = "M9a7r5s3A";  
		$mail->From = "redes@cobranding.cl";   
		$mail->FromName = "eMAIL foCO";   
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);*/

		include('../../includes/functions/Functions.php');
		include('../../run/connect.php');
		include('opciones.php');

		$config = new opciones; 
		$Conf = $config->configvalues($con,"","0");

		if($Conf["ProtocolSMTP"] != ""){
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
		}
		if($Conf["SecureSSL"] != ""){
			$mail->SMTPSecure = "ssl";
		}

		if($Conf["SecureTLS"] != ""){
			$mail->SMTPSecure = "TLS";
		}
		
		$mail->Host = $Conf["Host"]; 
		//$mail->SMTPDebug = 1;  
		$mail->Port = $Conf["Port"];  
		$mail->Username = $Conf["Email"];  
		$mail->Password = $Conf["Pass"];  
		$mail->From = $Conf["FromEmail"];   
		$mail->FromName = $Conf["FromName"];  

		$mail->Subject = $subject; 
		$mail->IsHTML(true); 
		$mail->MsgHTML($html);

		if(is_array($email_list)){
			foreach($email_list as $email){ 				
				if( $email != ""){   
					$mail->AddAddress($email); 
			   		$mail->send();
			   		$mail->ClearAllRecipients();  
				}
			}
			$ToReturn = TRUE;
		} else { 
			if( $email_list != ""){   
			 	$mail->AddAddress($email_list);   
			}  
			if(!$mail->Send()){   
			  	echo "Error al enviar, causa: " .$mail->ErrorInfo;  
			  	$ToReturn = FALSE;
			}else{   
			  	$ToReturn = TRUE;
		  	} 
		}
		return $ToReturn;
	
	}
	public function SendNotification($html,$subject,$email_list,$FromName = "eMAIL foCO"){ 		
		$ToReturn = FALSE;
		$mail = new PHPMailer();  
		$mail->IsSMTP();
		$mail->SMTPAuth = true;  
		//$mail->SMTPSecure = "ssl";   
		$mail->Host = "mail.cobranding.cl"; 
		//$mail->SMTPDebug = 1;  
		$mail->Port = 25;  
		$mail->Username = "redes@cobranding.cl";  
		$mail->Password = "M9a7r5s3A";  
		$mail->From = "redes@cobranding.cl";  		
		$mail->FromName = $FromName;  
		$mail->Subject = $subject; 
		$mail->IsHTML(true);
		$mail->MsgHTML($html); 
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		if(is_array($email_list)){
			foreach($email_list as $email){ 				
				if( $email != ""){   
					$mail->AddAddress($email); 
			   		$mail->send();
			   		$mail->ClearAllRecipients();  
				}
			}
			$ToReturn = TRUE;
		} else { 
			if( $email_list != ""){   
			 	$mail->AddAddress($email_list);   
			}  
			if(!$mail->Send()){   
			  	echo "Error al enviar, causa: " .$mail->ErrorInfo;  
			  	$ToReturn = FALSE;
			}else{   
			  	$ToReturn = TRUE;
		  	} 
		}
		return $ToReturn;
	
	}

	public function get_var_value($rut,$var,$cedente){

    	$run = new Method();

		$return = false;

		$fields_variable = "SELECT * FROM Variables WHERE variable= '".$var."' and id_cedente='".$cedente."'";

//if($rut == "21166628"){
//echo $fields_variable."\n";
//}

		$row = $run->select($fields_variable);

		if(count($row)>0){

			$row_var = $row[0];

			$tabla = $row_var['tabla'];
			$campos = $row_var['campo'];
			$operacion = $row_var['operacion'];
			$array_campos = explode(',', $campos);
			$cedente = ($tabla == 'Deuda') ? " AND Id_Cedente = '".$cedente."'" : "";

			if($operacion == ''){

				$consulta_valores = "SELECT ".$campos." FROM ".$tabla." WHERE Rut='".$rut."'".$cedente;

			} else{
				$consulta_valores = "SELECT ".$operacion."(".$campos.") AS ".$campos." FROM ".$tabla." WHERE Rut='".$rut."'".$cedente;
			}
			
			$valores = $run->select($consulta_valores);
			
			if(count($array_campos) > 1){
				$tabla = '<table width="700" style="border-spacing: 0px;">
				<thead>
					<tr style="background-color: #5fa2dd; color: #FFFFFF; text-align: center;">';
				foreach ($array_campos as $campo) {
					$tabla .= '<th>'.ucfirst(str_replace('_',' ',$campo)).'</th>';
				}

				$tabla .= '</tr>
				</thead>
				<tbody>';
				if(count($valores) > 0){
					foreach($valores as $valor){
						$tabla .= '<tr>';
						foreach ($array_campos as $campo) {
							$tabla .=  '<td style="border-bottom: 1px solid #CCCCCC;text-align: center;">'.$valor[$campo].'</td>';
						}
						$tabla .= '</tr>';
					}
				}
				$tabla .= '</tbody>
				</table>';

				$return = $tabla;

			} elseif(count($array_campos) == 1){

				$valores = $valores[0];

				$return = $valores[$campos];
			} 

			return $return;

		}

		return $return;
	}
	public function gen_code(){

    	$run = new Method();
		$exist = true;
		$char = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    	$lon = strlen($char) - 1;
    	$return = false;
    
		do{
			$code = '';
			for($i=0;$i<6;$i++){
				$code .= substr($char, rand(0, $lon), 1);
			}

			$query_exist = "SELECT * FROM Confirmacion WHERE codigo = '".$code."'";

			$result = $run->select($query_exist);

			if(count($result) > 0){
				$exist = true;
			} else{
				$exist = false;
			}

		} while ($exist);

		$return = $code;

		return $return;
	}

	public function verificacionCron(){
		$run = new Method();
		$isValid = 2; // 1=activo y 2=inactivo   
		// verifico si el cron esta activo
		$consulta_cron = "SELECT * FROM cron_email WHERE estatus = 1 and id = 1";
		$cron = $run->select($consulta_cron);
		if(count($cron) > 0){
			$isValid = 1;
		}
		return $isValid;   
	}

	public function verificacionAlertaEnvio(){
		$run = new Method();
		//verifico si existe cola de envio
		$consulta_envio = "SELECT DISTINCT id_usuario FROM envio_email WHERE status = 0";
		$envio = $run->select($consulta_envio);
		$colaUsuarios = array();
		if(count($envio) > 0){			
		    foreach($envio as $cola){
				$idUsuario = $cola['id_usuario'];
        		$consultaUsuario = "SELECT nombre, id FROM Usuarios WHERE id = ".$idUsuario."";
        		$usua = $run->select($consultaUsuario);
          		foreach($usua as $usuario){
					$Array = array();
            		$Array[] = $usuario['nombre'];
            		array_push($colaUsuarios, $Array);
          		}
            }
		}
    	return $colaUsuarios;
	}

	public function getListarColas(){
    	$run = new Method();
    	$colasArray = array();
    	$Sql = "SELECT estrategia, id FROM envio_email WHERE id_usuario = ".$_SESSION['id_usuario']." AND status = 0";
    	$colas = $run -> select($Sql);
    	foreach($colas as $cola){
      		$Array = array();
      		$Array['estrategia'] = $cola["estrategia"];
      		$Array['id'] = $cola["id"];
      		array_push($colasArray,$Array);
    	}
   		return $colasArray;
  	}
	 

	public function cancelarColaEnvio($idCola){
    	$run = new Method();
  		$SqlUpdate = "UPDATE envio_email set status = '2', fechaProceso = NOW(), continuar = '0'  WHERE id ='".$idCola."'";
    	$run -> query($SqlUpdate);
    }  

	public function continuarEnvioCola($idCola){
		$isValid = 2;
    	$run = new Method();
  		$SqlUpdate = "UPDATE envio_email set continuar = '0' WHERE id ='".$idCola."'";
    	$run -> query($SqlUpdate);
		// verifico si tengo mas envios en cola parados
		$Sql = "SELECT * FROM envio_email WHERE status = 0, fechaProceso = NOW() AND continuar = 1";
    	$colas = $run -> select($Sql);
		if(count($colas) == 0){		
			// si no existen colas paradas activo el cron
			$SqlUpdate = "UPDATE cron_email set estatus = 1 WHERE id = 1";
    		$run -> query($SqlUpdate);
			$isValid = 1;
		}
		return $isValid;   	
		}
}