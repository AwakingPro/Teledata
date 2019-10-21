<?php 
require("../../plugins/PHPMailer-master/class.phpmailer.php");
require("../../plugins/PHPMailer-master/class.smtp.php");
include('../../class/email/EmailClass.php');
include('../../class/methods_global/methods.php');

ini_set('max_execution_time', 30); //240 segundos = 4 minutos

$message = '';
$name = '';
$email = '';
$mensaje = '';
$metodo = new Method;

$mail = new PHPMailer(true);
$query = "SELECT correo, clave, email_from, host FROM teledata_correos";
// $query = "SELECT correo_prueba, clave_prueba, email_from_prueba FROM teledata_correos";
$remitente = $metodo->select($query);
if(count($remitente)){
    $mail->Username = $remitente[3]['correo'];
    $mail->Password = $remitente[3]['clave'];
    $mail->From = $remitente[3]['email_from'];
    $mail->Host = $remitente[3]['host'];
}else{
    echo 'Error al seleccionar el remitente de la bd';
}

$email = 'daniel30081990@gmail.com';
$telefono = '936292818';
$name = 'Daniel';
$mensaje = 'Prueba email masivos';
$ubicacion = 'venegas 738 A';
$email_clear = clean_text($email);

$telefono_clear = clean_text($telefono);
$name_clear = clean_text($name);
$ubicacion_clear = clean_text($ubicacion);
$mensaje_clear = clean_text($mensaje);

