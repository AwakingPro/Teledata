<?php include_once("../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    $db = new Db();

    $code=$_GET['code'];
	$email =$_GET['e'];
	
	$query = "SELECT * FROM Confirmacion WHERE codigo = '".$code."'";
	
	$find = $db->select($query);
	if(count($find) > 0){
		$row=$find[0];
		$emails = $row['emails'];
		$confirmado = stripos($emails, $email);
		if($confirmado === false){
			$email_list = ($emails !== '') ? $emails.','.$email : $email;
			$confirmar_lectura = "UPDATE Confirmacion SET emails = '".$email_list."' WHERE codigo='".$code."'";
			$actualizar_registro = $db->query($confirmar_lectura);
		}
	}

?>