<?php require("../includes/functions/Functions.php");
	require("../includes/email/PHPMailer-master/class.phpmailer.php"); 
	require("../includes/email/PHPMailer-master/class.smtp.php"); 
	include("../class/email/email.php");
	include("../class/db/DB.php");
	include("../class/db/log.php");
    $db = new Db();

$fecha = date('Y-m-d H:i:s');
$hora_actual = strtotime ( '-30 minute' , strtotime ( $fecha ) ) ;
$hora_actual = date ( 'Y-m-d H:i:s' , $hora_actual );

$consulta_pendientes = "SELECT * FROM envio_email WHERE status = 0 ORDER BY id ASC LIMIT 1";

$pendientes = $db->select($consulta_pendientes);

if(count($pendientes) > 0){

	$row_pendientes = $pendientes[0];

	$id = $row_pendientes["id"];

	$cantidad = $row_pendientes["cantidad"];

	$asunto = $row_pendientes["asunto"];

	$html = $row_pendientes["html"];

	$offset = $row_pendientes["offset"];

	$estrategia = $row_pendientes["estrategia"];

	$hora_ultima_actualizacion = $row_pendientes["actualizacion"];

	$adjuntar = $row_pendientes["adjuntar"];

	if(strtotime($hora_ultima_actualizacion) <= strtotime($hora_actual)){

		//Consultar Variables creadas
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

		$select_correos = "SELECT m.correo_electronico, m.Rut FROM Mail m , ".$estrategia." q WHERE m.Rut = q.Rut LIMIT 2 OFFSET ".$offset;

		$correos = $db->select($select_correos);
		$n = 0;
		$info = array();
		$adjuntos = array();
		$envio = new Email();

		if(count($correos) > 0){
			foreach($correos as $correo){
				$email = $correo['correo_electronico'];
				$correos_array[] = $email;
				$rut = $correo['rut'];
				$n++;
				//Obtener valor de cada Variable para cada rut
				foreach ($uso_variables as $var){
					$info[$email][$var] = $envio->get_var_value($rut,$var);
				}
				//Adjuntos
				if($adjuntar == 1){
					$consulta_adjuntos = "SELECT Numero_Operacion FROM Deuda WHERE Rut='".$rut."' AND Id_Cedente = '".$_SESSION['cedente']."'";

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

				$new_offset = $offset + $n;

				$status = ($new_offset >= $cantidad) ? '1' : '0';

				$date = date('Y-m-d H:i:s');

				$update_actual = "UPDATE envio_email SET offset='".$new_offset."', status='".$status."', actualizacion='".$date."' WHERE id='".$id."'";

				$actual = $db->query($update_actual);
				
				if($status == 1){
					$consulta_siguiente = "SELECT * FROM envio_email WHERE status = 0 ORDER BY id ASC LIMIT 1";
					$siguiente = $db->select($consulta_siguiente);

					if(count($siguiente) > 0){

						$row_siguiente = $siguiente[0];

						$id = $row_siguiente["id"];

						$update_siguiente = "UPDATE envio_email SET actualizacion='".$date."' WHERE id='".$id."'";
						$act_siguiente = $db->query($update_siguiente);
					}

				}

				echo '3';
			}
		}
	} else {
		echo '2';
	}
} else {
	echo '1';
}