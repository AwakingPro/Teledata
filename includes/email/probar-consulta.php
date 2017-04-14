<?php include_once("../functions/Functions.php");
	require("PHPMailer-master/class.phpmailer.php"); 
	require("PHPMailer-master/class.smtp.php"); 
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("email");
    $db = new Db();
    $envio_email = new Email();

/*    $estrategia = 'QR_49_943';
    $html = 'Estimado [Nombre],<br>
	Le informamos que posee una deuda de [Deuda_Total]. Y le recomendamos cancelar sus facturas pendientes para seguir disfrutando de nuestro servicio.<br>
	[Tabla_Deudas]<br>';


    $query_ve = "SELECT variable FROM Variables";

    $variables_existentes = $db->select($query_ve);

    $uso_variables = array();

    if(count($variables_existentes) > 0){
    	foreach($variables_existentes as $var_e){
    		$var = $var_e['variable'];
    		$uso = strpos($html, '['.$var.']');
    		if($uso !== false){
    			$uso_variables[] = $var;
    		}
    	}
    }

    $select_correos = "SELECT m.correo_electronico, m.rut FROM Mail m , ".$estrategia." q WHERE m.Rut = q.Rut LIMIT 2 OFFSET 101";

		$correos = $db->select($select_correos);
		$n = 0;
		$info = array();

		if(count($correos) > 0){
			foreach ($correos as $row_correos) {
				$email = $row_correos['correo_electronico'];
				$correos_array[] = $email;
				$rut = $row_correos['rut'];
				$n++;
				foreach ($uso_variables as $var){
					$info[$email][$var] = $envio_email->get_var_value($rut,$var);
					if($info[$email][$var] == false){ echo 'Error';}
				}
			}


			//$envio_result = $envio->SendMail($html,$asunto,$correos_array, $info, $uso_variables);


		/*if(is_array($email_list)){
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
					$find = array();
					$replace = array();

					foreach ($variables as $var) {
						$variables[] = $var;
						$valores[] = $info[$email][$var];
					}

					$content = str_replace($variables, $valores, $html);					
					$mail->MsgHTML($content);    
				}
			}
			$ToReturn = TRUE;
		}<html>
				<head>
					<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
					<style>
						body{font-family:'Open Sans';font-size:14px;}
						table{font-size:13px;border-collapse:collapse;}
						th{padding:8px;text-align:left;color:#595e62;border-bottom: 2px solid rgba(0,0,0,0.14);font-size:14px;}
						td{padding:8px;border-bottom: 1px solid rgba(0,0,0,0.05);}
					</style>
				</head>
				<body><?php
			foreach ($correos_array as $correo) {
				$find = array();
				$replace = array();
				
				foreach ($uso_variables as $var){
					$find[]='['.$var.']';
					$replace[] = $info[$correo][$var];
				}
				$content = str_replace($find, $replace, $html);

				echo $content.'<br><br>';
			}

		}
?>
</body>
</html>*/
			
		/*$db = new Db();
		$exist = true;
		$char = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    	$lon = strlen($char) - 1;
    	$return = false;
    
		do{
			$code = '';
			for($i=0; $i < 6; $i++ ){
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

		echo $return;*/

		$select_last_id = "SELECT id FROM envio_email ORDER BY id DESC";

		$last_id = $db->select($select_last_id);

		if(count($last_id) > 0){
			$row = $last_id[0];
			$ultimo_envio = $row['id'];
			echo $ultimo_envio;
		}
?>