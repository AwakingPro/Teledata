<?php 
	require("../../plugins/PHPMailer-master/class.phpmailer.php");
	require("../../plugins/PHPMailer-master/class.smtp.php");
    include('../../class/email/EmailClass.php');
	include('../../class/methods_global/methods.php');
	$email = new Email();
	$email->pruebaCorreo();

?>