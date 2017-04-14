<?php include_once("../functions/Functions.php");
	require("PHPMailer-master/class.phpmailer.php"); 
	require("PHPMailer-master/class.smtp.php"); 
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("email");
    $db = new Db();
    $codigo = new Email();

$id_envio = $_POST["id"];

$select_envio = "SELECT * FROM envio_email WHERE id = '".$id."'";

$envio = $db->select($select_envio);

if(count($envio) > 0){
	$row_envio = $envio[0];
	$estrategia = $row_envio["estrategia"];
	$cantidad = $row_envio["cantidad"];
	$asunto = $row_envio["asunto"];
	$html = $row_envio["html"];
	$adjuntar = $row_envio["adjuntar"];
	$cedente = $_SESSION["cedente"];
}

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


$select_correos = "SELECT m.correo_electronico, m.rut FROM Mail m , ".$estrategia." q WHERE m.Rut = q.Rut";

$correos = $db->select($select_correos);
$n = 0;
$info = array();
$adjuntos = array();			
$envio = new Email();

if(count($correos) > 0){

	foreach ($correos as $row_correos) {
		$email = $row_correos['correo_electronico'];

		//Confirmar si fue leido para evitar reenvio.
		$validar_lectura = "SELECT * FROM Confirmacion WHERE id_envio = '".$id_envio."' AND emails LIKE %".$email."%";

		$visto = $db->select($validar_lectura);

		if(count($visto) < 1){
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
	}

	$info['variables'] = $uso_variables;
	$info['adjuntos'] = $adjuntos;

	$envio_result = $envio->SendMail($html,$asunto,$correos_array, $info);
	//Comentada debido a que no qeueremos spamear con correo basura a la gente
	//$envio_result = true; //Variable en true provicional.
	if($envio_result){

		echo '1';

	} else{
		echo '2';
	}
}	

?>