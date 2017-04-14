<?php
class Template
{     
     public function Claro($rut,$cedente,$mailArray,$facturaArray,$mailArraycc)
	{
		session_start();
		$this->mailArray=$mailArray;
		$this->mailArraycc=$mailArraycc;	
		$this->facturaArray=$facturaArray;	
		$this->cedente=$cedente;
		$this->rut=$rut;

		$img_url        = '/home/foco/img/sencillito_servipag.png';
    	$img_referencia    = 'sencillito_servipag';
    	$img_nombre        = 'sencillito_servipag';


    	$img_url2        = '/home/foco/img/webpay_servipag.png';
    	$img_referencia2    = 'webpay_servipag';
    	$img_nombre2        = 'webpay_servipag';

    	$img_url3        = '/home/foco/img/facturacion.png';
    	$img_referencia3    = 'facturacion';
    	$img_nombre3        = 'facturacion';

		$sql_nombre = mysql_query("SELECT Nombre_Completo FROM Persona WHERE Rut = $this->rut LIMIT 1");
		$nombre  = '';
		while($r = mysql_fetch_array($sql_nombre))
		{
			$nombre = utf8_encode($r[0]);
		}	

		$directorio = "/home/foco/ftp/".$this->cedente."/";
		$extension = ".pdf";
		$registro.="<html><head> <meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1'><title>Foco Estrategico</title>";
		$registro.="<style type='text/css'>body,td,th {font-family: Verdana, Geneva, sans-serif; font-size: 12px;}";
		$registro.=".FONT {font-family: Verdana, Geneva, sans-serif; font-size: 12px; } </style></head>";
		$registro.="<body bgcolor='#ffffff' text='#000000' link='#0000ff' vlink='#0000ff' alink='#0000ff'>";
		$registro.="Se&ntilde;ores<br><br>";
		$registro.="<b>$nombre </b> <br><br>";    
		$registro.="Estimados,<br><br>";
		$registro.="En nuestro sistema figuran la(s) siguiente(s) factura(s) vencida(s) y pendiente(s) de pago.<br><br>";
		$registro.="<table border='1' cellpadding='5' cellspacing='1' width='60%'>";
		$registro.='<tr>';
		$registro.="<td align='center' bgcolor='red'><font face='verdana, helvetica, arial' size='2' font color='#FFFFFF'>FACTURA</td>";
		$registro.="<td align='center' bgcolor='red'><font face='verdana, helvetica, arial' size='2' font color='#FFFFFF'>EMISI&Oacute;N</td>";
		$registro.="<td align='center' bgcolor='red'><font face='verdana, helvetica, arial' size='2' font color='#FFFFFF'>VENCIMIENTO</td>";
		$registro.="<td align='center' bgcolor='red'><font face='verdana, helvetica, arial' size='2' font color='#FFFFFF'>MONTO</td></tr>";
		$facturas= mysql_query("SELECT Numero_Operacion,Fecha_Ingreso,Fecha_Vencimiento,Saldo_Mora FROM Deuda WHERE Id_Cedente = $this->cedente and Rut = $this->rut ");
		while($r = mysql_fetch_array($facturas))
		{
			$factura = $r[0];
			$emision = $r[1];
			$vencimiento = $r[2];
			$monto = $r[3];
			$registro.="<tr>"; 
			$registro.="<td><center>$factura</center></td>"; 
			$registro.="<td><center>$emision</center></td>"; 
			$registro.="<td><center>$vencimiento</center></td>"; 
			$registro.="<td><center>$monto</center></td>"; 
			$registro.='</tr>';                   
		}
		$registro.='</table><br>';
		$registro.="Favor indicar <b>fecha de pago de estas facturas</b> y en el caso de que la deuda informada se encuentre cancelada<b> enviar comprobante de pago.</b>";
		$registro.="Tambi&eacute;n le recuerdo que puede realizar transferencia o dep&oacute;sito a Cuenta Corriente que se se&ntilde;alan seg&uacute;n el emisor de su factura.<br><br>";
		$registro.="<table border='1' cellpadding='5' cellspacing='1' width='60%'>";
		$registro.='<tr>';
		$registro.="<td align='center' bgcolor='red'><font face='verdana, helvetica, arial' size='2' font color='#FFFFFF'>Rut</td>";
		$registro.="<td align='center' bgcolor='red'><font face='verdana, helvetica, arial' size='2' font color='#FFFFFF'>Empresa</td>";
		$registro.="<td align='center' bgcolor='red'><font face='verdana, helvetica, arial' size='2' font color='#FFFFFF'>Banco</td>";	
		$registro.="<td align='center' bgcolor='red'><font face='verdana, helvetica, arial' size='2' font color='#FFFFFF'>N&deg; Cuenta Corriente</td>";
		$registro.='</tr>';  
		$registro.="<tr>"; 
		$registro.="<td><center>88381200-k</center></td>"; 
		$registro.="<td><center>Claro Infraestructura 171 S.A.</center></td>"; 
		$registro.="<td><center>Chile</center></td>"; 
		$registro.="<td><center>800 07573 00</center></td>"; 
		$registro.='</tr>';  
		$registro.="<tr>"; 
		$registro.="<td><center>94675000-k</center></td>"; 
		$registro.="<td><center>Claro Comunicaciones S.A.</center></td>"; 
		$registro.="<td><center>Chile</center></td>"; 
		$registro.="<td><center>800 07625 07</center></td>"; 
		$registro.='</tr>';  
		$registro.="<tr>"; 
		$registro.="<td><center>95714000-9</center></td>"; 
		$registro.="<td><center>Claro Servicios Empresariales S.A.</center></td>"; 
		$registro.="<td><center>Chile</center></td>"; 
		$registro.="<td><center>800 07623 00</center></td>"; 
		$registro.='</tr>';  	
		$registro.='</table><br><br>';
		$registro.='<b>Medios de pago.-</b><br><br>';
		$registro.='Si paga en nuestros Centros de Atenci&oacute;n, las formas de Pago ser&aacute;n las siguientes:';
		$registro.='<ul><li> Efectivo</li><li> Tarjeta de Cr&eacute;dito</li><li> Tarjeta de D&eacute;bito</li><li> Tarjetas de Casas Comerciales</li><li> Vale Vista</li><li> Cheque</li></ul><br>';
		$registro.="Sucursal virtual.-<br><br>";
		$registro.="Para poder pagar a trav&eacute;s de tu Sucursal Virtual debes ingresar a Mi Claro desde <a href='http://www.clarochile.cl' style='color:red'>www.clarochile.cl</a>.<br>";
		$registro.='Una vez dentro, si posees deuda , aparecer&aacute; la opci&oacute;n "<b>Pago en L&iacute;nea</b>" la que debes presionar.<br><br>';
		$registro.='<img src="cid:'.$img_referencia3.'"  alt="Logo" height="129" width="175" /><br>'; 
		$registro.="<br>Se desplegar&aacute;n el pago por WebPay,presto, y Servipag.Puedes elegir cualquiera de estos medios de pago.<br>";
		$registro.='<img src="cid:'.$img_referencia2.'"  alt="Logo" height="159" width="436" /><br>'; 

		$registro.="<br>Pagar tu cuenta por internet es muy simple . Puedes ingresar a tu banco o ultizar los servicios de alguno de los siguientes recaudadores<bR>";
		$registro.='<img src="cid:'.$img_referencia.'"  alt="Logo" height="90" width="240" /><br>'; 
		$registro.='<br>Recaudadores Web.-<br>';
		$registro.='Si requiere hacer alg&uacute;n tipo de consulta sobre su factura o pago puede contactar a su ejecutivo de cobranzas al correo rgomez@cobranding.cl o a su ejecutivo de servicio al 800-000-171 opci&oacute;n 2 <br><br>';
		$registro.='Saludos cordiales. <br>';
		$registro.='</body>';
		$registro.='</html>';
		

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 1;
		$msPriority = 1;
		$mail->Port = 25;
		$mail->Host = "mail.cobranding.cl";
		$mail->Username = "foco@cobranding.cl";
		$mail->Password = "m9a7r5s3";
		$mail->From = "foco@cobranding.cl";
		$mail->FromName = "Claro Empresas";
		$mail->Subject = "Aviso de deuda de Claro: $nombre / RUT : $this->rut";
		$ConfirmReadingTo = 'lponce@cobranding.cl';

	    $mail->ConfirmReadingTo = 'lponce@cobranding.cl';

		$mail->MsgHTML($registro);


		$cantidad_facturas = count($this->facturaArray);
		$j = 0;
		while($j < $cantidad_facturas)
		{
			$id_factura = $_SESSION['mfacturas'][$j];
			$q4 = mysql_query("SELECT Numero_Operacion FROM Deuda WHERE  Id_deuda = $id_factura ");
			while($r4 = mysql_fetch_array($q4))
			{
				$factura = $r4['0'];
				$ruta = $directorio.$factura.$extension;
				$mail->addAttachment($ruta);
			}
			$j++;
		}	

		$cantidad = count($this->mailArray);
		$i = 0;
		while($i < $cantidad)
		{
			$id_mail = $_SESSION['correos'][$i];
			$q2 = mysql_query("SELECT correo_electronico,Cargo FROM Mail WHERE  id_mail = $id_mail ");
			while($r2 = mysql_fetch_array($q2))
			{
				$correo = $r2['0'];
				$cargo = $r2['1'];
				$mail->AddAddress($correo, $cargo);
			}
			$i++;
		}	


		$cantidad_cc = count($this->mailArraycc);
		$k = 0;
		while($k < $cantidad_cc)
		{
			$id_mail = $_SESSION['correos_cc'][$k];
			$q2 = mysql_query("SELECT correo_electronico,Cargo FROM Mail_CC WHERE  id_mail = $id_mail ");
			while($r2 = mysql_fetch_array($q2))
			{
				$correo = $r2['0'];
				$cargo = $r2['1'];
				$mail->AddCC($correo);
			}
			$k++;
		}	
		


    	$mail->AddEmbeddedImage($img_url, $img_referencia, $img_nombre, "base64", "image/png");
    	$mail->AddEmbeddedImage($img_url2, $img_referencia2, $img_nombre2, "base64", "image/png");
    	$mail->AddEmbeddedImage($img_url3, $img_referencia3, $img_nombre3, "base64", "image/png");


		//LO SIGUIENTE VA A IR EN EL TAG BODY DEL EMAIL
		


		$mail->IsHTML(true);

		if(!$mail->Send()) {

		  echo "Error: " . $mail->ErrorInfo;

		} else {

		echo "Email Enviado";
		}
		session_start();
	}


	
}
?>