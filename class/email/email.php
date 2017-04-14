<?php 

class Email
{
	/*/Versión 1
	public function SendMail($html,$subject,$email_list, $info){ 
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
		$mail->FromName = "Foco";  
		$mail->Subject = $subject; 
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		$adjuntos = $info['adjuntos']; 
		$variables = $info['variables']; 

		if(is_array($email_list)){
			foreach($email_list as $email){ 				
				if( $email != ""){  					
					if($adjuntos){
						foreach ($adjuntos[$email] as $adjunto) {
							$archivo = '../../facturas/'.$adjunto.'.pdf';
							if(file_exists($archivo)){
								$mail->addAttachment($archivo);   
							}
						}
					}

					$find = array('[correo]');
					$replace = array($email);
					
					foreach ($variables as $var){
						$find[]='['.$var.']';
						$replace[] = $info[$email][$var];
					}
					$content = str_replace($find, $replace, $html);

					$mail->MsgHTML($content);   

			 		$mail->AddAddress('andres.estereomkt@gmail.com'); 
					//$mail->AddAddress($email); 
			   		$mail->send();
			   		$mail->ClearAllRecipients();  
				}
			}
			$ToReturn = TRUE;
		} else { 
			$mail->MsgHTML($html); 
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

	*/
	//Versión 2
	public function SendMail($html,$subject,$email_list,$info){ 
		$ToReturn = FALSE;
		$mail = new PHPMailer();  
		$mail->IsSMTP();
		$mail->SMTPAuth = true;  
		$mail->SMTPSecure = "ssl";   
		$mail->Host = "smtp.googlemail.com"; 
		$mail->SMTPDebug = 1;  
		$mail->Port = 465;  
		$mail->Username = "andresg.ch3@gmail.com";  
		$mail->Password = "naomi3004*";  
		$mail->From = "andresg.ch3@gmail.com";   
		$mail->FromName = "eMAIL foCO";  
		$mail->Subject = $subject;  
		$mail->IsHTML(true);  

		$adjuntos = $info['adjuntos']; 
		$variables = $info['variables']; 

		if(is_array($email_list)){
			foreach($email_list as $email){ 				
				if( $email != ""){  					
					if($adjuntos){
						foreach ($adjuntos[$email] as $adjunto) {
							$archivo = '../../facturas/'.$adjunto.'.pdf';
							if(file_exists($archivo)){
								$mail->addAttachment($archivo);   
							}
						}
					}

					$find = array('[correo]');
					$replace = array($email);
					
					foreach ($variables as $var){
						$find[]='['.$var.']';
						$replace[] = $info[$email][$var];
					}
					$content = str_replace($find, $replace, $html);

					$mail->MsgHTML($content);   

			 		$mail->AddAddress('andres.estereomkt@gmail.com'); 
					//$mail->AddAddress($email); 
			   		$mail->send();
			   		$mail->ClearAllRecipients();  
				}
			}
			$ToReturn = TRUE;
		} else { 
			$mail->MsgHTML($html); 
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

	public function SendTest($html,$subject,$email_list){ 		
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
		$mail->FromName = "eMAIL foCO";  
		$mail->Subject = $subject; 
		$mail->IsHTML(true); 

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
	public function SendNotification($html,$subject,$email_list){ 		
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
		$mail->FromName = "eMAIL foCO";  
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

	public function get_var_value($rut,$var){

    	$db = new Db();

		$return = false;

		$fields_variable = "SELECT * FROM Variables WHERE variable= '".$var."'";

		$row = $db->select($fields_variable);

		if(count($row)>0){

			$row_var = $row[0];

			$tabla = $row_var['tabla'];
			$campos = $row_var['campo'];
			$operacion = $row_var['operacion'];
			$array_campos = explode(',', $campos);
			$cedente = ($tabla == 'Deuda') ? " AND Id_Cedente = '".$_SESSION['cedente']."'" : "";

			if($operacion == ''){

				$consulta_valores = "SELECT ".$campos." FROM ".$tabla." WHERE Rut='".$rut."'".$cedente;

			} else{
				$consulta_valores = "SELECT ".$operacion."(".$campos.") AS ".$campos." FROM ".$tabla." WHERE Rut='".$rut."'".$cedente;
			}
			
			$valores = $db->select($consulta_valores);

			if(count($array_campos) > 1){
				$tabla = '<table width="700">
				<thead>
					<tr>';
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
							$tabla .=  '<td>'.$valor[$campo].'</td>';
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

    	$db = new Db();
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

			$result = $db->select($query_exist);

			if(count($result) > 0){
				$exist = true;
			} else{
				$exist = false;
			}

		} while ($exist);

		$return = $code;

		return $return;
	}

}