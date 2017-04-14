<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->nextRut($_POST['rut'],$_POST['prefijo']);
?>    