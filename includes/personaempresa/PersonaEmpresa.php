<?php 
    require("../../plugins/PHPMailer-master/class.phpmailer.php");
    require("../../plugins/PHPMailer-master/class.smtp.php");
    include('../../class/email/EmailClass.php');
    include('../../class/personaempresa/PersonaEmpresa.php');
    
    $clientes = new PersonaEmpresa();
	echo $clientes->SincronizarConBsale();
	
?>   