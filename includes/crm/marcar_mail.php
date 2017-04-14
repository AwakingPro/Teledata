<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->marcarMail($_POST['id_mail'],$_POST['id']);
?>    