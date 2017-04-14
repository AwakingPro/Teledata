<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->enviarMail($_POST['cedente'],$_POST['rut']);
?>    