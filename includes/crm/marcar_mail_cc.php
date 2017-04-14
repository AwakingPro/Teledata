<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->marcarMailcc($_POST['id_mail'],$_POST['id']);
?>    