if(isset($email_clear) && $email_clear != '' && check_email($email_clear))
{
    if(isset($name_clear) && $name_clear != '')
    {
        if(isset($mensaje_clear) && $name_clear != '')
        {

            $ip = $_SERVER["REMOTE_ADDR"];

            $message = '
                                <h3 align="center">Información del Cliente</h3>
                                <table border="1" width="100%" cellpadding="5" cellspacing="5">
                                    <tr>
                                        <td style="padding-left:10px;" width="20%">Nombre</td>
                                        <td style="padding-left:10px;" width="70%">'.$name_clear.'</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10px;" width="20%">Email</td>
                                        <td style="padding-left:10px;" width="70%">'.$email_clear.'</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10px;" width="20%">Télefono</td>
                                        <td style="padding-left:10px;" width="70%">'.$telefono_clear.'</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10px;" width="20%">Ubicación</td>
                                        <td style="padding-left:10px;" width="70%">'.$ubicacion_clear.'</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10px;" width="20%">Mensaje</td>
                                        <td style="padding-left:10px;" width="70%">'.$mensaje_clear.'</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10px;" width="10%">Ip</td>
                                        <td style="padding-left:10px;" width="70%">'.$ip.'</td>
                                    </tr>
                                </table>
                            ';

            $message_muestra = '
                                <h3 align="center">Información del Cliente</h3>
                                <table border="1" width="100%" cellpadding="5" cellspacing="5">
                                    <tr>
                                        <td style="padding-left:10px;" width="20%">Nombre</td>
                                        <td style="padding-left:10px;" width="70%">'.$name_clear.'</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10px;" width="20%">Email</td>
                                        <td style="padding-left:10px;" width="70%">'.$email_clear.'</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10px;" width="20%">Télefono</td>
                                        <td style="padding-left:10px;" width="70%">'.$telefono_clear.'</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10px;" width="55%">Ubicación</td>
                                        <td style="padding-left:10px;" width="70%">'.$ubicacion_clear.'</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10px;" width="55%">Mensaje</td>
                                        <td style="padding-left:10px;" width="70%">'.$mensaje_clear.'</td>
                                    </tr>
                                </table>
                            ';
            $mail->IsSMTP();	                            //Sets Mailer to send message using SMTP
            $mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
//            STARTTLS puerto 25, 587 o 2587
//            $mail->Port = '2587';							//Sets the default SMTP server port
////            TLS Wrapper puerto 465 o 2465
            $mail->Port = '465';
////            $mail->Port = '2465';
            $mail->SMTPSecure = 'TLS';		                //Definmos la seguridad como TLS
//            $mail->SMTPSecure = 'ssl';
            $mail->Mailer = "smtp";
            $mail->SMTPOptions = array(
                'ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true)
            );//opciones para "saltarse" comprobación de certificados (hace posible del envío desde localhost)
            //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
            // 0 = off (producción)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug  = true;
            $mail->CharSet = 'UTF-8';
//            $mail->Host = 'smtp.gmail.com';
//            $mail->Host = 'email-smtp.us-east-1.amazonaws.com';

            //Sets the SMTP hosts of your Email hosting, this for gmail
            //El puerto será el 465 ya que usamos encriptación TLS
            //El puerto 587 es soportado por la mayoría de los servidores SMTP y es útil para conexiones no encriptadas (sin TLS)

	            //Sets SMTP password
//            $mail->setFrom('dangel@teledata.cl', 'no-reply Contacto Teledata email masivo');
//            $mail->setFrom('no-reply@amazonaws.com', 'no-reply Contacto Teledata email masivo con aws');
            $mail->From = $remitente[3]['email_from'];					//Sets the From email address for the message
            $mail->FromName = $name_clear;				//Sets the From name of the message
            $destinatario = 'daniel30081990@gmail.com';
            $ArrayCopiados = array();
            $copiados = 'danielgeekcompras@gmail.com, dangel@teledata.cl';
            $ArrayCopiados = explode(", ", $copiados);


            //Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
            $mail->MsgHTML($message);
            //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
            $mail->AltBody = $message;
            $mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
            $mail->IsHTML(true);							//Sets message type to HTML
            //    	$mail->AddAttachment($path);					//Adds an attachment from a path on the filesystem
            $mail->Subject = 'Solicitud de información';				//Sets the Subject of the message
            $mail->Body = $message;						//An HTML or plain text message body
            $mail->AddAddress($destinatario);               //Adds a "To" address
            foreach($ArrayCopiados as $copiado){
                $mail->addCC($copiado);
            }
//            echo '<pre>'; echo print_r($mail); echo '</pre>';
//            exit;
            $totalEnvios = 1;
            $tope = 0;
//            echo 'username '.$mail->Username . ' password '.$mail->Password .' Email from '. $mail->From;
//            exit;
            while($tope < $totalEnvios){
                try {
                    if($mail->Send())								//Send an Email. Return true on success or false on error
                    {
                        $tope++;
                        echo $message = '<div class="alert alert-success text-center">' ."Email N°" . $tope . " enviado Exitosamente.".'</div><hr><div class="alert alert-info">'.$message_muestra.'</div>';
                        // echo $json;
                        //            unlink($path);
                    }
                    else
                    {
                        echo $message = '<div class="alert alert-danger text-center">Error al intentar enviar el email'. $mail->ErrorInfo.'</div>';
                        exit;
                    }
                }catch (phpmailerException $e) {
                    echo $e->errorMessage(); //Pretty error messages from PHPMailer
                } catch (Exception $e) {
                    echo $e->getMessage(); //Boring error messages from anything else!
                }

            }

            // }
            // else
            // {
            //     echo $message = '<div class="alert alert-danger text-center">recaptcha Vacio o Invalido!</div>';
            // }

            // }
            // else
            // {
            //     echo $message = '<div class="alert alert-danger text-center">Solucione el Recaptcha!</div>';

            // }
        }
        else
        {
            echo $message = '<div class="alert alert-danger text-center">Escriba un Mensaje </div>';
        }
    }
    else
    {
        echo $message = '<div class="alert alert-danger text-center">Escriba un Nombre </div>';
    }
}
else
{
    echo $message = '<div class="alert alert-danger text-center">Escriba un Email Valido</div>';
}




// funcion para limpiar caracteres especiales
function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

//funciona para check si el email es valido y los dns son correctos cuando no es gmail
function check_email($email) {
    if(preg_match('/^\w[-.\w]*@(\w[-._\w]*\.[a-zA-Z]{2,}.*)$/', $email, $matches))
    {
        if(function_exists('checkdnsrr'))
        {
            if(checkdnsrr($matches[1] . '.', 'MX')) return true;
            if(checkdnsrr($matches[1] . '.', 'A')) return true;
        }else{
            if(!empty($hostName))
            {
                if( $recType == '' ) $recType = "MX";
                exec("nslookup -type=$recType $hostName", $result);
                foreach ($result as $line)
                {
                    if(eregi("^$hostName",$line))
                    {
                        return true;
                    }
                }
                return false;
            }
            return false;
        }
    }
    return false;
}


?>