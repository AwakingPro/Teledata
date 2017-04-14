<?php include_once("../functions/Functions.php");
	require("PHPMailer-master/class.phpmailer.php"); 
	require("PHPMailer-master/class.smtp.php"); 
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("email");
    $db = new Db();
    $codigo = new Email();

$estrategia = $_POST["est"];
$cantidad = $_POST["cant"];
$asunto = $_POST["asunto"];
$html = $_POST["html"];
$adjuntar = $_POST["adjuntar"];
$cedente = $_SESSION["cedente"];
$code = $codigo->gen_code();

$html = '<html>
<head>
<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
<style>
body{font-family:Open Sans;font-size:14px;}
table{font-size:13px;border-collapse:collapse;}
th{padding:8px;text-align:left;color:#595e62;border-bottom: 2px solid rgba(0,0,0,0.14);font-size:14px;}
td{padding:8px;border-bottom: 1px solid rgba(0,0,0,0.05);}
</style>
</head>
<body>
'.$html.'
<img src="http://agutcode.com/confirmar-lectura.php?code='.$code.'&e=[correo]" style="opacity: 0; height:1px; width:1px;">
</body>
</html>';
//Consultar Variables Creadas
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

//Consulta si existen envios pendientes
$consulta_pendientes = "SELECT * FROM envio_email WHERE status = 0";

$pendientes = $db->select($consulta_pendientes); 

if(count($pendientes) > 0){

	//Validar si existe otro registro pendiente de esa estrategia
	$existe = false;
	foreach($pendientes as $row_pendientes){		
		$est = $row_pendientes["estrategia"]; 
		$existe = ($est == $estrategia) ? true : $existe;
	}
	if($existe){

		echo '1';

	} else {

		$date = date('Y-m-d H:i:s');

		$programar_envio = "INSERT INTO envio_email(estrategia, cantidad, offset, asunto, html, actualizacion, adjuntar) VALUES ('".$estrategia."','".$cantidad."','0','".$asunto."','".$html."','".$date."','".$adjuntar."')";
		$programar = $db->query($programar_envio);

		if($programar !== false){
			$select_last_id = "SELECT id FROM envio_email ORDER BY id DESC";
			$last_id = $db->select($select_last_id);

			if(count($last_id) > 0){
				$row = $last_id[0];
				$ultimo_envio = $row['id'];

				$confirmacion = "INSERT INTO Confirmacion (codigo, id_envio) VALUES('".$code."','".$ultimo_envio."')";
				$insert = $db->query($confirmacion);				
			}
			echo '6';
		}
	}

} else {

	//Validar tiempo de último envío 
	$consultar_tiempo = "SELECT actualizacion FROM envio_email WHERE status = 1 ORDER BY id DESC LIMIT 1";

	$tiempo = $db->select($consultar_tiempo);

	if(count($tiempo) > 0){

		$row_tiempo = $tiempo[0];
		
		$hora_envio = $row_tiempo["actualizacion"]; 

		$fecha = date('Y-m-d H:i:s');
		$hora_actual = strtotime ( '-30 minute' , strtotime ( $fecha ) ) ;
		$hora_actual = date ( 'Y-m-d H:i:s' , $hora_actual );

		//Validar si se envio hace más de 30min
		if(strtotime($hora_envio) <= strtotime($hora_actual)){

			$select_correos = "SELECT m.correo_electronico, m.rut FROM Mail m , ".$estrategia." q WHERE m.Rut = q.Rut LIMIT 2 OFFSET 101";

			$correos = $db->select($select_correos);
			$n = 0;
			$info = array();
			$adjuntos = array();			
			$envio = new Email();

			if(count($correos) > 0){
				foreach ($correos as $row_correos) {
					$email = $row_correos['correo_electronico'];
					$correos_array[] = $email;
					$rut = $row_correos['rut'];
					$n++;
					//Obtener valor de cada Variable para cada rut
					foreach ($uso_variables as $var){
						$info[$email][$var] = $envio->get_var_value($rut,$var);
					}
					//Consultar adjuntos
					if($adjuntar == 1){
						$consulta_adjuntos = "SELECT Numero_Operacion FROM Deuda WHERE Rut='".$rut."' AND Id_Cedente = '".$cedente."'";

						$con_adj = $db->select($consulta_adjuntos); 

						if(count($con_adj) > 0) {

							$facturas = array();
							foreach($deudas as $deuda){
								$facturas[] = $deuda['Numero_Operacion'];
							}

							$adjuntos[$email] = $facturas;
						}

					} else {
						$adjuntos = false;
					}
				}

				$info['variables'] = $uso_variables;
				$info['adjuntos'] = $adjuntos;

				$envio_result = $envio->SendMail($html,$asunto,$correos_array, $info);
				//Comentada debido a que no qeueremos spamear con correo basura a la gente
				//$envio_result = true; //Variable en true provicional.
				if($envio_result){

					$offset = $n;

					$status = ($offset >= $cantidad) ? '1' : '0';
					
					$date = date('Y-m-d H:i:s');

					$agregar_pendientes = "INSERT INTO envio_email(estrategia, cantidad, asunto, html, offset, status, actualizacion, adjuntar) VALUES ('".$estrategia."','".$cantidad."','".$asunto."','".$html."','".$offset."','".$status."','".$date."','".$adjuntar."')";

					$agregar = $db->query($agregar_pendientes);

					if($agregar !== false){

						$select_last_id = "SELECT id FROM envio_email ORDER BY id DESC";
						$last_id = $db->select($select_last_id);

						if(count($last_id) > 0){
							$row = $last_id[0];
							$ultimo_envio = $row['id'];

							$confirmacion = "INSERT INTO Confirmacion (codigo, id_envio) VALUES('".$code."','".$ultimo_envio."')";
							$insert = $db->query($confirmacion);
							
							
						}
						echo '3';
					}

				} else{
					echo '4';
				}
			}

		} else {

			$date = date('Y-m-d H:i:s');

			$programar_envio = "INSERT INTO envio_email(estrategia, cantidad, offset, asunto, html, actualizacion, adjuntar) VALUES ('".$estrategia."','".$cantidad."','0','".$asunto."','".$html."','".$date."','".$adjuntar."')";
			$programar = $db->query($programar_envio);

			if($programar !== false){

				$select_last_id = "SELECT id FROM envio_email ORDER BY id DESC";
				$last_id = $db->select($select_last_id);

				if(count($last_id) > 0){
					$row = $last_id[0];
					$ultimo_envio = $row['id'];

					$confirmacion = "INSERT INTO Confirmacion (codigo, id_envio) VALUES('".$code."','".$ultimo_envio."')";
					$insert = $db->query($confirmacion);
				}
				echo '2';
			}
		}

	} else {

		$select_correos = "SELECT m.correo_electronico as correo_electronico, m.Rut as rut FROM Mail m , ".$estrategia." q WHERE m.Rut = q.Rut";

		$correos = $db->select($select_correos);
		$n = 0;
		$info = array();
		$adjuntos = array();
		
		$envio = new Email();

		if(count($correos) > 0){
			foreach ($correos as $row_correos) {
				$email = $row_correos['correo_electronico'];
				$correos_array[] = $email;
				$rut = $row_correos['rut'];
				$n++;
				//Obtener valor de cada Variable para cada rut
				foreach ($uso_variables as $var){
					$info[$email][$var] = $envio->get_var_value($rut,$var);
				}
				//Consultar adjuntos
				if($adjuntar == 1){
					$consulta_adjuntos = "SELECT Numero_Operacion FROM Deuda WHERE Rut='".$rut."' AND Id_Cedente = '".$cedente."'";

					$con_adj = $db->select($consulta_adjuntos); 

					if(count($con_adj) > 0) {

						$facturas = array();
						foreach($deudas as $deuda){
							$facturas[] = $deuda['Numero_Operacion'];
						}

						$adjuntos[$email] = $facturas;
					}

				} else {
					$adjuntos = false;
				}
			}

			$info['adjuntos'] = $adjuntos;
			$info['variables'] = $uso_variables;

			$envio_result = $envio->SendMail($html,$asunto,$correos_array, $info);
			//Comentada debido a que no qeueremos spamear con correo basura a la gente
			//$envio_result = true; //Variable en true provicional.
			if($envio_result){

				$offset = $n;

				$status = ($offset >= $cantidad) ? '1' : '0';
				
				$date = date('Y-m-d H:i:s');

				$update_pendientes = "INSERT INTO envio_email(estrategia, cantidad, asunto, html, offset, status, actualizacion, adjuntar) VALUES ('".$estrategia."','".$cantidad."','".$asunto."','".$html."','".$offset."','".$status."','".$date."','".$adjuntar."')";

				$programar = $db->query($update_pendientes);

				if($programar !== false){

					$select_last_id = "SELECT id FROM envio_email ORDER BY id DESC";
					$last_id = $db->select($select_last_id);

					if(count($last_id) > 0){
						$row = $last_id[0];
						$ultimo_envio = $row['id'];

						$confirmacion = "INSERT INTO Confirmacion (codigo, id_envio) VALUES('".$code."','".$ultimo_envio."')";
						$insert = $db->query($confirmacion);
					}

					echo '3';
				}

			} else{
				echo '4';
			}
		}

	}

}

?>