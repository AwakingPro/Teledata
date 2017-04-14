<?php
include("../db/db.php");
include("../mail/class.phpmailer.php");
include("../mail/class.smtp.php");

class main
{
	public function insertRegistro($user,$pass,$email)
	{
		$this->user=$user;
		$this->pass=$pass;
		$this->email=$email;
		$query=mysql_query("SELECT email FROM users WHERE email='$this->email'");
		if(mysql_num_rows($query)>0)
		{
			echo "Correo electronico ya existe";
		}
		else
		{	
			mysql_query("INSERT INTO users(user,pass,email) VALUES ('$this->user','$this->pass','$this->email')");
			$v = base64_encode($email);
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPDebug = 1; 
			$mail->Host = "mail.supplymarket.net"; 
			$mail->Username = "app@supplymarket.net"; 
			$mail->Password = "m9a7r5s3";
			$mail->Port = 25; 
			$mail->From = "app@supplymarket.net"; 
			$mail->FromName = "APP SUPPLY MARKET";
			$mail->AddAddress("$this->email"); 
			$mail->IsHTML(true); 
			$mail->Subject = "Confirmacion de Registro";
			$body = "Estimado <br />";
			$body .= "Favor hacer click aca para validar tu email : <a href='http://app.supplymarket.net/supplymarket/valida.php?v=$v'><b>Validar</b></a>";
			$mail->Body = $body; 
			$exito = $mail->Send(); 
			if($exito)
			{
				echo "Correo enviado";
			}
			else
			{
				echo "Hubo un inconveniente. Contacta a un administrador.";
			}
		}	
	}
	public function validaUsuario($m)
	{
		$this->m=$m;
		
	}
	public function respUsuario()
	{
		mysql_query("UPDATE users SET codigo=1 WHERE email='$this->m'");
		echo "Ya puedes iniciar sesion".$this->m;
	}		
}
?>